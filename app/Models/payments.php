<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|payments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|payments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|payments query()
 * @mixin \Eloquent
 */
class payments extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'payments';
    protected $fillable = [
        'prescription_id',
        'amount_due', // total tagihan dari semua item
        'amount_paid',  // yang dibayar pasien
        'status',
        'method',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function prescription()
    {
        return $this->belongsTo(prescriptions::class, 'prescription_id', 'id');
    }
}
