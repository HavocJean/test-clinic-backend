<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class UserHistory extends Model
{
    use SoftDeletes;

    protected $table = 'user_history';

    protected $fillable = [
        'uuid',
        'user_id',
        'regional_id',
        'corporate_name',
        'trade_name',
        'cnpj',
        'start_date',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'start_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($userHistory) {
            $userHistory->uuid = (string) Str::uuid();
        });
    }

    public function regional()
    {
        return $this->belongsTo(Regional::class);
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class, 'user_history_specialties', 'user_history_id', 'specialty_id')
        ->withPivot('uuid')
        ->withTimestamps();
    }
}