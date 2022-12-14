<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'contact_id',
        'address',
        'date',
        'distance',
        'estimate_departure',
        'return_time'
    ];

    /**
     * @return BelongsTo
     */
    public function contacts()
    {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
