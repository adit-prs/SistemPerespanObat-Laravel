<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasUuids;
    use HasFactory;

    protected $table = "examinations";
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'examined_at',
        'height_cm',
        'weight_kg',
        'systole',
        'diastole',
        'heart_rate',
        'respiratory_rate',
        'temperature_c',
        'diagnosis',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function attachment()
    {
        return $this->hasMany(Attachment::class, 'examination_id', 'id');
    }

    public function prescription()
    {
        return $this->hasMany(Prescription::class, 'examination_id', 'id');
    }
}
