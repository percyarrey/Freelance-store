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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('imgpath');
            $table->string('name');
            $table->unsignedBigInteger('category')->nullable();
            $table->foreign('category')->references('id')->on('categories')->onDelete('cascade');
            $table->bigInteger('price'); // Corrected column type
            $table->text('description');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
