<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function institute()
    {
        return $this->belongsTo('App\Models\Company');
    }

    protected $fillable = [
        'first_name', 'second_name', 'patronymic', 'confirmed', 'group', 'user_id', 'company_id'
    ];
}
