<?php

namespace App\Helpers;

trait StatusTrait {

    protected $statuses = [
        0 => 'Inactive',
        1 => 'Active',
        2 => 'Draft',
        3 => 'Revised',
        4 => 'Accepted',
        5 => 'Rejected',
    ];

    public $modelStatus = 1;

    public function getStatusByID($id) {
        return $this->getStatusTitle($id);
    }

    public function getActiveStatusID() {
        return 1;
    }

    public function getAllStatuses() {
       return $this->statuses;
    }

    private function getStatusTitle($key = '') {
        if ($key == '') {
            return (isset($this->statuses[$this->modelStatus])) ? $this->statuses[$this->modelStatus] : null;
        }
        return (isset($this->statuses[$key])) ? $this->statuses[$key] : null;
    }
}
