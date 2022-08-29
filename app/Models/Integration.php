<?php
namespace App\Models;

use App\Enums\Integrations\Status;
use App\Enums\Integrations\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Integration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'status',
        'type',
        'config',
        'user_id'
    ];

    protected $casts = [
        'config' => 'json',
        'type' => Type::class,
        'status' => Status::class
    ];

    /**
     * @return string
     */
    public function getEmailAttribute(): string
    {
        return data_get($this->config, 'email', '');
    }

    /**
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeEnable(Builder $query): Builder
    {
        return $query->where('status', Status::enable());
    }

    public function scopeCreator(Builder $query): Builder
    {
        return $query->where('user_id', Auth::id());
    }
}