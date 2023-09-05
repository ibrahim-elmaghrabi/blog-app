<?php

namespace App\Models\Post;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\{HasMany, BelongsTo, BelongsToMany};
use  App\Models\{Comment, User, Report\Report};

class Post extends Model implements TranslatableContract,  HasMedia
{
    use HasFactory, Translatable, InteractsWithMedia;

    public $translatedAttributes = ['title', 'description'];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function reports(): BelongsToMany
    {
        return $this->belongsToMany(Report::class);
    }

    public function scopeSearch($query, $keyword = null)
    {
        return $query->when($keyword, function ($query, $keyword) {
            return $query->whereHas('translation', function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        });
    }

    public function scopeMostPopular($query)
    {
        return $query->orderBy('views', 'desc');
    }

    public function scopeSortByNewest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
