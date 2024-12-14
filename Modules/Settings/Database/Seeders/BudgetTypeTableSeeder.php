<?php

namespace Modules\Settings\Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Settings\Entities\BudgetType;

class BudgetTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $newUsers = [
            [
                'name' => 'Development Scheme', 'department' => 'SH&MED', 'sector' => 'Health',
                'sub_sector' => 'Tertiary Health care Hospital (Children Hospital)'],
            [
                'name' => 'Non Development Scheme', 'department' => 'SH&MED', 'sector' => 'Health',
                'sub_sector' => 'Educational Affairs and Services (Uni. Of Child Health Sciences)'],
        ];
        foreach ($newUsers as $row) {
            $depart = Department::firstOrCreate(['name' => $row['department']]);
            BudgetType::firstOrCreate(
                [
                    'title' => $row['name'],
                    'sector' => $row['sector'],
                    'sub_sector' => $row['sub_sector'],
                    'department_idfk' => $depart->id,
                ]
            );
        }
    }
}
