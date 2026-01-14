<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $examination_id
 * @property string $file_path
 * @property string $original_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\examinations $examination
 * @method static \Illuminate\Database\Eloquent\Builder<static>|attachments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|attachments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|attachments query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|attachments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|attachments whereExaminationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|attachments whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|attachments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|attachments whereOriginalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|attachments whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class attachments extends Model
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
        return $this->belongsTo(examinations::class, 'examination_id', 'id');
    }
}
