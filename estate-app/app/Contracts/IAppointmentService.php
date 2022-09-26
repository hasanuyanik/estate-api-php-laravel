<?php
namespace App\Contracts;

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
     * @return Collection
     */
    public function list(): Collection;

    /**
     * @param Carbon $date
     * 
     * @return Collection
     */
    public function byDate(Carbon $date): Collection;
}