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
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDeleteca();
            // $table->foreignId('category_id')->constrained('categories')->cascadeOnDeleteca();
            $table->unsignedInteger('category_id');

            $table->timestamps();
        });
        Schema::table('product_categories', function($table) {
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_categories');
    }
};
