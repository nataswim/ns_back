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
        Schema::table('users', function (Blueprint $table) {
            // Ajouter les nouvelles colonnes si elles n'existent pas
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique()->nullable()->after('id');
            }
            if (!Schema::hasColumn('users', 'first_name')) {
                $table->string('first_name')->nullable()->after('username');
            }
            if (!Schema::hasColumn('users', 'last_name')) {
                $table->string('last_name')->nullable()->after('first_name');
            }

            // Renommer la colonne 'name' en 'username' si elle existe et si old_name n'existe pas.
            if (Schema::hasColumn('users', 'name') && !Schema::hasColumn('users', 'old_name')) {
                $table->renameColumn('name', 'old_name');
                $table->renameColumn('old_name', 'username');
            }

            // Modifier role_id pour ajouter la contrainte si elle n'existe pas
            if (Schema::hasColumn('users', 'role_id')) {
                // Vérifier si la contrainte existe déjà
                $foreignKeys = DB::select("SELECT CONSTRAINT_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'role_id' AND REFERENCED_TABLE_NAME = 'roles'");
                if (empty($foreignKeys)) {
                    $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('set null')->change();
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprimer les nouvelles colonnes si elles existent
            if (Schema::hasColumn('users', 'username')) {
                $table->dropColumn(['username', 'first_name', 'last_name']);
            }

            // Modifier role_id pour supprimer la contrainte
            if (Schema::hasColumn('users', 'role_id')) {
                $table->dropForeign(['role_id']);
            }

            // Renommer la colonne 'username' en 'name' si elle existe.
            if (Schema::hasColumn('users', 'username')) {
                $table->renameColumn('username', 'name');
            }
        });
    }
};