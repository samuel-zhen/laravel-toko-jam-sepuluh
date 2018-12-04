<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $guarded = [];

    protected $table = 'staff';

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
