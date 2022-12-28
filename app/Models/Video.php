<?php

namespace App\Models;

use App\Filters\VideoFilters;
use Hekmatinasser\Verta\Verta;
use App\Models\Traits\Likeable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory, Likeable, SoftDeletes;
    protected $perPage = 18;

    protected $fillable = [
        'name', 'description', 'length', 'path', 'slug', 'thumbnail', 'category_id'
    ];

    protected $hidden = ['category_id'];

    protected $appends = ['owner_name'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getLengthInHumanAttribute()
    {
        return gmdate("i:s", $this->length);
    }

    public function getCreatedAtAttribute($value)
    {
        return (new Verta($value))->formatDifference();
    }

    public function relatedVideos(int $count = 6)
    {
        return $this->category->getRandomVideos($count);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCategoryNameAttribute()
    {
        return $this->category?->name;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getOwnerNameAttribute()
    {
        return $this->user?->name;
    }

    public function getOwnerAvatarAttribute()
    {
        return $this->user?->gravatar;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    public function getVideoUrlAttribute()
    {

        //  return Storage::url($this->url);
        return '/storage/' . $this->path;
    }

    public function getVideoThumbnailAttribute()
    {

        return '/storage/' . $this->thumbnail;
    }


    public function scopeFilter(Builder $builder, array $params)
    {
        return (new VideoFilters($builder))->apply($params);
    }
}
