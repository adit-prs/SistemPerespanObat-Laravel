<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $user_id
 * @property string $action
 * @property string $module
 * @property string $description
 * @property string $ip_address
 * @property string $user_agent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|activity_logs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|activity_logs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|activity_logs query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|activity_logs whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|activity_logs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|activity_logs whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|activity_logs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|activity_logs whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|activity_logs whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|activity_logs whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|activity_logs whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|activity_logs whereUserId($value)
 * @mixin \Eloquent
 */
class activity_logs extends Model
{
    //
    protected $fillable = [
        'action', //'create' | 'update' | 'delete' | 'login' | 'logout'
        'module', //'patient' | 'examination' | 'prescription' | 'payment'
        'description',
        'ip_address',
        'user_agent',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
