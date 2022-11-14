<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeBankDetail extends Model
{
    use HasFactory;

    protected $fillable = [
         'user_id',
         'account_holder_name',
         'account_number',
         'bank_name',
         'branch',
         'ifsc_code'
    ];
}