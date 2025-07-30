<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasUuids;
    use HasFactory;

    protected $table = "patients";
    protected $fillable = [
        'medical_record_number',
        'name',
        'gender',
        'date_of_birth',
        'address',
        'phone_number',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function examination()
    {
        return $this->hasMany(Examination::class, 'patient_id', 'id');
    }
}
