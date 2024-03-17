<?php

namespace App\Interfaces;

interface CrudInterface
{
    public function index($onlyTrashed = null);

    public function createOrUpdate(array $data, $user = null);

    public function show($user);

    public function delete($user);

    public function restore($id);

    public function permanentDelete($id);
}
