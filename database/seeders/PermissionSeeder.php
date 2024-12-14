<?php

namespace Database\Seeders;

use App\Models\Navigation;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $navsArr = ['Dashboard','Inventory','Sales','Settings','Reports','Users'];
        $navArr = [];
        foreach ($navsArr as $nav) {
            $navArr[] = [
                'name' => $nav,
                'slug' => str_replace(' ', '-', strtolower($nav)),
                'parent_id' => '0',
                'block' => '1',
                'type' => 'all',
                'created_at' => date('Y-m-d H:i:s')
            ];
        }
        Navigation::insert($navArr);
        sleep(3);
        $navs = Navigation::all();
        if ($navs->count()) {
            $permissionNameArr = ['view','create','edit','del'];
//            $permissionArr = [];
            foreach ($navs as $nav) {
                if ($nav->type == 'view-only') {
                    $permissionArr = [
                        'name' => $nav->slug . '-view',
                        'guard_name' => 'web',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];

                    \Spatie\Permission\Models\Permission::findOrCreate($permissionArr['name']);
                } elseif ($nav->type == 'all') {
                    foreach ($permissionNameArr as $permissionName) {
                        $permissionArr = [
                            'name' => $nav->slug . '-' . $permissionName,
                            'guard_name' => 'web',
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                        \Spatie\Permission\Models\Permission::findOrCreate($permissionArr['name']);
                    }
                }
            }
            Navigation::where('updated_at', null)->update(['created_at'=>date('Y-m-d H:i:s')]);
            echo 'Permission Successfully Inserted!';
        } else {
            echo 'No new navigation added!';
        }

    }
}
