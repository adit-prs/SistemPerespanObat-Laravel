<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiToken extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "api_tokens";
    protected $fillable = [
        'service',
        'access_token',
        'expires_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
