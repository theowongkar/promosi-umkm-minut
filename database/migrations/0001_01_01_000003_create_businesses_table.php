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
        Schema::create('business_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('business_category_id')->constrained('business_categories')->onDelete('restrict');
            $table->string('name', 100);
            $table->string('slug')->unique();
            $table->string('image_path')->nullable();
            $table->string('owner_name', 100);
            $table->string('owner_nik', 16);
            $table->string('owner_phone', 20);
            $table->string('province');
            $table->string('city');
            $table->string('district');
            $table->string('village');
            $table->string('address');
            $table->enum('business_type', ['Mikro', 'Kecil', 'Menengah'])->default('Mikro');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_categories');
        Schema::dropIfExists('businesses');
    }
};
