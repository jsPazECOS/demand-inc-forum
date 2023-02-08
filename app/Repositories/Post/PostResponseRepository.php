<?php

namespace App\Repositories\Post;

use App\Models\Post\Post;
use App\Models\Post\PostResponse;
use Prettus\Repository\Eloquent\BaseRepository;


class PostResponseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'created_at'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PostResponse::class;
    }

}
