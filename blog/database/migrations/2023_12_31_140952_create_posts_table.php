<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('postId')->nullable();
           $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->text('image')->nullable();
            $table->string('name')->nullable();
            $table->string('userId')->nullable();
            $table->timestamp('publishing_date')->nullable();
            $table->string('post_status')->nullable();
            $table->string('usertype')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
