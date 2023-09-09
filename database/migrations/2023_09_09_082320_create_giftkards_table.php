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
        Schema::create('giftkards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('amount_type');
            $table->decimal('amount', 13, 4);
            $table->decimal('amount_start', 13, 4);
            $table->decimal('amount_end', 13, 4);
            $table->longText('description');
            $table->string('location');
            $table->boolean('promote_wallet')->default(0)->change();
            $table->boolean('redeemable_points')->default(1)->change();
            $table->decimal('number_points', 13, 4);
            $table->decimal('creation_cost', 13, 4);
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
        Schema::dropIfExists('giftkards');
    }
};
