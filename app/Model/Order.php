<?php
// app/Models/Order.php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
    protected $table = 'orders';
    
    protected $fillable = [
        'order_id',
        'client_name',
        'client_email',
        'client_phone',
        'client_district',
        'package_name',
        'package_price',
        'otp_code',
        'otp_status',
        'order_status',
        'message_response',
        'api_response',
        'ip_address',
        'user_agent'
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    
    // Scope for pending orders
    public function scopePending($query)
    {
        return $query->where('order_status', 'pending');
    }
    
    // Scope for confirmed orders
    public function scopeConfirmed($query)
    {
        return $query->where('order_status', 'confirmed');
    }
    
    // Accessor for formatted order ID
    public function getFormattedOrderIdAttribute()
    {
        return '#' . $this->order_id;
    }
}