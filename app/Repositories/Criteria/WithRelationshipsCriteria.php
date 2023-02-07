<?php

namespace App\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class WithRelationshipsCriteria implements CriteriaInterface
{
    public function __construct(private $arrayWith)
    {
    }


    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->with($this->arrayWith);
        return $model;
    }
}
