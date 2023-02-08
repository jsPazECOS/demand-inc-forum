<?php
namespace App\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class WhereFieldCriteria implements CriteriaInterface
{

    public function __construct(private $field, private $value = null, private $operator = "=")
    {
    }

    public function apply($model, RepositoryInterface $repository)
    {
        if($this->operator == 'in'){
            $model = $model->whereIn($this->field, $this->value);
            return $model;
        }
        $model = $model->where($this->field, $this->operator, $this->value);
        return $model;
    }
}
