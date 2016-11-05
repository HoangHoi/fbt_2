<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{User, Comment, Tour, Like};
use Carbon\Carbon;
use Html2Text\Html2Text;
use Str;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = [
        'user_id',
        'tour_id',
        'content',
        'rated_food',
        'rated_place',
        'rated_service',
    ];
    protected $appends = [
        'text_preview',
        'short_content',
    ];

    public function getShortContentAttribute()
    {
        $text = Html2Text::convert($this->attributes['content']);

        return $this->attributes['short_content'] = Str::words($text, config('review.short_limit_word'));
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'review_id');
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'review_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format(config('common.publish_date_format'));
    }

    public function getTextPreviewAttribute()
    {
        return Html2Text::convert($this->attributes['content']);
    }
}
