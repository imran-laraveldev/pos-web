<?php


namespace App\Services;


use App\Models\CaseProceeding;
use App\Models\DefenceFiling;
use App\Models\Department;
use App\Models\DepartmentGroup;
use App\Models\ReferenceCase;
use App\Models\ReferenceCasePuc;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DepartmentService extends BaseService
{
    public function __construct()
    {

    }

    public function getAllDepartmentGroup()
    {
        return DepartmentGroup::with('departments')->get();
    }

    function getDepartment($id)
    {
        return Department::find($id);
    }

    function queryReferenceCases($department_id=null)
    {
        $query = ReferenceCase::query();
        return $query->where('department_idfk', $department_id);
    }

    function filterReferenceCases($where=[],$statusOnly=false)
    {
        $query = ReferenceCase::with('department');
        if ($statusOnly) {
            $query->where($where);
        } else {
            if (isSolicitor()) {
                $caseAppeal = ['session','appeal-1','appeal-2'];
                if (sizeof($where)) {
                    $caseAppeal = ['session','appeal-1'];
                    if ($where[0][2] == 'all') $where = [];
                }
                $query->where('case_type', 'reference');
                $query->whereIn('case_appeal', $caseAppeal);
            } elseif(isAdvocate()) {
                $query->where(function ($q){
                    $q->where('case_type', 'reference');
                    $q->whereIn('case_appeal', ['appeal-2','appeal-3']);
                });
                $query->orWhere('case_type', 'writ');

            }
            $query->where($where);
        }
        return $query;
    }

    function getReferenceCase($id)
    {
        return ReferenceCase::with('department')->find($id);
    }

    function queryDefenceFiling($id)
    {
        return DefenceFiling::with('lawOfficer','designation')
            ->where('reference_case_id', $id)->orderBy('from_date','desc');
    }

    function queryCaseProceedings($id)
    {
        return CaseProceeding::where('reference_case_id', $id)->orderBy('hearing_date', 'desc');
    }

    function queryPucLog($id)
    {
        return ReferenceCasePuc::where('reference_case_id', $id)->orderBy('created_at', 'desc');
    }

    function validateWrit($params)
    {
        $validationRules = [
            'department_idfk' => ['required'],
//                'department_puc' => ['required'],
            'entry_date' => ['required'],
            'reference_title' => ['required'],
            'reference_number' => ['required'],
            'law_officer_idfk' => ['required'],
            'court_idfk' => ['required'],
        ];
        $attributeNames = [
            'department_idfk' => 'Department',
//            'department_puc' => 'Department PUC',
            'entry_date' => 'Ref. entry date',
            'reference_title' => 'Ref. title',
            'reference_number' => 'Ref. number',
            'law_officer_idfk' => 'Law Officer',
            'court_idfk' => 'Court',
        ];
        $validator = Validator::make($params, $validationRules)->setAttributeNames($attributeNames);
        return $validator->validate();
    }

    public function validateCase($params)
    {
        $attributeNames = [];
        if ($params['step'] == 1) {
            $validationRules = [
                'department_idfk' => ['required'],
//                'department_puc' => ['required'],
                'entry_date' => ['required'],
                'reference_title' => ['required'],
                'reference_number' => ['required'],
                'reference_nature_idfk' => ['required'],
                'court_idfk' => ['required'],
                'status_idfk' => ['required'],
            ];
            $attributeNames = [
                'department_idfk' => 'Department',
                'department_puc' => 'Department PUC',
                'entry_date' => 'Ref. entry date',
                'reference_title' => 'Ref. title',
                'reference_number' => 'Ref. number',
                'reference_nature_idfk' => 'Ref. Nature',
                'court_idfk' => 'Court',
                'status_idfk' => 'Status',
            ];
        } elseif ($params['step'] == 2) {
            if (isset($params['secretary_approval']) && $params['secretary_approval'] == 'Y') {
                $validationRules = [
                    'instruction_letter' => ['required'],
                    'law_officer_idfk' => ['required'],
                    'designation_idfk' => ['required'],
                    'from_date' => ['required'],
//                'to_date' => ['required'],
                    'case_status' => ['required'],
                ];
                $attributeNames['law_officer_idfk'] = 'Law Officer';
                $attributeNames['designation_idfk'] = 'Designation';
            } else {
                return true;
            }
        } else {
            $validationRules = [
                'hearing_date' => ['required'],
                'hearing_progress' => ['required'],
                'is_decided' => ['required']
            ];

            if (isset($params['is_decided']) && $params['is_decided'] == 'Yes') {
                $validationRules += [
                    'copy_of_judgement' => ['required'],
                    'judgement_date' => ['required']
                ];
            } else {
                $validationRules += ['remarks' => ['required'], 'next_hearing_date' => ['required']];
            }
        }

        $validator = Validator::make($params, $validationRules)->setAttributeNames($attributeNames);
        return $validator->validate();
    }

    function createCase($params=null,$update=false)
    {
        unset($params['_token']);
        $attachmentFiles = [];
        if ($files = request()->file('department_puc')) {
            $attachmentFiles = $this->uploadFiles($files, 'reference_case_files');
        }
        $params['department_puc'] = implode(',', array_column($attachmentFiles,'url'));
//        unset($params['hearing_progress'],$params['next_hearing_date'],$params['judgement_date'],$params['remarks'],$params['hearing_date']);

        if ($update) {
            $params['updated_by'] = Auth::user()->id;
            $case = ReferenceCase::find($update);
            $case->update($params);
        } else {
            $params['created_by'] = Auth::user()->id;
            $case = ReferenceCase::create($params);
            if (sizeof($attachmentFiles)) {
                $this->insertAttachFiles($case,$attachmentFiles);
            }
        }
        return $case;
    }

    function updateCase($params,$id)
    {
        $params['updated_by'] = Auth::user()->id;
        return ReferenceCase::find($id)->update($params);
    }

    function createCaseDefenceFiling($params)
    {
        unset($params['_token']);
        $attachmentFiles = [];
        if ($files = request()->file('instruction_letter')) {
            $attachmentFiles = $this->uploadFiles($files, 'defence_filing_files'. DIRECTORY_SEPARATOR);
        }
        $params['instruction_letter'] = implode(',', array_column($attachmentFiles,'url'));
        $params['created_by'] = Auth::user()->id;
        $case = DefenceFiling::create($params);

        if (sizeof($attachmentFiles)) {
            $this->insertAttachFiles($case,$attachmentFiles);
        }
        return $case;
    }

    function createCaseProceeding($params)
    {
        unset($params['_token']);
        $attachmentFiles = [];
        if ($files = request()->file('copy_of_judgement')) {
            $attachmentFiles = $this->uploadFiles($files, 'judgement_files'. DIRECTORY_SEPARATOR);
        }
        $params['copy_of_judgement'] = implode(',', array_column($attachmentFiles,'url'));
        $params['created_by'] = Auth::user()->id;
        $case = CaseProceeding::create($params);

        if (sizeof($attachmentFiles)) {
            $this->insertAttachFiles($case,$attachmentFiles);
        }
        return $case;
    }

    function validateCasePuc($params)
    {
        $validationRules = [
            'reference_case_id' => ['required'],
        ];
        $attributeNames = [
            'reference_case_id' => 'Ref. Case',
        ];
        $validator = Validator::make($params, $validationRules)->setAttributeNames($attributeNames);
        return $validator->validate();
    }

    function createCasePuc($params)
    {
        unset($params['_token']);
        $attachmentFiles = [];
        if ($files = request()->file('attachment')) {
            $attachmentFiles = $this->uploadFiles($files, 'puc_files'. DIRECTORY_SEPARATOR);
        }
        $params['url'] = implode(',', array_column($attachmentFiles,'url'));
        $params['created_by'] = Auth::user()->id;
        $case = ReferenceCasePuc::create($params);

        if ($params['agree']) {
           $this->updateCase(['case_appeal' => $params['case_appeal'], 'case_status' => 'in progress', 'level' => 2,
               'updated_by' => Auth::user()->id], $params['reference_case_id']);
        }

        if (sizeof($attachmentFiles)) {
            $this->insertAttachFiles($case,$attachmentFiles);
        }
        return $case;
    }

    function getCaseCountsByRole($role_id ='',$created_at = false, $caseOnStay = false, $searchDate=false)
    {
        $query = ReferenceCase::select(DB::raw('count(id) as total'), 'case_status','case_appeal','created_at')
            ->where('case_type', 'reference');

        if (isSecretary() && $role_id != '') {
            if ($role_id == '3') {
                $query->whereIn('case_appeal', ['session', 'appeal-1']);
            }
            if ($role_id == '4') {
                $query->whereIn('case_appeal', ['appeal-2', 'appeal-3']);
            }
        } else {
            if (isSolicitor()) {
                $query->whereIn('case_appeal', ['session', 'appeal-1']);
            }
            if (isAdvocate()) {
                $query->whereIn('case_appeal', ['appeal-2', 'appeal-3']);
            }
        }

        if ($created_at) {
            $query->whereDate('created_at', $created_at);
        }

        if ($searchDate) {
            $whereClause = [];
            $hearingDate = explode(' - ', $searchDate);
            $from = date('Y-m-d', strtotime($hearingDate[0]));
            $to = date('Y-m-d', strtotime($hearingDate[1]));
            $searchDateField = 'created_at';
            if ($hearingDate[0] == $hearingDate[1]) {
                $whereClause[] = [$searchDateField, '=', $from];
            } else {
                $whereClause[] = [$searchDateField, '>=', $from];
                $whereClause[] = [$searchDateField, '<=', $to];
            }
            $query->where($whereClause);
        }

        $query->groupBy('case_status');
        $result = $query->get();

        $total = 0;
        $countArray = ['total' => 0,'pending' => 0,'in progess' => 0,'completed' => 0];
        foreach ($result as $row) {
            $total += $row['total'];
            $countArray[$row['case_status']] = $row['total'];
        }
        $countArray['total'] = $total;
        if ($caseOnStay) {
            $countArray['stay'] = $this->getCaseCountsByStatus();
        }
        return $countArray;
    }

    function getCaseCountsByStatus($status_id = 15)
    {
        return ReferenceCase::where('status_idfk', $status_id)->count();
    }

    function getWritCount()
    {
        return ReferenceCase::where('case_type', 'writ')->count();
    }

}
