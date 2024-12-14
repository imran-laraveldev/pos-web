<?php


namespace App\Services;


use App\Models\CaseAssignedOfficer;
use App\Models\CaseProceeding;
use App\Models\DefenceFiling;
use App\Models\ReferenceCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CaseService extends BaseService
{
    public function __construct()
    {

    }

    function getCase($id)
    {
        $result = ReferenceCase::find($id);

        $decision_files = [];
        $reference_files = [];
        if ($files = $result->attachFiles) {
            foreach ($files as $file) {
                if (strstr($file->url, 'case_decision_files')) {
                    $decision_files[] = $file;
                } elseif (strstr($file->url, 'case_reference_files')) {
                    $reference_files[] = $file;
                }
            }
        }

        return [
            'row' => $result,
            'decision_files' => $decision_files,
            'reference_files' => $reference_files,
            ];
    }

    function filterReferenceCases($where=[],$statusOnly=false)
    {
        $query = ReferenceCase::with('department');
        if ($statusOnly) {
            $query->where($where);
        } else {
            if (isSolicitor()) {
                $query->where('case_type', 'solicitor');
            } elseif(isAdvocate()) {
                $query->where('case_type', 'advocate');
            }
            $query->where($where);
        }
        return $query;
    }

    function getReferenceCase($id)
    {
        return ReferenceCase::with('department')->find($id);
    }

    public function validateCase($params)
    {
        $attributeNames = [];
        if ($params['step'] == 1) {
            $validationRules = ['department_idfk' => ['required'],];
            if (isset($params['update_id']) && $params['update_id'] > 0) {
                $validationRules += ['case_number' => ['required','unique:reference_cases,case_number,'.$params['update_id']],];
            } else {
                $validationRules += ['case_number' => ['required','unique:reference_cases,case_number'],];
            }
            $validationRules += [
                'case_title' => ['required'],
                'parties' => ['required'],
                'court_idfk' => ['required'],
                'decision_date' => ['required']
            ];
            $attributeNames = [
                'department_idfk' => 'Department',
                'court_idfk' => 'Court',
            ];

            if ($params['category'] == 2) {
                $validationRules += ['expiry_limit' => ['required'],];
            }
        } elseif ($params['step'] == 2) {

                $validationRules = [
                    'law_officer_idfk' => ['required'],
                    'designation_idfk' => ['required'],
                    'from_date' => ['required'],
                    'case_status' => ['required'],
                ];
                $attributeNames['law_officer_idfk'] = 'Law Officer';
                $attributeNames['designation_idfk'] = 'Designation';

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
        if ($files = request()->file('decision_copy')) {
            $attachmentFiles = $this->uploadFiles($files, 'case_decision_files');
        }
        $params['decision_copy'] = implode(',', array_column($attachmentFiles,'url'));

        $referenceFiles = [];
        if ($files = request()->file('reference_copy')) {
            $referenceFiles = $this->uploadFiles($files, 'case_reference_files');
        }
        $params['reference_copy'] = implode(',', array_column($referenceFiles,'url'));

        if ($update) {
            $params['updated_by'] = Auth::user()->id;
            $case = ReferenceCase::find($update);
            $case->update($params);
        } else {
            $params['created_by'] = Auth::user()->id;
            $case = ReferenceCase::create($params);
            if (sizeof($referenceFiles)) {
                $this->insertAttachFiles($case,$referenceFiles);
            }
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

    function createAssignOfficer($params)
    {
        unset($params['_token']);
        $params['created_by'] = Auth::user()->id;
        $case = CaseAssignedOfficer::create($params);

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

    public function queryAssignedOfficers($id)
    {
        return CaseAssignedOfficer::with('lawOfficer','designation')
            ->where('reference_case_id', $id)->orderBy('created_at','desc');
    }

    function queryCaseProceedings($id)
    {
        return CaseProceeding::where('reference_case_id', $id)->orderBy('hearing_date', 'desc');
    }
}
