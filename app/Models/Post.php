<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected const DESCRIPTION_CHAR_LIMIT = 100;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description',
        'publication_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'publication_date' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'formated_publication_date',
        'short_description',
        'is_published',
    ];

    /**
     * Accessors
     */

    public function getIsPublishedAttribute()
    {
        return $this->publication_date < now();
    }

    public function getFormatedPublicationDateAttribute()
    {
        if (!$this->publication_date) {
            return null;
        }

        return $this->publication_date->format('D, M d Y H:m:s');
    }

    public function getShortDescriptionAttribute()
    {
        if (!$this->description) {
            return null;
        }
        return Str::limit($this->description, self::DESCRIPTION_CHAR_LIMIT);
    }

    /**
     * Relations
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Scopes
     */

    public function scopeFilterPublishedDate(Builder $builder, $date)
    {
        if ($date) {
            return $builder->whereDate('publication_date', $date);
        }
    }

    public function scopePublished(Builder $builder)
    {
        return $builder->where('publication_date', '<=', now()->toDateString());
    }

    public function scopeUnPublished(Builder $builder)
    {
        return $builder->where('publication_date', '>', now()->toDateString());
    }
}
