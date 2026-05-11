<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';
    protected $primaryKey = 'branch_id';

    protected $fillable = [
        'branch_name',
        'location',
    ];

    public function members()
    {
        return $this->hasMany(Member::class, 'branch_id', 'branch_id');
    }

    public function workers()
    {
        return $this->hasMany(Worker::class, 'branch_id', 'branch_id');
    }

    public function coaches()
    {
        return $this->hasMany(Coach::class, 'branch_id', 'branch_id');
    }
}
