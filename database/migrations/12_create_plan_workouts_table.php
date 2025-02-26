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
        Schema::create('plan_workouts', function (Blueprint $table) {
            $table->foreignId('plan_id')->constrained('plans')->onDelete('cascade');
            $table->foreignId('workout_id')->constrained('workouts')->onDelete('cascade');
            $table->primary(['plan_id', 'workout_id']); // Clé primaire composite
            $table->timestamps(); // Ajout des timestamps pour suivre la création et la modification des associations.
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plan_workouts');
    }
};
