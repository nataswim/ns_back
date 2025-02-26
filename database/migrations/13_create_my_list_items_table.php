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
        Schema::create('mylist_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('mylist_id')->constrained('mylist')->onDelete('cascade'); // Clé étrangère vers mylist
            $table->bigInteger('item_id'); // ID de l'élément (polymorphique)
            $table->string('item_type'); // Type de l'élément (polymorphique)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mylist_items');
    }
};
