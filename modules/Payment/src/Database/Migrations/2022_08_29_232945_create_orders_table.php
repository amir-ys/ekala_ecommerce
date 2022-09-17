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
            $table->foreignId('user_address_id')->nullable()->constrained('user_addresses');
            $table->foreignIdFor(Modules\Payment\Models\Payment::class)->nullable()->constrained();
            $table->foreignIdFor(\Modules\Product\Models\Delivery::class)->nullable()->constrained('delivery');
            $table->timestamp('delivery_date')->nullable();
            $table->tinyInteger('delivery_status')->nullable();
            $table->decimal('final_amount' , 20 , 3)->default(0);
            $table->decimal('discount_amount' , 20 , 3)->default(0);
            $table->foreignIdFor(Coupon::class)->nullable()->constrained('coupons');
            $table->decimal('coupon_discount_amount' , 20 , 3)->nullable();
            $table->foreignIdFor(\Modules\Coupon\Models\CommonDiscount::class)->nullable()->constrained('common_discounts');
            $table->decimal('common_discount_amount' , 20 , 3)->nullable();
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
        Schema::dropIfExists('orders');
    }
};
