<?php

namespace Modules\Transaction\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Transaction\Database\factories\TransactionFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transactions";
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'item_id',
        'status',
    ];
    
    protected static function newFactory(): TransactionFactory
    {
        //return TransactionFactory::new();
    }

    //RelationShip
    function user(){
        return $this->belongsTo(User::class);
    }

    //Feature
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