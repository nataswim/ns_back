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
        Schema::create('uploads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('filename');
            $table->string('path');
            $table->string('type')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Clé étrangère
            $table->timestamps();
        });

        // Dans les migrations des tables exercises et pages, ajouter les clés étrangères vers uploads
        Schema::table('exercises', function (Blueprint $table) {
            $table->foreignId('upload_id')->nullable()->constrained('uploads')->onDelete('set null');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->foreignId('upload_id')->nullable()->constrained('uploads')->onDelete('set null');
        });
    }

    public function down(): void
    {
        // Supprimer les clés étrangères dans les tables exercises et pages
        Schema::table('exercises', function (Blueprint $table) {
            $table->dropForeign(['upload_id']);
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropForeign(['upload_id']);
        });

        Schema::dropIfExists('uploads');
    }
};
