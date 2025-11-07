<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'meter_id', 'consumption', 'amount', 'paid'];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function meter() {
        return $this->belongsTo(Meter::class);
    }
}
