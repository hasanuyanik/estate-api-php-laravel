<?php
namespace App\Http\Services;

use App\Contracts\IAppointmentService;
use App\Http\Repositories\AppointmentRepository as Repository;
use App\Models\Appointment;
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
     * @param array $data
     * 
     * @return Collection
     */
    public function list(array $data): Collection
    {
        return $this->repository->list($data);
    }

    /**
     * @param int $id
     * 
     * @return Appointment
     */
    public function byId(int $id): Appointment
    {
        return $this->repository->byId($id);
    }

}