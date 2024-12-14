<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableAddLocality extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('province_idfk')->nullable(false)->after('password');
            $table->integer('division_idfk')->nullable(false)->after('province_idfk');
            $table->integer('district_idfk')->nullable(false)->after('division_idfk');
            $table->string('tehsil_ids')->nullable(false)->after('district_idfk');
            $table->string('fund_center_idfk')->nullable(false)->after('tehsil_ids');
            $table->string('cost_center_idfk')->nullable(false)->after('fund_center_idfk');
            $table->string('ddo_idfk')->nullable(false)->after('cost_center_idfk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('province_idfk');
            $table->dropColumn('division_idfk');
            $table->dropColumn('district_idfk');
            $table->dropColumn('tehsil_ids');
            $table->dropColumn('fund_center_idfk');
            $table->dropColumn('cost_center_idfk');
            $table->dropColumn('ddo_idfk');
        });
    }
}
