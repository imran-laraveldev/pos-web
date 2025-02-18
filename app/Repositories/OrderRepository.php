<?php

namespace App\Repositories;

use App\Models\User;
use Modules\Reports\Entities\Order;
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

    function getUsers()
    {
        return User::all();
    }

    function getStudents()
    {
        return SchoolStudent::with('course')->limit(100)->get();
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
