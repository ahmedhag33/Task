<?php

namespace App\Repository;

interface IBaseRepository
{
    public function getall();

    public function getbyid($id);

    public function create(array $attributes);

    public function getbycolums();

    public function update($id, array $attributes);

    public function delete($id);
}
