<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'form_data',
        'status'
    ];

    protected $casts = [
        'form_data' => 'json',
    ];

    /**
     * @return BelongsTo
     */
    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function scopeCreator(Builder $query): Builder
    {
        return $query->whereHas('form', function (Builder $builder){
            return $builder->creator();
        });
    }
}
