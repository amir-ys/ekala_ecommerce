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
        Schema::create('attribute_group_category', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('attribute_group_id')->constrained('attribute_groups');
            $table->primary(['category_id','attribute_group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_group_category');
    }
};
