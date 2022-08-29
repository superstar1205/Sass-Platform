<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Gate;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Laravel\Cashier\Exceptions\SubscriptionUpdateFailure;
use Laravel\Cashier\Subscription;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getIsAdminAttribute(): bool
    {
        return Gate::allows('admin');
    }

    public function getNotAdminAttribute(): bool
    {
        return Gate::denies('admin');
    }

    /**
     * @return HasOne
     */
    public function integration():HasOne
    {
        return $this->hasOne(Integration::class);
    }

    /**
     * @param  string  $priceId
     * @param  string|null  $paymentMethod
     * @return Subscription|null
     * @throws IncompletePayment
     * @throws SubscriptionUpdateFailure
     */
    public function subscribe(string $priceId, ?string $paymentMethod = null):?Subscription
    {
        if (! $this->subscribed()) {
            return $this->newSubscription('default', $priceId)->create($paymentMethod);
        } else {
            return $this->subscription()->swap($priceId);
        }
    }
}
