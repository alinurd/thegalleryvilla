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
        Schema::create('master_facility', function (Blueprint $table) {
            // wajib
            $table->id();
            $table->integer('sort')->default(0);
            $table->boolean('status')->default(1);

            $table->foreign('page_datail_id')->references('id')->on('master_page_detail')->onDelete('cascade');
            $table->unsignedBigInteger('page_datail_id');

            $table->string('title')->nullable(); 

            // wajib
            $table->text('description')->nullable();
            $table->string('image')->nullable();

            $table->timestamps();
 
        });

 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_facility');
    }
};
