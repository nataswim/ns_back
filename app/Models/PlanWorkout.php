<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanWorkout extends Model
{
     // pas besoin de ce modèle pour le moment -- 
     // Il Y A pas de colonnes supplémentaires dans la table pivot plan_workouts
     // Laravel gère automatiquement la relation many-to-many entre les tables plans et workouts
}
