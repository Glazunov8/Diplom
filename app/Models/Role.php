<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'rules';

    public function users()
    {
        return $this->hasMany('App\Models\Users');
    }

    protected $fillable = [
        'name'
    ];
}
