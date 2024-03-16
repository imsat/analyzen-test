<?php

namespace App\Interfaces;

interface TrashInterface
{
    public function restoreFromTrash($model, $id);
    public function deleteFromTrash($model, $id);
}
