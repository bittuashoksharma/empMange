<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAdditionalDetail extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'step_completed',
      'dropbox_url',
      'google_drive'
    ];
}
