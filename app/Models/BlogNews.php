<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;  
use Illuminate\Database\Eloquent\SoftDeletes; 
class BlogNews extends Model
{
    use HasFactory;

    /**
    * The table associated with the model.
    *
    * @var string 
    */
    protected $table = 'blogs_news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type','title','image','content','active','main_page'];

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://scotturb.com/wp-content/uploads/2016/11/product-placeholder-300x300.jpg';
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/thumbnail/' . $this->image);
        // storage/thumbnail/blogsNews/{image_name}

    } // $blogsNews->image_url
    
    public function getImageUrllAttribute()
    {
        if (!$this->image) {
            return 'https://scotturb.com/wp-content/uploads/2016/11/product-placeholder-300x300.jpg';
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
        // storage/thumbnail/blogsNews/{image_name}

    } // $blogsNews->image_url


}