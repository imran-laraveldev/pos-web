<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('department_id');
            $table->string('code',20);
            $table->string('title');
            $table->string('color_code',255);
            $table->float('sale_price');
            $table->float('cost_price');
            $table->float('discount_rate', 2,2);
            $table->foreignIdFor(\Modules\Settings\Entities\Vendor::class,'vendor_id');
            $table->foreignIdFor(\App\Models\User::class,'created_by');
            $table->foreignIdFor(\App\Models\User::class,'updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('name');
            $table->float('sale_price');
            $table->float('cost_price');
            $table->float('discount_rate', 2,2);
            $table->foreignIdFor(\App\Models\User::class,'created_by');
            $table->foreignIdFor(\App\Models\User::class,'updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->unique();
            $table->string('slug');
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
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_sizes');
        Schema::dropIfExists('product_categories');
    }
}
