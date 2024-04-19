<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends AdminModel
{
    use HasFactory;
    protected $fillable =
    [
        'name',
        'price',
        'description',
        'position',
    ];

    public static function overrideUpdateItem($id,$data,$request){
        $item = self::findOrFail($id);
        if( !empty($data['job_package_ids']) ){
            foreach( $data['job_package_ids'] as $job_package_id => $amount ){
                AccountJobPackage::updateOrCreate(
                    [
                        'job_package_id' => $job_package_id,
                        'account_id' => $id,
                    ],
                    [
                        'job_package_id' => $job_package_id,
                        'account_id' => $id,
                        'amount' => $amount,
                    ]
                );
            }
            unset($data['job_package_ids']);
            $item->update($data);
        }
    }
    public static function overrideFindItem($id,$table = ''){
        $item = self::findOrFail($id);
        $setting_job_packages = [];
        $job_packages = JobPackage::all();
        foreach( $job_packages as $job_package ){
            $setting_job_packages[$job_package->id] = AccountJobPackage::where('account_id',$id)
            ->where('job_package_id',$job_package->id)->value('amount');
        }
        $item->setting_job_packages = $setting_job_packages;
        return $item;
    }
}
