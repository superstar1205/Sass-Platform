<?php

namespace App\Models;

use App\Enums\Packages\Status;
use App\ValueObjects\Money;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Package
 * @package App\Models
 * @method visible
 */
class Package extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => Status::class
    ];

    public function getPriceMoneyAttribute(): Money
    {
        return Money::withDefaultCurrency($this->price);
    }

    /**
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('status', Status::visible());
    }
}
