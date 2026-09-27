<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    
    protected $fillable = [
        'account_name',
        'account_number',
        'bank_name',
        'type',
        'mobile_company',
        'status',
        'order_by',
        'routing_number',
        'branch_name'
    ];
    
    // Get bank payments only
    public static function getBankPayments()
    {
        return self::where('type', 'bank')
            ->where('status', 1)
            ->orderBy('order_by', 'asc')
            ->get();
    }
    
    // Get mobile payments only
    public static function getMobilePayments()
    {
        return self::where('type', 'mobile')
            ->where('status', 1)
            ->orderBy('order_by', 'asc')
            ->get();
    }
    
    // Get active payments
    public static function getActivePayments()
    {
        return self::where('status', 1)
            ->orderBy('order_by', 'asc')
            ->get();
    }
}