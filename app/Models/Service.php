<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

    protected $table = 'services';

    public function getNumberAttribute()
    {
        /**
         * Define the alphabet
         */
        $codes = range('A', 'Z');
        if ($this->id % 260 === 0) {
            $range = 25;
        }
        else {
            $range = ceil(($this->id - (260 * floor($this->id / 260))) / 10) -1;
        }

        /** 
         * Number formatting 
         */
        $pad_length = 4;
        $pad_char = 0;
        $str_type = 'd';
        $format = "OM%{$pad_char}{$pad_length}{$str_type}{$codes[$range]}";

        $number = sprintf($format, $this->id);

        return $number;
    }

    public function getStatusLabelAttribute()
    {
        if ($this->status === 0) {
            if ($this->delivery) {
                $name = explode(' ', $this->delivery->agent->name)[0];
                return '<span class="ui horizontal label">servis - ' . $name . '</span>';
            }
            return '<span class="ui horizontal label">servis</span>';
        } else if ($this->status === 1) {
            return '<span class="ui horizontal green label">siap</span>';
        } else if ($this->status === 2) {
            return '<span class="ui horizontal teal label">selesai</span>';
        }
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->timezone('Asia/Jakarta')->format('d M Y H:i:s');
    }
    
    public function getFormattedUpdatedAtAttribute()
    {
        return $this->updated_at->timezone('Asia/Jakarta')->format('d M Y H:i:s');
    }

    public function getFormattedDownPaymentAttribute()
    {
        return 'Rp ' . number_format($this->down_payment, 0, ',', '.');
    }
   
    public function getFormattedFeeAttribute()
    {
        return 'Rp ' . number_format($this->fee, 0, ',', '.');
    }
   
    public function getRemainingPaymentAttribute()
    {
        return 'Rp ' . number_format($this->fee - $this->down_payment, 0, ',', '.');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function reservice()
    {
        return $this->update([
            'status' => 0,
            'fee' => 0,
        ]);
    }

    public function complete($fee = 0)
    {
        return $this->update([
            'status' => 1,
            'fee' => $fee === '' ? 0 : $fee,
        ]);
    }

    public function done()
    {
        return $this->update(['status' => 2]);
    }

    public function cancelDelivery()
    {
        return $this->update(['delivery_id' => null]);
    }
   
    public function cancelPayment()
    {
        $this->payment->delete();
        return $this->update(['status' => 1]);
    }

    public function isProcess()
    {
        return $this->status === 0; // Servis
    }

    public function isDone()
    {
        return $this->status === 1; // Siap
    }

    public function isCompleted()
    {
        return $this->status === 2; // Selesai
    }

    public function isDelivered()
    {
        return $this->delivery_id !== null;
    }
}
