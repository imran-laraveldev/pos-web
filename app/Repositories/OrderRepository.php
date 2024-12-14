<?php

namespace App\Repositories;

use Modules\Reports\Entities\Order;

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

}
