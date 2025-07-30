<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionItem extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "prescription_items";
    protected $fillable = [
        'prescription_id',
        'medicine_id',
        'medicine_name',
        'price',
        'quantity',
        'dosage',
        'frequency',
        'duration',
        'dosage_schedule',
        'instructions'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function prescription()
    {
        return $this->belongsTo(Prescription::class, 'prescription_id', 'id');
    }
}
