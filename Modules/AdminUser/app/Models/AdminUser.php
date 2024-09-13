<?php

namespace Modules\AdminUser\app\Models;

use App\Models\AdminModel as Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AdminUser\Database\factories\AdminUserFactory;
use Modules\Staff\app\Models\UserStaff;
use Modules\AdminPost\app\Models\UserCV;
use DB;
use App\Models\UserEmployee;
use App\Traits\UploadFileTrait;
use Carbon\Carbon;
use Illuminate\Support\Str;


class AdminUser extends Model
{
    use HasFactory;
    use UploadFileTrait;

    const ACTIVE = 1;

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
        'tax_code',
        'group_id',
    ];

    protected static function newFactory(): AdminUserFactory
    {
        //return AdminUserFactory::new();
    }
    public function userCVs()
    {
        return $this->hasMany(UserCV::class, 'user_id');
    }

    public static function getItems($request = null, $limit = 20, $type = '')
    {
        $query = self::query(true);
        if ($request->type) {
            $query->where('type', $request->type);
        } else {
            $query->where('type', 'user');
        }
        // if ($request->name) {
        //     $query->where('name', 'LIKE', '%' . $request->name . '%');
        // }
        if ($request->name) {
            $name = $request->name;
            $query->whereHas('employee', function ($query) use ($name) {
                $query->where('name', 'LIKE', '%' . $name . '%');
            });
        }
        if ($request->email) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        }

        if ($request->phone) {
            $phone = $request->phone;
            $query->whereHas('staff', function ($query) use ($phone) {
                return $query->where('phone', 'LIKE', '%' . $phone . '%');
            });
        }
        if ($request->phone_employee) {
            $phone = $request->phone_employee;
            $query->whereHas('employee', function ($query) use ($phone) {
                return $query->where('phone', 'LIKE', '%' . $phone . '%');
            });
        }
        if ($request->address) {
            $address = $request->address;
            $query->whereHas('staff', function ($query) use ($address) {
                return $query->where('address', 'LIKE', '%' . $address . '%');
            });
        }
        if ($request->status !== NULL) {
            $query->where('status', $request->status);
        }
        $query->orderBy('id', 'DESC');
        $items = $query->paginate($limit);
        return $items;
    }
    public static function findItem($id, $type = '')
    {
        return self::findOrFail($id);
    }
    public static function saveItem($request, $type = '')
    {
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
            if ($type == 'staff') {
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
            if ($type == 'employee') {
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

                $user_employee->title_color = $data['title_color'];
                $user_employee->background_company = $data['background_company'];

                if ($user) {
                    $user->points = $user_employee->points;
                }
                if ($request->hasFile('background')) {
                    self::deleteFile($user_employee->background);
                    $data['background'] = self::uploadFile($request->file('background'), 'uploads/backgrounds');
                    $user_employee->background = $data['background'];
                }
                if ($request->hasFile('logo_trending')) {
                    self::deleteFile($user_employee->logo_trending);
                    $data['logo_trending'] = self::uploadFile($request->file('logo_trending'), 'uploads/logo_trendings');
                    $user_employee->logo_trending = $data['logo_trending'];
                }
                // Xử lý giấy phép kinh doanh (image_business_license)
                if ($request->hasFile('image_business_license')) {
                    self::deleteFile($user_employee->image_business_license);
                    $data['image_business_license'] = self::uploadFile($request->file('image_business_license'), 'uploads/employees');
                    $user_employee->image_business_license = $data['image_business_license'];
                }
                $user_employee->save();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
    public static function updateItem($id, $request, $type = '')
    {
    //    dd($request->all());
        DB::beginTransaction();
        try {
            $data = $request->except(['_token', '_method']);
            $item = self::findOrFail($id);
            $userData = $request->only(['name', 'email', 'password', 'type', 'status', 'verify', 'position', 'points']);
            if ($request->hasFile('image')) {
                self::deleteFile($item->image);
                $userData['image'] = self::uploadFile($request->file('image'), self::$upload_dir);
            }
            if ($userData['password']) {
                $userData['password'] = bcrypt($userData['password']);
            } else {
                unset($userData['password']);
            }
            if ($item->{$item->type}) {
                $custom_fields = $request->only($item->{$item->type}->custom_fields);
                $item->{$item->type}()->update($custom_fields);
            }
            if (isset($data['verify'])) {
                $verifyValue = $data['verify'];
            } else {
            }
            $item->update($userData);
            if ($type == "staff") {
                $user_staff = UserStaff::where('user_id', $item->id)->first();
                $user_staff->phone = $data['phone'];
                $user_staff->birthdate = $data['birthdate'];
                $user_staff->experience_years = $data['experience_years'];
                $user_staff->gender = $data['gender'];
                $user_staff->city = $data['city'];
                $user_staff->address = $data['address'];
                $user_staff->outstanding_achievements = $data['outstanding_achievements'];
                $user_staff->save();
            }
            if ($type == "employee") {
                $user_employee = UserEmployee::where('user_id', $item->id)->first();
                $user = User::get()->first();
                $user_employee->name = $data['name_company'];
                $user_employee->phone = $data['phone'];
                $user_employee->address = $data['address'];
                $user_employee->about = $data['about'];
                $user_employee->is_allowed_abroad = $data['is_allowed_abroad'];
                $user_employee->position = $data['position'];

                $user_employee->title_color = $data['title_color'];
                $user_employee->background_company = $data['background_company'];

                if ($user && isset($data['points'])) {
                    $user->points = $data['points'];
                }
                if ($request->hasFile('background')) {
                    self::deleteFile($user_employee->background);
                    $data['background'] = self::uploadFile($request->file('background'), 'uploads/backgrounds');
                    $user_employee->background = $data['background'];
                }
                if ($request->hasFile('logo_trending')) {
                    self::deleteFile($user_employee->logo_trending);
                    $data['logo_trending'] = self::uploadFile($request->file('logo_trending'), 'uploads/logo_trendings');
                    $user_employee->logo_trending = $data['logo_trending'];
                }
                if ($request->hasFile('image_business_license')) {
                    // self::deleteFile($user_employee->image_business_license);
                    // $data['image_business_license'] = self::uploadFile(json_decode($request->file('image_business_license')->toArray()), 'uploads/employees');
                    // $user_employee->image_business_license = $data['image_business_license'];
                    $images = $request->file('image_business_license');
                    $imagePaths = [];
                    foreach ($images as $image) {
                        if ($image->isValid()) {
                            $imagePaths[] = self::uploadFile($image, 'business_licenses');
                        }
                    }
                    if ($user_employee->image_business_license) {
                        $array_bg = json_decode($user_employee->image_business_license);
                        $result = array_merge($array_bg, $imagePaths);
                        $imagePaths = $result;
                    }
                    $user_employee->image_business_license = json_encode($imagePaths); // Lưu đường dẫn ảnh dưới dạng chuỗi JSON
                }
                if ($request->hasFile('image')) {
                    self::deleteFile($item->image);

                    $user_employee->image = self::uploadFile($request->file('image'), self::$upload_dir);
                }
                // dd($user_employee);
                $user_employee->save();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public static function showUserCVs($request, $limit = 20, $type = '')
    {
        $id = $request->id;
        $modelClass = '\App\Models\\' . $type;
        $query = $modelClass::query(true);
        // dd($query);
        $items = $query->where('user_id', $id)->paginate($limit);
        return $items;
    }
    public static function showCV($request, $type = '')
    {
        $id = $request->id;
        $modelClass = '\App\Models\\' . $type;
        $query = $modelClass::query(true);
        $item = $query->findOrfail($id);
        return $item;
    }
    public static function deleteItem($id, $type = '')
    {
        $item = self::findItem($id);
        self::deleteFile($item->image);
        return $item->delete();
    }


    // Custom relation
    public function staff()
    {
        return $this->hasOne(\App\Models\UserStaff::class, 'user_id');
    }
    public function employee()
    {
        return $this->hasOne(\App\Models\UserEmployee::class, 'user_id');
    }

    public function getBackgroundFmAttribute()
    {
        if ($this->background != null) {
            if (strpos($this->background, 'http') !== false) {
                return $this->background;
            }
            return asset('storage/images/' . $this->background);
        }
        return ("/website-assets/images/backgroudemploy.jpg");
    }

    // public function getImagebusinesslicenseFmAttribute()
    // {

    //     if ($this->image_business_license != null) {
    //         if (strpos($this->image_business_license, 'http') !== false) {
    //             return $this->image_business_license;
    //         }
    //         return asset('storage/images/' . $this->image_business_license);
    //     }
    //     return "/website-assets/images/backgroudemploy.jpg";
    // }

    public static function countRegisterToday()
    {
        $query = self::query(true);
        $query = $query->select(
            [
                DB::raw('COUNT(CASE WHEN type = "employee" THEN 1 ELSE NULL END) AS count_employee'),
                DB::raw('COUNT(CASE WHEN type = "staff" THEN 1 ELSE NULL END) AS count_staff'),
            ]
        );
        $query =  $query->whereDate('created_at', date('Y-m-d'));
        $items = $query->first();
        return $items;
    }

    public static function countStaffAndEmployee()
    {
        $query = self::query(true);
        $query = $query->select(
            [
                DB::raw('COUNT(CASE WHEN type = "employee" THEN 1 ELSE NULL END) AS count_employee'),
                DB::raw('COUNT(CASE WHEN type = "staff" THEN 1 ELSE NULL END) AS count_staff'),
            ]
        );
        $items = $query->first();
        return $items;
    }

    public static function getCountAccess()
    {
        $query = self::query(true);
        $query = $query->select(
            [
                DB::raw('COUNT(CASE WHEN type = "employee" THEN 1 ELSE NULL END) AS count_employee'),
                DB::raw('COUNT(CASE WHEN type = "staff" THEN 1 ELSE NULL END) AS count_staff'),
            ]
        );
        $items = $query->whereNotNull('last_login');
        $items = $query->first();
        return $items;
    }

    public static function getAccessLastMonth()
    {
        $query = self::query(true);
        $query = $query->select(
            [
                DB::raw('COUNT(CASE WHEN type = "employee" THEN 1 ELSE NULL END) AS count_employee'),
                DB::raw('COUNT(CASE WHEN type = "staff" THEN 1 ELSE NULL END) AS count_staff'),
            ]
        );
        $items = $query->whereDate('last_login', ">=", Carbon::now()->subDays(30)->format('Y-m-d'));
        $items = $query->first();
        return $items;
    }
}
