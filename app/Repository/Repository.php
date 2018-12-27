<?php
namespace App\Repository;

use Illuminate\Cache\CacheManager;
use Illuminate\Database\Eloquent\Model;

/**
 * App base Repository
 */
abstract class Repository
{

    /**
     * @var Model
     */
    protected $model;
    /**
     * @var CacheManager
     */
    private $cache;

    /**
     * Repository constructor.
     * @param CacheManager $cache
     */
    public function __construct(CacheManager $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Collection|Model
     */
    public function getBySlug(string $slug)
    {
        return $this->model->newQuery()->where('slug', $slug)->firstOrFail();
    }

    /**
     * @param array $data
     * @return Model
     */
    public function save(array $data): Model
    {
        return $this->model->newQuery()->create($data);
    }

    /**
     * Count elements
     *
     * @return int
     */
    public function count(): int
    {
        $count = $this->cache->get($this->model->getTable().'_count', function () {
            return $this->model->count();
        });

        return $count;
    }
}
