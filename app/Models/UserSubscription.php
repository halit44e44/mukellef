<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSubscription extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'subscription_id',
        'status',
        'renewed_at',
        'expired_at'
    ];

    public $timestamps = false;

    public function user(): HasOne
    {
        return $this->hasone(User::class, 'id', 'user_id');
    }

    public function subscription(): HasOne
    {
        return $this->hasone(Subscription::class, 'id', 'subscription_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function scopeCheckExpiredSubscriptions(Builder $query, int $hours = 6): Builder
    {
        $expirationTime = now()->addHours($hours);

        return $query->where('expired_at', '<=', $expirationTime);
    }
}
