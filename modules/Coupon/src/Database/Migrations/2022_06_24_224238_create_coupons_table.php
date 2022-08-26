<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Coupon\Models\Coupon;
use Modules\User\Models\User;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', Coupon::$types);
            $table->bigInteger('amount')->nullable();
            $table->string('percent')->nullable();
            $table->unsignedBigInteger('discount_ceiling')->nullable();
            $table->tinyInteger('use_type');
            $table->foreignIdFor(User::class)->nullable()->constrained();
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('coupons');
    }
};
