<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_types', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('sector');
            $table->string('sub_sector');
            $table->integer('department_idfk');
            $table->foreignIdFor(\App\Models\User::class,'created_by');
            $table->foreignIdFor(\App\Models\User::class,'updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budget_types');
    }
}
