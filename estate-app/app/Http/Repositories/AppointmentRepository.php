<?php
namespace App\Http\Repositories;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class AppointmentRepository
{
    /**
     * @param array $data
     * 
     */
    public function create(array $data)
    {
        return Appointment::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * 
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return Appointment::where('id', $id)->update($data);
    }

    /**
     * @param int $id
     * @param array $data
     * 
     * @return bool
     */
    public function delete(int $id): bool
    {
        return Appointment::where('id', $id)->delete();
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return Appointment::get();
    }

    /**
     * @param Carbon $date
     * 
     * @return Collection
     */
    public function byDate(Carbon $date): Collection
    {
        return Appointment::where('date', $date)->get();
    }

}