<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $medical_record_number
 * @property string $name
 * @property string $gender
 * @property string $birth_date
 * @property string $address
 * @property string $phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|patients newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|patients newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|patients query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|patients whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|patients whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|patients whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|patients whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|patients whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|patients whereMedicalRecordNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|patients whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|patients wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|patients whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class patients extends Model
{
    use HasUuids;
    use HasFactory;

    protected $table = "patients";
    protected $fillable = [
        'id',
        'medical_record_number',
        'name',
        'gender',
        'birth_date',
        'address',
        'phone',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function examination()
    {
        return $this->hasMany(examinations::class, 'patient_id', 'id');
    }
}
