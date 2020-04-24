<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function mentors()
    {
        return $this->hasMany('App\Models\Mentor');
    }

    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'web_site', 'inn_kpp', 'phone_number', 'confirmed', 'has_students','user_id'
    ];
}
