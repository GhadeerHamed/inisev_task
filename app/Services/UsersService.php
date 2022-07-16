<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UsersService
{
    /**
     * @param $data
     */
    public function makeSubscription($data): void
    {
        /**
         * @var Website $website
         */
        $website = Website::query()->findOrFail($data['website_id']);
        $website->subscribers()
            ->attach($data['user_id'], ['subscription_date' => Carbon::now()->format('Y-m-d')]);
    }

    /**
     * @param mixed $data
     * @return bool
     */
    public function checkSubscription(mixed $data): bool
    {
        /**
         * @var Website $website
         */
        $website = Website::query()->findOrFail($data['website_id']);
        return $website->subscribers->contains($data['user_id']);
    }
}
