<?php
namespace App\Http\Services;

use App\Contracts\IAppointmentService;
use App\Http\Repositories\AppointmentRepository as Repository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class AppointmentService implements IAppointmentService
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
     * @param int $id
     * 
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return $this->repository->list();
    }

    /**
     * @param Carbon $date
     * 
     * @return Collection
     */
    public function byDate(Carbon $date): Collection
    {
        return $this->repository->byDate($date);
    }

}