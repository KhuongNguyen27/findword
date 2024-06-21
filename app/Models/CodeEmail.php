<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeEmail extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'code',
        'status',
    ];

    const ACTIVE = 1;
    const INACTIVE = 0;
    public function getStatusFmAttribute(){
        switch ($this->status) {
            case self::ACTIVE:
                return '<span class="lable-table bg-success-subtle text-success rounded border border-success-subtle font-text2 fw-bold">'.__('sys.active').'</span>';
                break;
            case self::INACTIVE:
                return '<span class="lable-table bg-warning-subtle text-warning rounded border border-warning-subtle font-text2 fw-bold">'.__('sys.inactive').'</span>';
                break;
        }
    }
}
