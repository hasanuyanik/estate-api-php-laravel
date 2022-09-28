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
     * @param array $data
     * 
     * @return Collection
     */
    public function list(array $data): Collection
    {
        return Appointment::with(['contacts'])->where($data)->get();
    }

    /**
     * @param int $id
     * 
     * @return Appointment
     */
    public function byId(int $id): Appointment
    {
        return Appointment::with(['contacts'])->where('id', $id)->first();
    }

}