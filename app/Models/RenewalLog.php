<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RenewalLog extends Model
{
    
    protected $table = 'renewal_log';

    
    protected $primaryKey = 'renewal_id';

    
    protected $fillable = [
        'member_id',
        'old_plan_id',
        'new_plan_id',
        'old_expiry',
        'new_expiry',
    ];

    
    protected $casts = [
        'old_expiry' => 'date',
        'new_expiry' => 'date',
    ];

    
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }

    
    public function newPlan()
    {
        return $this->belongsTo(MembershipPlan::class, 'new_plan_id', 'plan_id');
    }
}
