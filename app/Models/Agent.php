<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $guarded = [];

    protected $table = 'agents';

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
