<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class UserHistorySpecialty extends Model
{
    use SoftDeletes;
 
    protected $table = 'user_history_specialties';

    protected $fillable = ['user_id', 'user_history_id', 'specialty_id', 'uuid'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($userHistorySpecialty) {
            $userHistorySpecialty->uuid = Uuid::uuid4()->toString();
        });
    }

    public function userHistory()
    {
        return $this->belongsTo(UserHistory::class);
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }
}
