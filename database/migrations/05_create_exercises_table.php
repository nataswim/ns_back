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
        Schema::create('exercises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('exercise_level')->nullable();
            $table->string('exercise_category')->nullable();
            $table->foreignId('upload_id')->nullable()->constrained('uploads')->onDelete('set null'); // Clé étrangère vers uploads
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Clé étrangère vers users
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
