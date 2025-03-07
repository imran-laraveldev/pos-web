<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\Reports\Entities\Order;
use Modules\Schools\Entities\SchoolCourse;
use Modules\Schools\Entities\SchoolStudent;

class OrderRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Order();
    }

    public function getOrders($params)
    {
        return $this->model
            ->with([
                self::CREATER_RELATION,
            ])
            ->where([
                'relation_id' => $params['relation_id'],
            ])
            ->get();
    }

    function getCourses()
    {
        return SchoolCourse::all();
    }

    function getUsers()
    {
        return User::all();
    }

    function getStudents()
    {
        return SchoolStudent::with('course')->limit(100)->get();
    }

    public function createStudent($params) {
        $params['batch_id'] = Auth::user()->fund_center_idfk;
        $params['course_id'] = $params['course'];
        unset($params['course']);
        return SchoolStudent::create($params);
    }

    public function updateStudent($params,$id) {
        $student = SchoolStudent::find($id);
        return $student->update($params);
    }

    public function deleteStudent($id) {
        $student = SchoolStudent::find($id);
        return $student->delete();
    }
}
