<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('product_type');
            $table->string('image');
            $table->string('name');
            $table->boolean('feature')->default(0)->change();
            $table->string('rank');
            $table->decimal('price', 13, 4);
            $table->string('upc');
            $table->longText('description');
            $table->string('product_options');
            $table->decimal('discount', 13, 4);
            $table->decimal('price_after_disc', 13, 4);
            $table->string('instore')->default('active')->change();
            $table->string('stock_qantity');
            $table->boolean('points_redeemable')->default(0)->change();
            $table->string('no_of_points');
            $table->string('points_earned');
            $table->boolean('have_tax')->default(0)->change();
            $table->string('terms_conditions');
            $table->int('konnect_category_id');
            $table->int('category_id');
            $table->string('tags');
            $table->string('cross_selling_products');
            $table->string('cross_selling_products');
            $table->decimal('creation_cost', 13, 4);
            $table->string('custom_attribute');
            $table->string('available_attribute');
            $table->string('custom_attribute');
            $table->string('variation_all_attribute');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
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
        Schema::dropIfExists('products');
    }
};
