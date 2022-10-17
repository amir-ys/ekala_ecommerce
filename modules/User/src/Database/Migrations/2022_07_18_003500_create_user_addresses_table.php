<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\User\Models\City;
use Modules\User\Models\Province;
use Modules\User\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(City::class)->constrained();
            $table->foreignIdFor(Province::class)->constrained();
            $table->string('phone_number' , 20);
            $table->text('address');
            $table->string('postal_code' , 10);
            $table->string('receiver');
            $table->string('is_active')->default(\Modules\User\Models\UserAddress::STATUS_INACTIVE);
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
        Schema::dropIfExists('user_addresses');
    }
};
