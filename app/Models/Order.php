<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_date', 'order_created_by', 'customer_id', 'deliver_charge', 'extra_charge', 'paid_amount', 'fully_paid', 'total_amount',
    ];

    public function Customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
