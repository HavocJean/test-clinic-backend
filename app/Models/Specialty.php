<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;


class Specialty extends Model
{
    use SoftDeletes; 

    protected $table = 'specialties';

    protected $fillable = [
        'uuid',
        'name',
        'description'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($specialty) {
            $specialty->uuid = Uuid::uuid4()->toString();
        });
    }

    public function user_histories()
    {
        return $this->belongsToMany(UserHistory::class, 'user_history_specialties', 'specialty_id', 'user_history_id');
    }
}