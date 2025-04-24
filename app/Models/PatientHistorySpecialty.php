<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class PatientHistorySpecialty extends Model
{
    use SoftDeletes;
 
    protected $table = 'patient_history_specialties';

    protected $fillable = ['patient_id', 'patient_history_id', 'specialty_id', 'uuid'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($patientHistorySpecialty) {
            $patientHistorySpecialty->uuid = (string) Str::uuid();
        });
    }

    public function patientHistory()
    {
        return $this->belongsTo(PatientHistory::class);
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }
}
