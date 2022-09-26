<?php
namespace App\Http\Repositories;

use App\Models\Appointment;
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
     * @return Collection
     */
    public function list(): Collection
    {
        return Appointment::get();
    }

    /**
     * @param array $datas
     * 
     * @return Collection
     */
    public function byDatas(array $datas): Collection
    {
        return Appointment::where($datas)->get();
    }

}