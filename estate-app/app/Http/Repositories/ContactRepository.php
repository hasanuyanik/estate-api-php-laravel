<?php
namespace App\Http\Repositories;

use App\Models\Contacts;
use Illuminate\Database\Eloquent\Collection;

class ContactRepository
{
    /**
     * @param array $data
     * 
     */
    public function create(array $data)
    {
        return Contacts::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * 
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return Contacts::where('id', $id)->update($data);
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return Contacts::get();
    }

    /**
     * @param array $datas
     * 
     * @return Collection
     */
    public function byDatas(array $datas): Collection
    {
        return Contacts::where($datas)->get();
    }

}