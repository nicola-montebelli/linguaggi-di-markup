<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);

    }

    public function profile():HasOne
    {
        return $this->hasOne(StudentProfile::class);
    }
    
    public function courses():BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }
}

//App\Models\Student::with('votes')->where('id', 1)->get()      //Collection  
//App\Models\Student::with('votes')->where('id', 1)->first()   //App\Models\Student
//App\Models\Student::with('votes')->where('id', 1)   //Illuminate\Database\Eloquent\Builder 
//App\Models\Student::find(1)->votes      //Collection di voti dello studente con id 1
//App\Models\Student::find(1)->votes() Illuminate\Database\Eloquent\Relations\HasMany 
//App\Models\Student::find(1)->votes()->where('value','>',8)->get()   //Collection di voti dello studente con id 1 con valore maggiore di 8
//App\Models\Student::with(['profile','votes'])->where('id',1)->get()    //estrarre lo studente con id 1 e tutte le sue votazioni e il suo profilo