<?php

namespace Modules\AdminUser\app\Models;

use App\Models\AdminModel as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AdminUser\Database\factories\AdminUserFactory;

class AdminUser extends Model
{
    use HasFactory;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'status',
    ];
    
    protected static function newFactory(): AdminUserFactory
    {
        //return AdminUserFactory::new();
    }
    public static function getItems($request = null,$limit = 20,$type = ''){
        $query = self::query(true);
        if($request->type){
            $query->where('type',$request->type);
        }else{
            $query->where('type','user');
        }
        if($request->name){
            $query->where('name','LIKE','%'.$request->name.'%');
        }
        if($request->email){
            $query->where('email','LIKE','%'.$request->email.'%');
        }
        if($request->status !== NULL){
            $query->where('status',$request->status);
        }
        $query->orderBy('id','DESC');
        $items = $query->paginate($limit);
        return $items;
    }
    public static function findItem($id,$type = ''){
        return self::findOrFail($id);
    }
    public static function saveItem($request,$type = ''){
        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('image')) {
            $data['image'] = self::uploadFile($request->file('image'), self::$upload_dir);
        }
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } 
        self::create($data);
    }
    public static function updateItem($id,$request,$type = ''){
        $item = self::findOrFail($id);
        $userData   = $request->only(['name', 'email','password','type','status']);
        if ($request->hasFile('image')) {
            self::deleteFile($item->image);
            $userData['image'] = self::uploadFile($request->file('image'), self::$upload_dir);
        }
        if ($userData['password']) {
            $userData['password'] = bcrypt($userData['password']);
        }else{
            unset($userData['password']);
        }
        if($item->{$item->type}){
            $custom_fields = $request->only($item->{$item->type}->custom_fields);
            $item->{$item->type}()->update($custom_fields);
        }
        $item->update($userData);
    }
    public static function showUserCVs($request,$limit = 20,$type = ''){
        $id = $request->id;
        $modelClass = '\App\Models\\' .$type;
        $query = $modelClass::query(true);
        // dd($query);
        $items = $query->where('user_id',$id)->paginate($limit);
        return $items;
    }
    public static function showCV($request,$type = ''){
        $id = $request->id;
        $modelClass = '\App\Models\\' .$type;
        $query = $modelClass::query(true);
        $item = $query->findOrfail($id);
        return $item;
    }
    public static function deleteItem($id,$type = ''){
        $item = self::findItem($id);
        self::deleteFile($item->image);
        return $item->delete();
    }


    // Custom relation
    public function staff(){
        return $this->hasOne(\App\Models\UserStaff::class,'user_id');
    }
    public function employee(){
        return $this->hasOne(\App\Models\UserEmployee::class,'user_id');
    }
    
    
}