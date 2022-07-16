<?php

namespace App\Console\Commands;


use App\Models\Post;
use App\Services\PostsService;
use Illuminate\Console\Command;


class SendPostsToSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:send';


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
        parent::__construct();
        $this->postsService = $postsService;
    }
    /**
     * Execute the console command.
     *
     */
    public function handle(): void
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            $this->info("Scanning Post #" . $post->id);
            $this->postsService->sendTosubscribers($post);
        }
    }
}
