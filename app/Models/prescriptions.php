<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $examination_id
 * @property string $receipt_number
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\examinations $examinations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\payments> $payment
 * @property-read int|null $payment_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\prescription_items> $prescriptionitems
 * @property-read int|null $prescriptionitems_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescriptions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescriptions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescriptions query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescriptions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescriptions whereExaminationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescriptions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescriptions whereReceiptNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescriptions whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|prescriptions whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class prescriptions extends Model
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

    protected static function booted()
    {
        static::creating(function ($prescribing) {
            if (empty($prescribing->receipt_number)) {
                $prescribing->receipt_number = self::generateNumber();
            }
        });
    }

    protected static function generateNumber(): string
    {
        $date = now()->format('Ymd');
        $prefix = 'RX-'.$date.'-';

        $last = self::where('receipt_number', 'like', $prefix.'%')
            ->orderBy('receipt_number', 'desc')
            ->lockForUpdate()
            ->first();

        if ($last) {
            $lastSequence = (int)substr($last->receipt_number, -4);
            $nextSequence = $lastSequence + 1;
        } else {
            $nextSequence = 1;
        }

        return $prefix.str_pad($nextSequence, 4, '0', STR_PAD_LEFT);
    }

    public function examinations()
    {
        return $this->belongsTo(examinations::class, 'examination_id', 'id');
    }

    public function prescriptionitems()
    {
        return $this->hasMany(prescription_items::class, 'prescription_id', 'id');
    }

    public function payment()
    {
        return $this->hasMany(payments::class, 'prescription_id', 'id');
    }


}
