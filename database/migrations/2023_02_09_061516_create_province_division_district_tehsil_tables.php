<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvinceDivisionDistrictTehsilTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignIdFor(\App\Models\User::class,'created_by');
            $table->foreignId('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_ur')->nullable();
            $table->string('slug')->unique();
            $table->foreignIdFor(\App\Models\Province::class,'province_idfk');
            $table->foreignIdFor(\App\Models\User::class,'created_by');
            $table->foreignId('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_ur')->nullable();
            $table->string('slug')->unique();
            $table->foreignIdFor(\App\Models\Division::class,'division_idfk');
            $table->foreignIdFor(\App\Models\User::class,'created_by');
            $table->foreignId('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tehsils', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_ur')->nullable();
            $table->string('slug')->unique();
            $table->foreignIdFor(\App\Models\District::class,'district_idfk');
            $table->foreignIdFor(\App\Models\User::class,'created_by');
            $table->foreignId('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_ur')->nullable();
            $table->string('slug')->unique();
            $table->integer('parent_idfk')->nullable(false)->default(0);
            $table->foreignIdFor(\App\Models\User::class,'created_by');
            $table->foreignId('updated_by')->nullable();
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
        Schema::dropIfExists('provinces');
        Schema::dropIfExists('divisions');
        Schema::dropIfExists('districts');
        Schema::dropIfExists('tehsils');
        Schema::dropIfExists('departments');
    }
}
