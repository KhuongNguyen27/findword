<?php

namespace Modules\AdminUser\app\Models;

use App\Models\AdminModel as Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AdminUser\Database\factories\AdminUserFactory;
use Modules\Staff\app\Models\UserStaff;
use DB;
use App\Models\UserEmployee;
use App\Traits\UploadFileTrait;
use Illuminate\Support\Str;


class AdminUser extends Model
{
    use HasFactory;
    use UploadFileTrait;
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
        'verify',
        'position',
        'points',
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
        if($request->phone){
            $phone = $request->phone;
            $query->whereHas('staff', function ($query) use ($phone){
                return $query->where('phone', 'LIKE','%'.$phone.'%');
            });
        }
        if($request->phone_employee){
            $phone = $request->phone_employee;
            $query->whereHas('employee', function ($query) use ($phone){
                return $query->where('phone', 'LIKE','%'.$phone.'%');
            });
        }
        if($request->address){
            $address = $request->address;
            $query->whereHas('staff', function ($query) use ($address){
                return $query->where('address', 'LIKE','%'.$address.'%');
            });
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
        DB::beginTransaction();
        try {
            $data = $request->except(['_token', '_method']);
            if ($request->hasFile('image')) {
                $data['image'] = self::uploadFile($request->file('image'), self::$upload_dir);
            }
            if ($data['password']) {
                $data['password'] = bcrypt($data['password']);
            } 
            $item = self::create($data);
            if ($type =='staff') {
                $data_user_staff = [
                    'user_id' => $item->id,
                    'phone' => $data['phone'],
                    'birthdate' => $data['birthdate'],
                    'experience_years' => $data['experience_years'],
                    'gender' => $data['gender'],
                    'city' => $data['city'],
                    'address' => $data['address'],
                    'outstanding_achievements' => $data['outstanding_achievements'],
                ];
                UserStaff::create($data_user_staff);
            }
            if ($type =='employee') {
                // xử lý slug
                $slug = $maybe_slug = Str::slug($data['name_company']);
                $next = 2;
                while (UserEmployee::where('slug', $slug)->first()) {
                    $slug = "{$maybe_slug}-{$next}";
                    $next++;
                }
                $user_employee = new UserEmployee;
                $user = User::get()->first();
                $user_employee->slug = $slug;
                $user_employee->user_id = $item->id;
                $user_employee->name = $data['name_company'];
                $user_employee->phone = $data['phone'];
                $user_employee->address = $data['address'];
                $user_employee->about = $data['about'];
                $user_employee->position = $data['position'];
                if ($user) {
                    $user->points = $user_employee->points;
                }
                if ($request->hasFile('background')) {
                    self::deleteFile($user_employee->background);
                    $data['background'] = self::uploadFile($request->file('background'), 'uploads/backgrounds');
                    $user_employee->background = $data['background'];
                }
                $user_employee->save();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
    public static function updateItem($id,$request,$type = ''){
        DB::beginTransaction();
        try {
            $data = $request->except(['_token', '_method']);
            $item = self::findOrFail($id);
            $userData   = $request->only(['name', 'email','password','type','status','verify','position','points']);
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
            if (isset($data['verify'])) {
                $verifyValue = $data['verify'];
            } else {
            }
            $item->update($userData);
            if($type == "staff"){
                $user_staff = UserStaff::where('user_id',$item->id)->first();
                $user_staff->phone = $data['phone'];
                $user_staff->birthdate = $data['birthdate'];
                $user_staff->experience_years = $data['experience_years'];
                $user_staff->gender = $data['gender'];
                $user_staff->city = $data['city'];
                $user_staff->address = $data['address'];
                $user_staff->outstanding_achievements = $data['outstanding_achievements'];
                $user_staff->save();
            }
            if($type =="employee"){
                $user_employee = UserEmployee::where('user_id',$item->id)->first();
                $user = User::get()->first();
                $user_employee->name = $data['name_company'];
                $user_employee->phone = $data['phone'];
                $user_employee->address = $data['address'];
                $user_employee->about = $data['about'];
                $user_employee->position = $data['position'];
                if ($user && isset($data['points'])) {
                    $user->points = $data['points'];
                }
                if ($request->hasFile('background')) {
                    self::deleteFile($user_employee->background);
                    $data['background'] = self::uploadFile($request->file('background'), 'uploads/backgrounds');
                    $user_employee->background = $data['background'];
                }
                $user_employee->save();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
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
    
    public function getBackgroundFmAttribute()
    {
        if ( $this->background != null) {
            if( strpos($this->background,'http') !== false ){
                return $this->background;
            }
            return asset('storage/images/'.$this->background);
        }
        return "/website-assets/images/backgroudemploy.jpg";
    }
}