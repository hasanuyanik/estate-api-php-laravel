<?php
namespace App\Contracts;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

interface IAppointmentService
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
     * @param int $id
     * 
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @param array $data
     * 
     * @return Collection
     */
    public function list(array $data): Collection;

    /**
     * @param int $id
     * 
     * @return Appointment
     */
    public function byId(int $id): Appointment;
}