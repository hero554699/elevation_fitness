<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    
    protected $table = 'attendance';

    
    protected $primaryKey = 'attendance_id';

    
    protected $fillable = [
        'member_id',
        'branch_id',
        'check_in_date',
        'check_in_time',
    ];

    
    protected $casts = [
        'check_in_date' => 'date',
    ];

    
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }

    
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }
}
