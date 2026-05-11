<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    
    protected $table = 'payments';

    
    protected $primaryKey = 'payment_id';


    protected $fillable = [
        'member_id',
        'plan_id',
        'amount',
        'payment_method',
        'payment_type',
        'payment_date',
        'receipt_no',
    ];


    protected $casts = [
        'amount'       => 'decimal:2',
        'payment_date' => 'date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }

    public function plan()
    {
        return $this->belongsTo(MembershipPlan::class, 'plan_id', 'plan_id');
    }
}
