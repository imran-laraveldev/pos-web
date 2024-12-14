<?php

namespace App\Helpers;

trait UserRoleTrait {

    public $roles;

    public function getRoleyID($id) {
        return $this->getRole($id);
    }

    public function getCustomerRoleID() {
        return 3;
    }

    public function getCustomerRoleName() {
        return $this->getRoleyID(3);
    }

    public function getAllRoles() {
        $this->roles = [
            1 => 'Super Admin',
            2 => 'Customer',
            3 => 'Sales Staff'
        ];
    }

    private function getRole($key) {
        return (isset($this->roles[$key])) ? $this->roles[$key] : null;
    }

    public function getStaffRole() {
        return [2,3];
    }
}
