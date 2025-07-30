<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'payment';
    protected $fillable = [
        'prescription_id',
        'price',
        'status',
        'method',
        'total_payment',
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
