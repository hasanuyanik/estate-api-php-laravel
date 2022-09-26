<?php
namespace App\Http\Repositories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;

class ContactRepository
{
    /**
     * @param array $data
     * 
     */
    public function create(array $data)
    {
        return Contact::updateOrCreate($data);
    }

    /**
     * @param int $id
     * @param array $data
     * 
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return Contact::where('id', $id)->update($data);
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return Contact::get();
    }

    /**
     * @param array $datas
     * 
     * @return Collection
     */
    public function byDatas(array $datas): Collection
    {
        return Contact::where($datas)->get();
    }

}