<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\VarDumper\VarDumper;

/**
 * Class UserSeeder
 *
 * @package Database\Seeds
 */
class UserSeeder extends Seeder
{

    /**
     * Seeds users Table
     */
    public function run()
    {
        $role = Role::findOrCreate('Admin','web');
        $role->syncPermissions(Permission::all());

        # Deleting Existing Records
        DB::table('users')->delete();

        # Insert users
        foreach ($this->_users() as $key => $user) {
            $user = \App\Models\User::create($user);
            $user->assignRole($role);
        }
        // Creating 41 secretary
        $role = Role::findOrCreate('Manager','web');
        $role->syncPermissions(Permission::all());
        $role = Role::findOrCreate('Sales','web');
        $role->syncPermissions(Permission::all());

        $userExist = [];
        $newUsers = [
            ['name' => 'manager', 'role' => 'Manager'],
            ['name' => 'sales', 'role' => 'Sales'],
        ];
        foreach ($newUsers as $row) {

            $role = Role::findOrCreate($row['role'],'web');

            $short_name = str_replace('&', 'n', trim($row['name']));
            $short_name = strtolower(str_replace(' ', '.', $short_name));
            $short_name = rtrim($short_name, '.');
            $short_name .= in_array($short_name,$userExist) ? '1': '';
            if (!in_array($short_name,$userExist)) {
                $user = \App\Models\User::firstOrCreate([
                    'name' => trim($row['name']),
                    'email' => $short_name . '@webserve.com.pk',
                    'password' => bcrypt('W$@112233'),
                    'province_idfk' => 1,
                    'division_idfk' => 1,
                    'district_idfk' => 1,
                    'tehsil_ids' => 1,
                    'email_verified_at' => now(),
                ]);
                $user->assignRole($role);
                $userExist[] = $short_name;
            }
        }

        VarDumper::dump(sprintf(__('messages.seeder_success_message'), 'users'));
    }


    /**
     * @return array
     */
    private function _users()
    {
        return [
            [
                'name' => 'Super Admin',
                'email' => 'admin@webserve.com.pk',
                'password' => bcrypt('12345678'),
                'province_idfk' => 1,
                'division_idfk' => 1,
                'district_idfk' => 1,
                'tehsil_ids' => 1,
                'email_verified_at' => now()
            ],
            [
                'name' => 'System User',
                'email' => 'system@webserve.com.pk',
                'password' => bcrypt('12345678'),
                'province_idfk' => 1,
                'division_idfk' => 1,
                'district_idfk' => 1,
                'tehsil_ids' => 1,
                'email_verified_at' => now()
            ],
            [
                'name' => 'Imran Saleem',
                'email' => 'imran@webserve.com.pk',
                'password' => bcrypt('12345678'),
                'province_idfk' => 1,
                'division_idfk' => 1,
                'district_idfk' => 1,
                'tehsil_ids' => 1,
                'email_verified_at' => now()
            ]
        ];
    }
}
