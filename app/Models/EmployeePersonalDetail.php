<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class EmployeePersonalDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'father_name',
        'dob',
        'gender',
        'phone_number_2',
        'current_address',
        'permanent_address',
        'nationality',
        'maritial_status',
        'photo',
        'pan_number',
        'adhaar_number',
        'esi_number',
        'pf_account',

    ];
    
    protected $appends = ['age'];

    /**
     * Accessor for Age.
     */
    public function getAgeAttribute()
    {
            $dateNow = Carbon::now();
            return $dateNow->diffInYears(Carbon::parse($this->attributes['dob']));
    }
}