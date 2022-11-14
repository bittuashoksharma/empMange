<?php

namespace App\Http\Controllers\API\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Models\EmployeePersonalDetail;
use App\Models\EmployeeCompanyDetail;
use App\Models\EmployeeFinancialDetail;
use App\Models\EmployeeBankDetail;
use App\Models\EmployeeDocumentsDetail;
use App\Models\EmployeeAdditionalDetail;
use App\Models\EmployeeDocumentFormats;
use App\Models\CompanyDocumentFormat;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use Knp\Snappy\Pdf;
use Auth;
 
use App\Models\Allowances;
use App\Models\Deductions;

class EmpDetailControllers extends Controller
{
    public function getEmplyoeeDetail(Request $request)
    {
        $userDetail = [];
         $user_id = auth('api')->user()->id;
         $userDetail = User::where('id', $user_id)->first();
        return $this->sendSuccessResponse($userDetail, 'Emp detail!');
    }
}
