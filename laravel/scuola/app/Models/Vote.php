<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    protected $guarded = [];
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}


//qui definiamo le relazioni tra tabelle (in questo caso 1:n)
//i voti appartengono allo studente
//gli studenti hanno tanti voti
