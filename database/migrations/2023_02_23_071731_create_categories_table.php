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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('variations');

            $table->string('name');
            $table->string('description');
            $table->string('tags');
            // $table->unsignedBigInteger('variation_id');
            // $table->foreign('variation_id')->references('id')->on('variations');
            $table->enum('status' , ['Published', 'Unpublished'])->default('Published');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('categories');
    }
};
