<?php

namespace App\Http\Controllers\API;

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

class EmployeeControllers extends Controller
{
    /**
     * Store a employee personal details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEmployeePersonalDetail(Request $request)
    {
        $inputs = [
             'name' => 'required|max:255',
            // 'father_name' => 'required|max:255',
            // 'dob' => 'required|date',
             'gender' => 'required',
             'contact_number_1' => 'required|numeric',
            // 'contact_number_2' => 'nullable|numeric',
            // 'current_address' => 'nullable',
            // 'permanent_address' => 'required',
            // 'nationality' => 'required',
            // 'maritial_status' => 'required',
             'email' => 'required|unique:users,email,' .request('user_id'),
            // 'password' => 'required|min:8',
            // 'pan_number' => 'required|max:10|min:10',
            // 'adhaar_number' => 'required|min:12|numeric',
            // 'esi_number' => 'nullable',
            // 'pf_account' => 'required',
        ];
        // if(request('is_photo') == 0){
        //     $inputs['photo'] = 'required|image|mimes:jpeg,bmp,png,jpg,svg';
        // }else{
        //     $inputs['photo'] = 'nullable|sometimes|image|mimes:jpeg,bmp,png,jpg,svg';

        // }
        
        $validator = Validator::make($request->all(),$inputs);
        if ($validator->fails()) {

          $validationError = [];
          $validationErrors = $validator->errors();
          return json_encode(array('code'=>'error_validate','errors'=>$validator->errors()));
          
        }
        $file_name = "";
        if($request->hasFile('photo')) {
                $profilePic = $request->file('photo');
                $file_name = time().'_profilepic_'.$profilePic->getClientOriginalName();
                $file_path = $request->file('photo')->storeAs('profile_pics', $file_name, 'public');
        }

        if(!empty(request('name'))){
            $userId = request('user_id');
        }
        if(!empty($userId) && (request('is_details_update') != 1)){
            
            $userData = User::updateOrCreate([
                'id'   => $userId,
            ],[
                'name' => request('name'),
                'email' => request('email'),
                'phone_number' => request('contact_number_1'),
                'password' => bcrypt('adfs@!dffs'),
                'role_id' => 3,
            ]);
            Password::sendResetLink($request->only('email'));

        }elseif(request('is_details_update') == 1){
           
            $userData = User::updateOrCreate([
                'id'   => $userId,
            ],[
                'name' => request('name'),
                'email' => request('email'),
                'phone_number' => request('contact_number_1'),
                'role_id' => 3,
            ]);

        }
        
        if(!empty($userData) && !empty($userData->id)){
            $employeeRecord = [
                            'user_id' => $userData->id,
                            'father_name' => (!empty(request('name'))?request('name'):''),
                            'dob' => (!empty(request('dob'))?date('Y-m-d',strtotime(request('dob'))):null),
                            'gender' => (!empty(request('gender'))?request('gender'):''),
                            'phone_number_2' => (!empty(request('contact_number_2'))?request('contact_number_2'):''),
                            'current_address' => (!empty(request('current_address'))?request('current_address'):''),
                            'permanent_address' => (!empty(request('permanent_address'))?request('permanent_address'):''),
                            'nationality' => (!empty(request('nationality'))?request('nationality'):''),
                            'maritial_status' => (!empty(request('maritial_status'))?request('maritial_status'):''),
                            
                            'pan_number' => (!empty(request('pan_number'))?request('pan_number'):''),
                            'adhaar_number' => (!empty(request('adhaar_number'))?request('adhaar_number'):''),
                            'esi_number' => (!empty(request('esi_number'))?request('esi_number'):''),
                            'pf_account' => (!empty(request('pf_account'))?request('pf_account'):''),
                        ];
            if(!empty($file_name)){
               $employeeRecord['photo'] = $file_name; 
            }
            $empPerData = EmployeePersonalDetail::updateOrCreate([
                              'user_id'   => $userData->id,
                          ],$employeeRecord);
                          
            if(request('is_details_update') != 1){
                $this->checkAndUpdateEmpFormStep($userData->id,1);
            }
        }
       
            

        return json_encode(array('code'=>'success','data'=>$userData));
        
    }

    /**
     * Store a employee company details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEmployeeCompanyDetail(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'employee_id' => 'required',
            // 'department' => 'required',
            // 'designation' => 'required',
            // 'assigned_manager' => 'nullable',
            'doj' => 'required',
            // 'dol' => 'nullable',
            // 'status' => 'required',
            // 'search_by_email' => 'nullable',
            // 'search_by_name' => 'nullable',
        ]);

        if ($validator->fails()) {

          $validationError = [];
          $validationErrors = $validator->errors();
          return json_encode(array('code'=>'error_validate','errors'=>$validator->errors()));
          
        }
        
        if(!empty(request('user_id'))){
            $empCompanyData = EmployeeCompanyDetail::updateOrCreate([
                              'user_id'   => request('user_id'),
                          ],[
                            'user_id' => (!empty(request('user_id'))?request('user_id'):''),
                            'employee_id' => (!empty(request('employee_id'))?request('employee_id'):''),
                            'department_id' => (!empty(request('department'))?request('department'):''),
                            'designation_id' => (!empty(request('designation'))?request('designation'):''),
                            'assigned_manager_id' => (!empty(request('assigned_manager'))?request('assigned_manager'):''),
                            'doj' => (!empty(request('doj'))?date('Y-m-d',strtotime(request('doj'))):''),
                            'dol' => (!empty(request('dol'))?date('Y-m-d',strtotime(request('dol'))):null),
                            'status' => (!empty(request('status'))?request('status'):'enable'),
                            
                        ]);
            if(request('is_details_update') != 1){
                $this->checkAndUpdateEmpFormStep(request('user_id'),2);
            }
            return json_encode(array('code'=>'success','data'=>$empCompanyData));
           
        }else{
            return json_encode(array('code'=>'error','message'=>'Something went wrong !! Please try again.'));
        }
    }

    /**
     * Store a employee financial details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEmployeeFinancialDetail(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'basic_salary' => 'required|numeric',
            // 'allowances' => 'required|numeric|between:0,99.99',
            // 'allowances_amount' => 'required|numeric|between:0,99.99',
            // 'deductions' => 'required|numeric|between:0,99.99',
            // 'deductions_amount' => 'required|numeric|between:0,99.99',
            'monthly_salary' => 'required|numeric',
            'yearly_salary' => 'required|numeric',
            // 'account_holder_name' => 'required',
            // 'account_number' => 'required|numeric',
            // 'bank_name' => 'required',
            // 'branch' => 'required',
            // 'ifsc_code' => 'required',
        ]);

        if ($validator->fails()) {

          $validationError = [];
          $validationErrors = $validator->errors();
          return json_encode(array('code'=>'error_validate','errors'=>$validator->errors()));
          
        }

        
        if(!empty(request('user_id'))){

            $allowancesArr = array();
            $deductionArr = array();
            $oldEmpFinancialData = EmployeeFinancialDetail::where('user_id',request('user_id'))->first();
            if(!empty(request('allowances'))){
                $allowancesArr[request('allowances')] = request('allowances_amount');
            }elseif(!empty(@$oldEmpFinancialData->allowances)){
                $allowancesArr = json_decode($oldEmpFinancialData->allowances,true);
            }
            if(!empty(request('deductions'))){
                $deductionArr[request('deductions')] = request('deductions_amount');
            }elseif(!empty(@$oldEmpFinancialData->deductions)){
                $deductionArr = json_decode($oldEmpFinancialData->deductions,true);
            }
            
            $empFinancialData = EmployeeFinancialDetail::updateOrCreate([
                              'user_id'   => request('user_id'),
                          ],[
                            'user_id' => (!empty(request('user_id'))?request('user_id'):2),
                            'basic_salary' => (!empty(request('basic_salary'))?request('basic_salary'):''),
                            'allowances' => (!empty(request('allowances'))?json_encode($allowancesArr):''),
                            'deductions' => (!empty(request('deductions'))?json_encode($deductionArr):''),
                            'monthly_salary' => (!empty(request('monthly_salary'))?request('monthly_salary'):''),
                            'yearly_salary' => (!empty(request('yearly_salary'))?request('yearly_salary'):''),
                        ]);
            //insert back detail
             $empBankData = EmployeeBankDetail::updateOrCreate([
                              'user_id'   => request('user_id'),
                          ],[
                            'user_id' => (!empty(request('user_id'))?request('user_id'):2),
                            'account_holder_name' => (!empty(request('account_holder_name'))?request('account_holder_name'):''),
                            'account_number' => (!empty(request('account_number'))?request('account_number'):''),
                            'bank_name' => (!empty(request('bank_name'))?request('bank_name'):''),
                            'branch' => (!empty(request('bank_name'))?request('branch'):''),
                            'ifsc_code' => (!empty(request('ifsc_code'))?request('ifsc_code'):''),
                        ]);

            if(request('is_details_update') != 1){
                $this->checkAndUpdateEmpFormStep(request('user_id'), 3);
            }
            

            return json_encode(array('code'=>'success','data'=>$empFinancialData));

        }else{
            return json_encode(array('code'=>'error','message'=>'Something went wrong !! Please try again.'));
        }
    }
        


    /**
     * Store a employee document details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEmployeeDocumentDetail(Request $request)
    {

        $validator = Validator::make($request->all(),[
             'user_id' => 'required',  
             'resume_file' => 'nullable|mimes:jpg,jpeg,png',
             'offer_letter' => 'nullable|mimes:jpg,jpeg,png',
             'joining_letter' => 'nullable|mimes:jpg,jpeg,png',
             'agreement' => 'nullable|mimes:jpg,jpeg,png',
             'dropbox_url' => 'nullable',
             'google_drive' => 'nullable',
        ]);

        if ($validator->fails()) {

          $validationError = [];
          $validationErrors = $validator->errors();
          return json_encode(array('code'=>'error_validate','errors'=>$validator->errors()));
          
        }

        
        if(!empty(request('user_id'))){
         $userID = $request->input('user_id');

         if($request->input('otherDoc')){
            $extraDocDetail = $request->input('otherDoc');
            foreach ($extraDocDetail as $key => $value) {
                $lebalName = $value['label'];
                $fileObj = $request->file('otherDoc')[$key]['doc'];
                $file_name = time().'_extra_'.$fileObj->getClientOriginalName();
                $file_path = $request->file('resume_file')->storeAs('employee_documents', $file_name, 'public');
                $this->uploadEmpDocument(request('user_id'), $lebalName, $file_name, 'extra');
            }
        }

         if($request->hasFile('resume_file')) {
            $resume = $request->file('resume_file');
            $file_name = time().'_resume_'.$resume->getClientOriginalName();
            $file_path = $request->file('resume_file')->storeAs('employee_documents', $file_name, 'public');
            $this->uploadEmpDocument(request('user_id'),'resume',$file_name);
        } 
        if($request->hasFile('offer_letter')) {
            $resume = $request->file('offer_letter');
            $file_name = time().'_resume_'.$resume->getClientOriginalName();
            $file_path = $request->file('offer_letter')->storeAs('employee_documents', $file_name, 'public');
            $this->uploadEmpDocument(request('user_id'),'offer_letter',$file_name); 
        } 
        if($request->hasFile('joining_letter')) {
            $resume = $request->file('joining_letter');
            $file_name = time().'_resume_'.$resume->getClientOriginalName();
            $file_path = $request->file('joining_letter')->storeAs('employee_documents', $file_name, 'public');
            $this->uploadEmpDocument(request('user_id'),'joining_letter',$file_name); 
        } 
        if($request->hasFile('agreement')) {
            $resume = $request->file('agreement');
            $file_name = time().'_resume_'.$resume->getClientOriginalName();
            $file_path = $request->file('agreement')->storeAs('employee_documents', $file_name, 'public');
             $this->uploadEmpDocument(request('user_id'),'agreement',$file_name); 
        } 
        //check if user is already exist

        

        EmployeeAdditionalDetail::updateOrCreate([
             'user_id' => $userID,
        ],
        [
            'dropbox_url' => (!empty(request('dropbox_url'))?request('dropbox_url'):''),
            'google_drive' => (!empty(request('google_drive'))?request('google_drive'):''),
        ]);

        $this->checkAndUpdateEmpFormStep($userID,4);
 
       return json_encode(array('code'=>'success','data'=>[]));
     }else{
        return json_encode(array('code'=>'error','message'=>'Something went wrong !! Please try again.'));
     }
    }

    /**
     * Check Step value for employee form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkAndUpdateEmpFormStep($userId,$stepVal){
        if(!empty($userId) && !empty($stepVal)){
            $employeeAdditionalData = EmployeeAdditionalDetail::where('user_id', $userId)->get();

            if ((count($employeeAdditionalData) == 0) || (!empty($employeeAdditionalData[0]) && ($employeeAdditionalData[0]->step_completed < $stepVal))){
                 $abc= EmployeeAdditionalDetail::updateOrCreate([
                    'user_id' => $userId,
                 ],[
                    'step_completed' => $stepVal,
                 ]);

                
            }
        }
    }

    public function uploadEmpDocument($user_id,$fileName,$storeFileName, $category = 'main')
    {
        if(!empty($user_id) && !empty($fileName) && !empty($storeFileName) ){
            EmployeeDocumentsDetail::updateOrCreate([
                  'user_id'   => $user_id,
                  'document_name'   => $fileName,
              ],[
                'user_id'   => $user_id,
                'document_name'   => $fileName,
                'upload_file_name' => $storeFileName,
                'document_category' => $category
            ]);

            return true;
        }
    }

    public function getEmployeePersonalDetail(Request $request){
        if(!empty(request('userId'))){
            $employeeDetails = User::where('id',request('userId'))->with('employeePersonalInfo')->first();
            //print_r($employeeDetails); die;
            if(!empty($employeeDetails)){
                $employeeDetails->profile_pic_src =  Storage::disk('public')->url('profile_pics/'.$employeeDetails->employeePersonalInfo->photo);
            }
            return json_encode(array('code'=>'success','data'=>$employeeDetails));

        }else{
             return json_encode(array('code'=>'error','message'=>'Something went wrong !! Please try again.'));
        }
        

    }

    public function getEmployeeCompanyDetail(Request $request){
        if(!empty(request('userId'))){
            $employeeCompDetails = EmployeeCompanyDetail::where('user_id',request('userId'))->first();
            return json_encode(array('code'=>'success','data'=>$employeeCompDetails));

        }else{
             return json_encode(array('code'=>'error','message'=>'Something went wrong !! Please try again.'));
        }
        

    }

     public function getEmployeeFinancialDetail(Request $request){
        if(!empty(request('userId'))){
            $employeeFinancialDetail = EmployeeFinancialDetail::where('user_id',request('userId'))->with('employeeFinancialInfo')->first();
            return json_encode(array('code'=>'success','data'=>$employeeFinancialDetail));

        }else{
             return json_encode(array('code'=>'error','message'=>'Something went wrong !! Please try again.'));
        }
        

    }

    public function getTotalEmployeeCount(Request $request){

            $employeeCount = User::where('role_id',3)
                            ->whereHas('employeeAditionalInfo', function($q){
                                    $q->where('step_completed',4);
                            })->count();
            //$employeeCount = User::where('role_id',3)->with('employeePersonalInfo')->count();
            if(!empty($employeeCount)){
                return json_encode(array('code'=>'success','totalEmployeeCount'=>$employeeCount));
            }else{
                return json_encode(array('code'=>'error','message'=>'Something went wrong !! Please try again.'));
            }
        

    }
    
    public function getFilledFormSetup(Request $request){
        if(!empty(request('userId'))){
            $employeeAdditionalDetail = EmployeeAdditionalDetail::where('user_id',request('userId'))->first();
            if(!empty($employeeAdditionalDetail)){
                return json_encode(array('code'=>'success','step_completed'=>$employeeAdditionalDetail->step_completed));
            }else{
                 return json_encode(array('code'=>'error','message'=>'Data not found.'));
            }
        }else{
             return json_encode(array('code'=>'error','message'=>'Something went wrong !! Please try again.'));
        }
    }

    public function getEmployees(Request $request)
    {
        $show_records = env('DEFAULT_PAGINATION_RECORD');
        $parmas = (!empty(request('params'))) ? request('params') : [];
        if(!empty($parmas)){
           $show_records = $parmas['show_records'];
        }
        $employees = User::where('role_id',3)->with('employeePersonalInfo','employeeCompanyInfo','employeeCompanyInfo.empDesignationInfo', 'employeeCompanyInfo.empDepartmentInfo' )->paginate($show_records);
        
       //print_r($employees); die;

         return json_encode(array('code'=>'success','employees'=>$employees));
    }


    /**
     * create pdf of offer letter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createOfferLetterPdf(Request $request)
    {

        
        if(!empty(request('userId'))){
            $myProjectDirectory = base_path();
            $snappy = new Pdf($myProjectDirectory . '/vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64');
            $employeeDocumentFormatData = EmployeeDocumentFormats::where('employee_id',request('userId'))->first();
            if(!empty($employeeDocumentFormatData)){
                  $pdfData = $employeeDocumentFormatData->description;

                  
                  $pdf_path = public_path('/storage/offer_pdf/');
                  
                  $pdf_name = request('userId')."_offer_letter_".time().".pdf";
                  $snappy->generateFromHtml($pdfData, $pdf_path.$pdf_name);
                    
                  $pdf_access_path = url('/').'/storage/offer_pdf/'.$pdf_name;

                  return json_encode(array('code'=>'success','pdf_path'=>$pdf_access_path));
            }else{
                return json_encode(array('code'=>'error','message'=>'Data Not Found.'));
            }

        }else{
              return json_encode(array('code'=>'error','message'=>'Something went wrong !! Please try again.'));
        }
        
        
    }

    public function getEmployeeOfferLetterContent(Request $request){
        if(!empty(request('userId'))){

            $employeeDocumentFormatsDetail = EmployeeDocumentFormats::where('company_id',Auth::id())->where('employee_id',request('userId'))->where('title','offer_letter')->first();

            if(!empty($employeeDocumentFormatsDetail)){
                return json_encode(array('code'=>'success','letter_content'=>$employeeDocumentFormatsDetail->description));
            }else{
                $companyDocumentFormatDetail = CompanyDocumentFormat::where('company_id',Auth::id())->where('alias','offer_letter')->first();
                $allowed_vars = $companyDocumentFormatDetail->allowed_vars;
                $description = $companyDocumentFormatDetail->description;
                    
                if(!empty($companyDocumentFormatDetail)){

                    $employeeDetails = User::where('id',request('userId'))->with('employeePersonalInfo','employeeCompanyInfo','employeeCompanyInfo.empDesignationInfo', 'employeeCompanyInfo.empDepartmentInfo' )->first();
                    if(!empty($employeeDetails)){
                        
                        $replace_fields['candidate_name'] = $employeeDetails->name;
                        $replace_fields['address'] = @$employeeDetails->employeePersonalInfo->current_address;
                        $replace_fields['hire_position'] = @$employeeDetails->employeeCompanyInfo->empDesignationInfo->name;
                        $replace_fields['company_name'] = 'HR SOLUTION PVT LTD';

                        $replace_with = explode(',',$companyDocumentFormatDetail->allowed_vars);
                        $new_description = str_replace($replace_with,$replace_fields,$description);
                        return json_encode(array('code'=>'success','letter_content'=>$new_description));
                    
                    }
                    
                }else{
                    return json_encode(array('code'=>'error','message'=>'Data not found.'));
                }
            }

            
        }else{
             return json_encode(array('code'=>'error','message'=>'Something went wrong !! Please try again.'));
        }
    }

    public function storeEmployeeLetterDetails(Request $request){
        
        $validator = Validator::make($request->input('ckFieldsData'),[
            'description' => 'required',  
        ]);

       if ($validator->fails()) {

         $validationError = [];
         $validationErrors = $validator->errors();
         return json_encode(array('code'=>'error_validate','errors'=>$validator->errors()));
         
       }
        $requestData = $request->input('ckFieldsData');
        if(!empty($requestData['emp_id'])){
            $employeeDocumentFormatDetails = EmployeeDocumentFormats::updateOrCreate(
                                            [
                                                'company_id' => Auth::id(),
                                                'employee_id' => $requestData['emp_id'],
                                                'title' => 'offer_letter',
                                            ],[
                                                'company_id' => Auth::id(),
                                                'employee_id' => $requestData['emp_id'],
                                                'title' => 'offer_letter',
                                                'description' => $requestData['description'],
                                            ]);
            if(!empty($employeeDocumentFormatDetails)){

                 return json_encode(array('code'=>'success','document_details'=>$employeeDocumentFormatDetails));
                   
            }else{
                 return json_encode(array('code'=>'error','message'=>'Data not found.'));
            }
        }else{
             return json_encode(array('code'=>'error','message'=>'Something went wrong !! Please try again.'));
        }
    }
    
    
    public function getEmployeePreviewData(Request $request, $empID)
    {
        $employeeDetail = User::where('id', $empID)->with('employeePersonalInfo','employeeCompanyInfo','employeeCompanyInfo.empDesignationInfo', 'employeeCompanyInfo.empDepartmentInfo', 'employeeFinancialInfo', 'employeeBankInfo', 'EmployeeDocumentsInfo', 'EmployeeAdditionalInfo' )->first();
         return json_encode(array('code'=>'success','employees'=>$employeeDetail));
    }
    /**
     * [getEmployeeprofileData description]
     * @param  Request $request [description]
     * @param  [type]  $empID   [description]
     * @return [type]           [description]
     */
    public function getEmployeeprofileData(Request $request, $empID)
    {
        if(!empty($empID)){
            $id = $this->decrypt($empID);
            $employeeDetail = User::where('id', $id)->with('employeePersonalInfo','employeeCompanyInfo','employeeCompanyInfo.empDesignationInfo', 'employeeCompanyInfo.empDepartmentInfo', 'employeeFinancialInfo', 'employeeBankInfo', 'EmployeeDocumentsInfo', 'EmployeeAdditionalInfo' )->first();
            return $this->sendSuccessResponse([
                'employee' => $employeeDetail], 'Emplyoee detail!');
        }else{
            return $this->sendValidationError([], 'Employee is not found!');
        }
        
    }

    public function getAllowancesAndDeductionList(Request $request)
    {
        
        $allowancesData = Allowances::get();
        $deductionsData = Deductions::get();
        return json_encode(array('code'=>'success','allowancesData'=> $allowancesData,'deductionsData'=> $deductionsData));
    }

}
