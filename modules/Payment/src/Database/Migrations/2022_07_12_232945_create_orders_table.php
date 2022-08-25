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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
//            $table->foreignId('user_address_id')->nullable();
            $table->foreignIdFor(Coupon::class)->nullable()->constrained();
            $table->tinyInteger('status');
            $table->bigInteger('total_amount')->default(0);
            $table->bigInteger('coupon_amount')->default(0);
            $table->bigInteger('paying_amount');
            $table->string('payment_type');
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
        Schema::dropIfExists('orders');
    }
};
