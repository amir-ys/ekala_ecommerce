<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\User\Models\User;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->bigInteger('amount');
            $table->string('token')->nullable();
            $table->string('gateway_name')->nullable()->comment('from payment type online');
            $table->string('cash_receiver')->nullable()->comment('for payment type cash');
            $table->string('pay_date')->nullable()->comment('for payment type offline');
            $table->string('description')->nullable();
            $table->tinyInteger('payment_type');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('payments');
    }
};
