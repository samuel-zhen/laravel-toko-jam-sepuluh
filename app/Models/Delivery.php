<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $guarded = [];

    protected $table = 'deliveries';

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->timezone('Asia/Jakarta')->format('d M Y');
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
