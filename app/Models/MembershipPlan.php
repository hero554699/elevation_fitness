<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    
    protected $table = 'membership_plans';

    
    protected $primaryKey = 'plan_id';

    protected $fillable = [
        'plan_name',
        'duration_days',
        'price',
        'description',
    ];

    protected $casts = [
        'price'         => 'decimal:2',
        'duration_days' => 'integer',
    ];

    
    public function members()
    {
        return $this->hasMany(Member::class, 'plan_id', 'plan_id');
    }

    
    public function payments()
    {
        return $this->hasMany(Payment::class, 'plan_id', 'plan_id');
    }
}
