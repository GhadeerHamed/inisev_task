<?php

namespace App\Models;

use Brick\Math\BigInteger;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property BigInteger $id
 * @property string $name
 * @property string $description
 * @property string $url
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Collection|User[] $subscribers
 * @property-read Collection|Post[] $posts
 */
class Website extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'description'
    ];

    /**
     * @return BelongsToMany
     */
    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'website_subscribers', 'website_id', 'user_id')
            ->withPivot(['subscription_date']);
    }

    /**
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
