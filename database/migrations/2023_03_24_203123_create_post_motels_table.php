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
        Schema::create('post_motels', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->float('price')->nullable();
            $table->string('purpose')->nullable();
            $table->string('acreage')->nullable();
            $table->string('status')->nullable();
            $table->float('deposit')->nullable();
            $table->string('structure')->nullable();
            $table->string('shared')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->string('image5')->nullable();
            $table->string('image6')->nullable();
            $table->string('description')->nullable();
            $table->string('address_address')->nullable();
            $table->string('address_latitude')->nullable();
            $table->string('address_longitude')->nullable();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('location_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_motels');
    }
};
