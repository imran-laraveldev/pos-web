<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDynamicFormsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dynamic_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('navigation_id');
            $table->string('node_name', 100);
            $table->tinyInteger('node_sort_order')->unsigned();
            $table->tinyInteger('form_type')->default(1)->comment('1: listing,2:dropdowns');
            $table->string('schema_name',100);
            $table->enum('allowed_operations',['view','create','update','delete','all'])->default('all');
            $table->boolean('migrate')->default(false);
            $table->boolean('pagination')->default(true);
            $table->boolean('activate_workflow')->default(false);
            $table->boolean('soft_delete')->default(false);
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
        });

        Schema::create('dynamic_form_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dynamic_form_id')->constrained('dynamic_forms','id'); // Foreign key referencing dynamic_forms table
            $table->string('field_name',100);
            $table->enum('field_type',['integer','float','varchar','text','boolean','date','datetime']);
            $table->string('field_length');
            $table->string('default_value');
            $table->string('label_name');
            $table->enum('control_type',['text','numeric','select','textarea','checkbox','radio','date','datetime']);
            $table->json('select_options')->nullable();
            $table->string('checklist')->nullable();
            $table->string('control_class');
            $table->boolean('is_required')->default(true);
            $table->boolean('is_filter')->default(true);
            $table->boolean('visible_list')->default(true);
            $table->boolean('total_numeric_field')->default(false);
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dynamic_forms');
        Schema::dropIfExists('dynamic_form_entries');
    }
}
