<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Navigation;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleArr = ['SuperAdmin','Admin'];
        foreach ($roleArr as $roleName) {
            Role::findOrCreate($roleName, 'web');
        }
        echo 'Roles created successfully!' . PHP_EOL;

        $departArr = [
            ['SCM', 'Sales'],
            ['PITB', 'Punjab IT Board'],
        ];
        foreach ($departArr as $row) {
            Department::firstOrCreate([
                'name' => $row[0],
                'name_ur' => $row[1],
                'slug' => strtolower($row[0]),
            ]);
        }
        echo 'Departments created successfully!' . PHP_EOL;
    }
}
