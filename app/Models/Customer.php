<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'mobile', 'email', 'address_line1', 'address_line2', 'city', 'state', 'pincode',
    ];

    public function Order()
    {
        return $this->hasMany(Order::class);
    }
}
