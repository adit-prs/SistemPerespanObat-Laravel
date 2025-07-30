<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "prescriptions";
    protected $fillable = [
        'examination_id',
        'receipt_number',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function examination()
    {
        return $this->belongsTo(Examination::class, 'examination_id', 'id');
    }

    public function prescriptionitem()
    {
        return $this->hasMany(PrescriptionItem::class, 'prescription_id', 'id');
    }

    public function payment()
    {
        return $this->hasMany(Payment::class, 'prescription_id', 'id');
    }
}
