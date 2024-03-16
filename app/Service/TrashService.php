<?php

namespace App\Service;


use App\Interfaces\TrashInterface;
use Illuminate\Contracts\Container\Container;

class TrashService extends Service implements TrashInterface
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    public function restoreFromTrash($model, $id)
    {
        $entity = $this->getModelInstance($model, $id);
        $entity->restore();
        return true;
    }

    public function deleteFromTrash($model, $id)
    {
        $entity = $this->getModelInstance($model, $id);
        $entity->forceDelete();
        return true;
    }

    protected function getModelInstance($model, $id)
    {
        $modelInstance = $this->container->make("App\Models\\" . $model);
        return $modelInstance->withTrashed()->findOrFail($id);
    }
}
