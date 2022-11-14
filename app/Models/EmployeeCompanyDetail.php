<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeCompanyDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'employee_id',
        'department_id',
        'designation_id',
        'assigned_manager_id',
        'doj',
        'dol',
        'status'
    ];

    public function departmentInfo()
    {
        return $this->hasMany(Department::class,'id','department_id');
    }

    public function empDepartmentInfo()
    {
        return $this->hasOne(Department::class,'id','department_id');
    }
    public function empDesignationInfo()
    {
        return $this->hasOne(Designation::class,'id','designation_id');
    }
}
