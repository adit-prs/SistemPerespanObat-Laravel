<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $prescription_id
 * @property string $medicine_id
 * @property string $medicine_name
 * @property int $quantity
 * @property int $unit_price
 * @property int $dosage_frequency
 * @property int $dosage_interval
 * @property string $dosage_unit
 * @property string $additional_instruction
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\prescriptions $prescriptions
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescription_items newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescription_items newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescription_items query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescription_items whereAdditionalInstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescription_items whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescription_items whereDosageFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescription_items whereDosageInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescription_items whereDosageUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescription_items whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescription_items whereMedicineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescription_items whereMedicineName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescription_items wherePrescriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescription_items whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescription_items whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescription_items whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class prescription_items extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "prescription_items";
    protected $fillable = [
        'prescription_id',
        'medicine_id',
        'medicine_name',
        'quantity',
        'unit_price',
        'dosage_frequency',
        'dosage_amount',
        'dosage_unit',
        'additional_instruction',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function prescriptions()
    {
        return $this->belongsTo(prescriptions::class, 'prescription_id', 'id');
    }
}
