<?php


namespace App\Services;


use App\Models\District;
use App\Models\Navigation;
use App\Models\Province;
use App\Models\User;

trait AclServiceTrait
{
    function getUserById($id)
    {
        return User::find($id);
    }

    function getUsersByRole($role=4)
    {
        return User::role($role)->get();
    }

    function getProvinceAll()
    {
        return Province::all();
    }

    function getDivisionsByProviceId($id=6)
    {
        return null; #Division::where('province_idfk', $id)->get();
    }

    function getDistrictAll()
    {
        return District::all();
    }

    function getCountries()
    {
        return null; #Country::all();
    }

    function getAllNavigations()
    {
        return Navigation::all();
    }

    function getAllParentNavigations()
    {
        return Navigation::where('parent_id',0)->get();
    }
}
