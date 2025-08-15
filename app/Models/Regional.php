<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;


class Regional extends Model
{
    use SoftDeletes;

    protected $table = 'regionals';

    protected $fillable = [
        'uuid',
        'name',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($regional) {
            $regional->uuid = Uuid::uuid4()->toString();
        });
    }
}