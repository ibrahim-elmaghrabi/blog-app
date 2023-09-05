<?php

namespace App\Models\Report;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, BelongsTo};
use  App\Models\{Comment, User, Post\Post};

class Report extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['reason'];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

}
