<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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
            $regional->uuid = (string) Str::uuid();
        });
    }

    // public function user_histories()
    // {
    //     return $this->hasMany(UserHistory::class);
    // }
}