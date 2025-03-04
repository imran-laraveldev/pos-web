<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_idfk');
            $table->string('from_company');
            $table->date('visit_date_from');
            $table->date('visit_date_to');
            $table->time('visit_time');
            $table->string('reference_code');
            $table->string('reason');
            $table->integer('branch_idfk');
            $table->integer('gate_idfk');
            $table->integer('type_idfk');
            $table->enum('identity_type',['cnic','employee_card','passport','driving_license','family_no'])->default('cnic');
            $table->string('identity_number');
            $table->enum('transport_mode',['Pedestrian','Motorcycle','Car','None'])->default('Pedestrian');
            $table->string('transport_registration_number')->nullable();
            $table->enum('status',['pending','approved','rejected','blocked','none'])->default('pending');
            $table->dateTime('check_in_at')->nullable();
            $table->dateTime('check_out_at')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('visit_history', function (Blueprint $table) {
            $table->id();
            $table->string('visit_idfk');
            $table->integer('branch_idfk');
            $table->integer('gate_idfk');
            $table->integer('type_idfk');
            $table->string('action')->default('check-in');
            $table->integer('created_by');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->enum('identity_type',['cnic','employee_card','passport','driving_license','family_no']);
            $table->string('identity_number');
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('cell_no')->nullable();
            $table->string('image_url')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('branch_idfk')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('visits');
        Schema::dropIfExists('visit_history');
        Schema::dropIfExists('visitors');
    }
}
