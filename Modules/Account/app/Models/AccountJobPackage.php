<?php

namespace Modules\Account\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Account\Database\factories\AccountJobPackageFactory;
use Illuminate\Http\Request;

class AccountJobPackage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    const ACTIVE    = 1;
    const INACTIVE  = 0;
    
    protected $table = 'account_job_package';

    protected $fillable = [
        'job_package_id',
        'account_id',
        'amount',
        'ckeditor_features'
    ];
    protected $casts = [
        'ckeditor_features' => 'array',
    ];
    // Relationship
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    public function job_package()
    {
        return $this->belongsTo(JobPackage::class);
    }
    protected static function newFactory(): AccountJobPackageFactory
    {
        //return AccountJobPackageFactory::new();
    }

    public function getCkeditorFeaturesAttribute($value)
    {
        return $value ? $value : [];
    }

    public function updateCKEditorConfig(Request $request)
    {
        $ckeditorFeatures = $request->input('ckeditor_features', []);
        
        foreach ($ckeditorFeatures as $accountJobPackageId => $settings) {
            $accountJobPackage = AccountJobPackage::find($accountJobPackageId);
            if ($accountJobPackage) {
                $accountJobPackage->update(['ckeditor_features' => $settings]);
            }
        }

        return redirect()->back()->with('success', __('Configuration updated successfully.'));
    }
}