<?php

namespace App\Models;

use Brick\Math\BigInteger;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 *
 * @property BigInteger $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Website $website
 * @property-read Collection $receivedSubscribers
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_id',
        'title',
        'description',
        'content',
    ];

    /**
     * @return BelongsTo
     */
    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }

    /**
     * @return BelongsToMany
     */
    public function receivedSubscribers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'posts_to_subscribers', 'post_id', 'user_id');
    }
}
