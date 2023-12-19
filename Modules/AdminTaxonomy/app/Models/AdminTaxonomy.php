<?php

namespace Modules\AdminTaxonomy\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AdminTaxonomy\Database\factories\TaxonomyFactory;
use App\Traits\UploadFileTrait;
use Illuminate\Support\Str;
class AdminTaxonomy extends Model
{
    use HasFactory;
    use UploadFileTrait;

    protected $table = 'taxonomies';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status',
        'position'
    ];

    const ACTIVE    = 1;
    const INACTIVE  = 2;
    const DRAFT     = -1;

    protected static function newFactory(): TaxonomyFactory
    {
        //return TaxonomyFactory::new();
    }

    // Core methods
    public static function getItems($request = null,$limit = 20){
        $query = self::query(true);
        if($request->name){
            $query->where('name','LIKE','%'.$request->name.'%');
        }
        switch ($request->sortBy) {
            case 'id_asc':
                $query->orderBy('id','asc');
                break;
            case 'name_asc':
                $query->orderBy('name','asc');
                break;
            case 'created_asc':
                $query->orderBy('created_at','asc');
                break;
            default : 
                $query->orderBy('id','desc');
                break;
        }
        $items = $query->paginate($limit);
        return $items;
    }
    public static function findItem($id){
        return self::findOrFail($id);
    }
    public static function saveItem($request){
        $data = $request->all();
        if(!$request->slug){
            $data['slug'] = Str::slug($request->name);
        }
        if ($request->hasFile('image')) {
            $data['image'] = self::uploadFile($request->file('image'), 'uploads/taxonomies');
        } 
        self::create($data);
    }
    public static function updateItem($id,$request){
        $item = self::findOrFail($id);
        $data = $request->all();
        if ($request->hasFile('image')) {
            self::deleteFile($item->image);
            $data['image'] = $this->uploadFile($request->file('image'), 'uploads/taxonomies');
        } 
        $item->update($data);
    }
    public static function deleteItem($id){
        $item = self::findItem($id);
        self::deleteFile($item->image);
        return $item->delete();
    }

    // Relationships
    public function posts(){
        // return $this->hasMany(Post::class);
    }

    // Attributes
    public function getStatusFmAttribute(){
        switch ($this->status) {
            case self::DRAFT:
                return '<span class="lable-table bg-danger-subtle text-danger rounded border border-danger-subtle font-text2 fw-bold">'.__('sys.draf').'</span>';
                break;
            case self::ACTIVE:
                return '<span class="lable-table bg-success-subtle text-success rounded border border-success-subtle font-text2 fw-bold">'.__('sys.active').'</span>';
                break;
            case self::INACTIVE:
                return '<span class="lable-table bg-warning-subtle text-warning rounded border border-warning-subtle font-text2 fw-bold">'.__('sys.inactive').'</span>';
                break;
        }
    }
    public function getCreatedAtFmAttribute(){
        return date('d-m-Y',strtotime($this->created_at));
    }
    public function getImageFmAttribute(){
        if( !$this->image ){
            return asset('admin-assets/images/default-image.png');
        }
        return asset($this->image);
    }
}
