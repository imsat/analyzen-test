<?php

namespace App\Interfaces;

interface CrudInterface
{
    public function index($onlyTrashed = null);
    public function createOrUpdate(array $data, $user = null);
    public function show($user);
    public function delete($user);
}
