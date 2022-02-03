<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
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
            $table->foreignId("category_id")->constrained()->cascadeOnDelete();
            $table->foreignId("user_id");
            $table->string("title");
            $table->integer('views_count')->default(0);
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->string("thumbnail")->nullable();
            $table->string("slug");
            $table->text("body");
            $table->text("excerpt");
            $table->timestamps();
            $table->timestamp("published_at")->nullable();
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
}
