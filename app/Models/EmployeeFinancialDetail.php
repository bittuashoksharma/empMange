<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeFinancialDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'basic_salary',
        'allowances',
        'deductions',
        'monthly_salary',
        'yearly_salary'
    ];

    public function employeeFinancialInfo()
    {
        return $this->hasOne(EmployeeBankDetail::class,'user_id','user_id');
    }

    protected function allowances(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  json_decode($value),
            
        );
    }
    protected function deductions(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  json_decode($value),
            
        );
    }
}
