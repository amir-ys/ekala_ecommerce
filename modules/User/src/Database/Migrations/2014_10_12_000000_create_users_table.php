<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable()->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('national_code' , 10)->nullable();
            $table->string('card_number' , 16)->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('mobile')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('profile')->nullable();
            $table->tinyInteger('status')->default(User::STATUS_ACTIVE);
            $table->tinyInteger('is_admin')->default(User::ROLE_USER);
            $table->boolean('2fa_enable')->default(\Modules\User\Models\User::TWO_FACTOR_AUTH_DISABLE);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
