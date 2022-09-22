<?php
namespace App\Http\Services;

use App\Contracts\IUserService;
use App\Http\Repositories\UserRepository as Repository;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService implements IUserService
{
    /**
     * @var Repository
     */
    private Repository $repository;

    /**
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * 
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * 
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return $this->repository->update($id, $data);
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return $this->repository->list();
    }

    /**
     * @param array $datas
     * 
     * @return Collection
     */
    public function byDatas(array $datas): Collection
    {
        return $this->repository->byDatas($datas);
    }

}