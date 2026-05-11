<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $table = 'workers';
    protected $primaryKey = 'worker_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'position',
        'status',
        'branch_id',
        'date_hired',
        'certification_path',
    ];

    protected $casts = [
        'date_hired' => 'date',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }
}
