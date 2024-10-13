<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('home_banners', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('text');  // Nullable text field for the banner text
            $table->string('link');  // Nullable link field for the banner link
            $table->string('image');  // Nullable image field for the banner image
            $table->timestamps();  // Created at and updated at timestamps
            
        });
        
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_banners');
    }
};
