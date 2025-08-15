<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Patient extends Model
{
    use SoftDeletes;

    protected $table = 'patients';

    protected $fillable = [
        'uuid',
        'name',
        'date_birth',
        'genre',
        'trade_name',
        'rg',
        'cpf',
        'address',
        'phone',
        'email',
        'obs',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($patient) {
            $patient->uuid = (string) Str::uuid();
        });
    }
}
