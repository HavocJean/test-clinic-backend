<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class PatientHistory extends Model
{
    use SoftDeletes;

    protected $table = 'patient_history';

    protected $fillable = [
        'uuid',
        'patient_id',
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

        static::creating(function ($patientHistory) {
            $patientHistory->uuid = (string) Str::uuid();
        });
    }

    public function regional()
    {
        return $this->belongsTo(Regional::class);
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class, 'patient_history_specialties', 'patient_history_id', 'specialty_id')
        ->withPivot('uuid')
        ->withTimestamps();
    }
}