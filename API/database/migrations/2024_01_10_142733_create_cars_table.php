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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_category_id')->constrained()->cascadeOnDelete();
            $table->string('registration_number', 100)->unique();
            $table->string('brand', 50);
            $table->string('model', 100);
            $table->string('image', 255);
            $table->integer('mileage');
            $table->integer('seats');
            $table->string('gearbox', 25);
            $table->decimal('price');
            $table->text('description', 250);
            $table->foreignId('fuel_options_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
