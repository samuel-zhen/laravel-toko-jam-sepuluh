<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    protected $table = 'payments';

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->timezone('Asia/Jakarta')->format('d M Y H:i:s');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
