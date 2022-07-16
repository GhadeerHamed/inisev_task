<?php

namespace App\Services;

use App\Events\PostCreated;
use App\Mail\PostMail;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PostsService
{
    /**
     * @param $data
     * @return Post
     */
    public function addPost($data): Post
    {
        $post = Post::query()->create([
            'website_id' => $data['website_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
        ]);

        // Dispatch sending post by email to subscribers
        PostCreated::dispatch($post);

        return $post;
    }

    public function sendTosubscribers(Post $post)
    {
        $website = $post->website;
        $subscribers = $website->subscribers;

        $data = [
            'website' => $website->name,
            'title' => $post->title,
            'description' => $post->description,
        ];

        foreach ($subscribers as $subscriber) {
            $subscription_date = $subscriber->pivot->subscription_date;

            if ($post->created_at > $subscription_date && !$post->receivedSubscribers->contains($subscriber->id)){
                try {
                    Mail::to($subscriber->email)->send(new PostMail($data));
                    $post->receivedSubscribers()->syncWithoutDetaching($subscriber->id);
                }catch (\Exception $exception) {
                    Log::error($exception->getMessage());
                }
            }
        }
    }
}
