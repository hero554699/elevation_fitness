<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'member_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'branch_id',
        'plan_id',
        'membership_start',
        'membership_end',
        'status',
        'payment_status',
        'reference_no',
        'last_checkin',
    ];

    protected $casts = [
        'membership_start' => 'date',
        'membership_end'   => 'date',
        'last_checkin'     => 'datetime',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    public function plan()
    {
        return $this->belongsTo(MembershipPlan::class, 'plan_id', 'plan_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'member_id', 'member_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'member_id', 'member_id');
    }

    public function renewals()
    {
        return $this->hasMany(RenewalLog::class, 'member_id', 'member_id');
    }

    public function audits()
    {
        return $this->hasMany(MemberAudit::class, 'member_id', 'member_id');
    }
}
