<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Settings\Services\FundCenterService;
use Session;

class UtilityController
{
    public function getDivisionsByProvinceId(Request $request)
    {
        if ($request->ajax()) {

            $province_id = $request->input('province_id');
            $division_id = $request->input('division_id');
            $reponse['result'] = divisionDropDown($province_id,$division_id);

            echo json_encode($reponse);
        }

    }

    public function getDistrictByDivisionID(Request $request)
    {
        if ($request->ajax()) {

            $division_id = $request->input('division_id');
            $district_id = $request->input('district_id');
            $reponse['result'] = districtDropDown($division_id, $district_id);

            echo json_encode($reponse);
        }

    }

    public function getTehsilByDistrictID(Request $request)
    {
        if ($request->ajax()) {
            $user_tehsil_id = '';
            /*if (Session::get('user_info.level') == "TEHSIL") {
                if (Session::get('user_info.other_tehsil_id') != '') {
                    $user_tehsil_id = Session::get('user_info.other_tehsil_id') . ',' . Session::get('user_info.tehsil_id');
                } else {
                    if (Session::get('user_info.officer_other_tehsil_id') != '') {
                        $user_tehsil_id = Session::get('user_info.officer_other_tehsil_id');
                    } else {
                        $user_tehsil_id = Session::get('user_info.tehsil_id');
                    }

                }
            }*/
            $district_id = $request->input('district_id');
            $tehsil_id = $request->input('tehsil_id');
            $reponse['result'] = tehsilDropDown($district_id, $tehsil_id, $user_tehsil_id);
            echo json_encode($reponse);
        }

    }

    public function getFundCentersByGrantId(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->input('grant_id');
            $result = (new FundCenterService())->getFundCenterAll($id);
            $reponse['result'] = dropdownOptions($result);

            echo json_encode($reponse);
        }

    }
}
