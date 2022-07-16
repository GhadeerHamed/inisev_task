<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Services\PostsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPostToSubscribers implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * @var PostsService
     */
    private PostsService $postsService;

    /**
     * Create a new command instance.
     *
     * @param PostsService $postsService
     */
    public function __construct(PostsService $postsService) {
        $this->postsService = $postsService;
    }

    /**
     * Handle the event.
     *
     * @param PostCreated $event
     * @return void
     */
    public function handle(PostCreated $event): void
    {
        $post = $event->post;
        $this->postsService->sendTosubscribers($post);
    }
}
