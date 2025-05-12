<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function subServices()
    {
        return $this->hasMany(SubService::class);
    }
}
