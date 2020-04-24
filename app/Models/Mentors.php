<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mentors extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    protected $fillable = [
        'first_name', 'second_name', 'patronymic', 'technology_stack', 'company_id', 'user_id'
    ];
}
