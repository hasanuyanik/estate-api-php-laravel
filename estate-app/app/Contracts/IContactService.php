<?php
namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface IContactService
{
    /**
     * @param array $data
     * 
     */
    public function create(array $data);

    /**
     * @param int $id
     * @param array $data
     * 
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * @return Collection
     */
    public function list(): Collection;

    /**
     * @param array $datas
     * 
     * @return Collection
     */
    public function byDatas(array $datas): Collection;
}