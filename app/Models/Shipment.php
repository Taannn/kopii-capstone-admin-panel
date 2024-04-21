<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    protected $table = 'shipment';
    protected $primaryKey = 'order_id';
    public function customer_orders()
    {
        return $this->belongsTo(CustomerOrder::class, 'order_id', 'order_id');
    }
}
