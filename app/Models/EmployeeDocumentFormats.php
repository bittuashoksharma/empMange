<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDocumentFormats extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'employee_id',
        'title',
        'description'
    ];
}
