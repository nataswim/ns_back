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
        Schema::create('swim_sets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('workout_id')->nullable()->constrained('workouts')->onDelete('cascade'); // Clé étrangère vers workouts
            $table->foreignId('exercise_id')->nullable()->constrained('exercises')->onDelete('set null'); // Clé étrangère vers exercises
            $table->integer('set_distance')->nullable();
            $table->integer('set_repetition')->nullable();
            $table->integer('rest_time')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('swim_sets');
    }
};
