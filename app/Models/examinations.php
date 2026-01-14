<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $doctor_id
 * @property string $patient_id
 * @property string $examined_at
 * @property string $chief_complaint
 * @property string $general_condition
 * @property string $consciousness
 * @property numeric $height_cm
 * @property numeric $weight_kg
 * @property int $systole
 * @property int $diastole
 * @property int $heart_rate
 * @property int $respiratory_rate
 * @property numeric $temperature_c
 * @property string $diagnosis
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\attachments> $attachment
 * @property-read int|null $attachment_count
 * @property-read \App\Models\User $doctor
 * @property-read \App\Models\patients $patient
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\prescriptions> $prescription
 * @property-read int|null $prescription_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|examinations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|examinations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|examinations query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|examinations whereChiefComplaint($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|examinations whereConsciousness($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|examinations whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|examinations whereDiagnosis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|examinations whereDiastole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|examinations whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|examinations whereExaminedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|examinations whereGeneralCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|examinations whereHeartRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|examinations whereHeightCm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|examinations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|examinations wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|examinations whereRespiratoryRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|examinations whereSystole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|examinations whereTemperatureC($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|examinations whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|examinations whereWeightKg($value)
 * @mixin \Eloquent
 */
class examinations extends Model
{
    use HasUuids;
    use HasFactory;

    protected $table = "examinations";
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'examined_at',
        'chief_complaint',
        'general_condition',
        'consciousness',
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
        return $this->belongsTo(patients::class, 'patient_id', 'id');
    }

    public function attachment()
    {
        return $this->hasMany(attachments::class, 'examination_id', 'id');
    }

    public function prescription()
    {
        return $this->hasMany(prescriptions::class, 'examination_id', 'id');
    }
}
