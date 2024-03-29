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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary')->nullable();
            $table->text('body')->nullable();
            $table->json('image')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('is_commentable');
            $table->timestamp('published_at')->nullable();
            $table->foreignId('author_id')->constrained('users');
            $table->foreignId('category_id')->constrained('blog_categories');
            $table->string('view_count')->default(0);
            $table->json('tags')->nullable();
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
        Schema::dropIfExists('posts');
    }
};
