<?php
namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    /**
     * @param array $data
     * 
     */
    public function create(array $data)
    {
        return User::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * 
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return User::where('id', $id)->update($data);
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return User::get();
    }

    /**
     * @param array $datas
     * 
     * @return Collection
     */
    public function byDatas(array $datas): Collection
    {
        return User::where($datas)->get();
    }

}