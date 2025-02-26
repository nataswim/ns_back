<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 🇬🇧 Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workout_exercises', function (Blueprint $table) {
            $table->foreignId('workout_id')->constrained('workouts')->onDelete('cascade');
            $table->foreignId('exercise_id')->constrained('exercises')->onDelete('cascade');
            $table->primary(['workout_id', 'exercise_id']); // Clé primaire composite
            $table->timestamps(); // Ajout des timestamps pour suivre la création et la modification des associations.
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workout_exercises');
    }
};
