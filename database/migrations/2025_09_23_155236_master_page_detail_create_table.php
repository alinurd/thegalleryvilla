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
        Schema::create('master_page_detail', function (Blueprint $table) {
            // wajib
            $table->id();
            $table->integer('sort')->default(0);
            $table->boolean('status')->default(1);
   
            $table->string('title')->nullable(); 
            $table->text('about')->nullable(); 
            $table->text('location')->nullable(); 
            $table->text('facility')->nullable(); 
            $table->text('event_type')->nullable();  
            $table->text('pin_point')->nullable();  
            

            // wajib
            // $table->text('description')->nullable();
            $table->string('image')->nullable();

            $table->timestamps();
 
        });

 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_page_detail');
    }
};
