<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Repository\PostRepository;
use Illuminate\Cache\CacheManager;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Contracts\Cache\CacheInterface;


class IncrementPostCountCache
{
    /**
     * @var PostRepository
     */
    private $postRepository;
    /**
     * @var CacheManager
     */
    private $cache;

    /**
     * Create the event listener.
     *
     * @param PostRepository $postRepository
     * @param CacheManager $cache
     */
    public function __construct(PostRepository $postRepository, CacheManager $cache)
    {
        $this->postRepository = $postRepository;
        $this->cache = $cache;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->cache->has('posts_count')) {
            $this->cache->increment('posts_count');
        } else {
            $this->cache->forever('posts_count', $this->postRepository->count() + 1);
        }
    }
}
