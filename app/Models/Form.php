<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'meta_data',
        'user_id'
    ];

    protected $casts = [
        'meta_data' => 'json'
    ];

    public function getSlugAttribute(): ?string
    {
        return data_get($this->meta_data, 'slug');
    }

    /**
     * @return string
     */
    public function getSlugFormIdAttribute(): string
    {
        return urlencode(Str::replaceArray("?", [$this->slug, $this->id],  '?-?'));
    }

    /**
     * @return BelongsTo
     */
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeCreator(Builder $query): Builder
    {
        return $query->where('user_id', Auth::id());
    }

}
