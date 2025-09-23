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
        Schema::create('appsettings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('telephone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->text('contactus')->nullable();

            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('footer_text')->nullable();

            $table->string('logo')->nullable();
            $table->string('logo_footer')->nullable();
            $table->string('favicon')->nullable();

            $table->text('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();

            $table->string('whatsapp')->nullable();
            $table->string('website',150)->nullable();
            $table->string('facebook',100)->nullable();
            $table->string('status_facebook',10)->nullable();
            $table->string('twitter',100)->nullable();
            $table->string('status_twitter',10)->nullable();
            $table->string('youtube',100)->nullable();
            $table->string('status_youtube',10)->nullable();
            $table->string('tiktok',100)->nullable();
            $table->string('status_tiktok',10)->nullable();
            $table->string('instagram')->nullable();
            $table->string('status_instagram',10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appsettings');
    }
};
