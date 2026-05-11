<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberAudit extends Model
{

    protected $table = 'member_audit';

    protected $primaryKey = 'audit_id';

    protected $fillable = [
        'member_id',
        'action',
        'old_status',
        'new_status',
        'reference',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }
}
