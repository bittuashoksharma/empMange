<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDocumentsDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'document_name',
        'upload_file_name'
    ];
}
