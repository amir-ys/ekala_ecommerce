<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('brand_id')->constrained();
            $table->text('description')->nullable();
            $table->bigInteger('price');
            $table->integer('quantity');
            $table->bigInteger('special_price')->nullable();
            $table->timestamp('special_price_start')->nullable();
            $table->timestamp('special_price_end')->nullable();
            $table->tinyInteger('is_active');
            $table->tinyInteger('is_marketable')->default();
            $table->softDeletes();
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
