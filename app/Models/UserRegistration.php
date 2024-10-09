<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRegistration extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'nid', 'vaccine_center_id', 'scheduled_date', 'vaccinated'];

    public function vaccineCenter()
    {
        return $this->belongsTo(VaccineCenter::class);
    }
}
