<?php

namespace App\Repositories\Interfaces;

interface ITodoRepository
{
    public function create(array $data);

    public function filterByTags(array $tagsArray);

    public function getById(int $todoId);

    public function getByQuery(string $query);
}
