<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasUuids;
    use HasFactory;

    protected $fillable = [
        'examination_id',
        'file_path',
        'original_name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function examination()
    {
        return $this->belongsTo(Examination::class, 'examination_id', 'id');
    }
}
