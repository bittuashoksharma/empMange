<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Crypt;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'phone_number'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

      /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function sendPasswordResetNotification($token)
    {
        $url = env('APP_URL')."/reset-password/" . $token;
        $this->notify(new ResetPasswordNotification($url));
    }


    protected $appends = ['encrypt_id'];

    protected function getEncryptIdAttribute()
    {
        return Crypt::encryptString($this->attributes['id']);
    }

    public function employeePersonalInfo()
    {
        return $this->hasOne(EmployeePersonalDetail::class,'user_id','id');
    }
    public function employeeCompanyInfo()
    {
        return $this->hasOne(EmployeeCompanyDetail::class,'user_id','id');
    }
    public function employeeAditionalInfo()
    {
        return $this->hasOne(EmployeeAdditionalDetail::class,'user_id','id');
    }

    public function employeeFinancialInfo()
    {
        return $this->hasOne(EmployeeFinancialDetail::class,'user_id','id');
    }
    public function employeeBankInfo()
    {
        return $this->hasOne(EmployeeBankDetail::class,'user_id','id');
    }

    public function EmployeeDocumentsInfo()
    {
        return $this->hasOne(EmployeeDocumentsDetail::class,'user_id','id');
    }

    public function EmployeeAdditionalInfo()
    {
        return $this->hasOne(EmployeeAdditionalDetail::class,'user_id','id');
    }
    

}
