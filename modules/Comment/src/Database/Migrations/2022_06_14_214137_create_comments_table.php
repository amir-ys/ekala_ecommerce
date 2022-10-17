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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->foreignId('parent_id')->nullable()->constrained('comments');
            $table->foreignIdFor(\Modules\User\Models\User::class)->constrained();
            $table->foreignId('commentable_id');
            $table->string('commentable_type');
            $table->tinyInteger('is_approved')->default(\Modules\Comment\Models\Comment::STATUS_PENDING);
            $table->tinyInteger('is_seen')->default(\Modules\Comment\Models\Comment::NOT_SEEN);
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
        Schema::dropIfExists('comments');
    }
};
