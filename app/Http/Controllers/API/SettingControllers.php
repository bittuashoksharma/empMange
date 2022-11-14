<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CompanyDocumentFormat;
use Auth;
class SettingControllers extends Controller
{
    /**
     * Store a offer letter format details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOfferLetterFormat(Request $request)
    {
        $requestData = $request->all();
       
       
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'alias' => 'nullable',
            'allowed_vars' => 'nullable',
            'description' => 'nullable',
            
        ]);

        if ($validator->fails()) {

          $validationError = [];
          $validationErrors = $validator->errors();
          return json_encode(array('code'=>'error_validate','errors'=>$validator->errors()));
          
        }
        
        if(!empty($request->all())){
            $companyDocumentFormatData = CompanyDocumentFormat::updateOrCreate([
                              'company_id'   => Auth::id(),
                          ],[
                            'title' => (!empty(request('title'))?request('title'):''),
                            'alias' => 'offer_letter',
                            'allowed_vars' => (!empty(request('allowed_vars'))?request('allowed_vars'):''),
                            'description' => (!empty(request('description'))?request('description'):''),
                            
                        ]);
            return json_encode(array('code'=>'success','data'=>$companyDocumentFormatData));
           
        }else{
            return json_encode(array('code'=>'error','message'=>'Something went wrong !! Please try again.'));
        }
    }

    /**
     * get a offer letter format details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCompanyOfferLetterFormatDetail(Request $request){
       
        if(!empty(Auth::id())){
           
            $companyDocumentFormatDetails = CompanyDocumentFormat::where('company_id',Auth::id())->where('alias','offer_letter')->first();
            return json_encode(array('code'=>'success','data'=>$companyDocumentFormatDetails));

        }else{
             return json_encode(array('code'=>'error','message'=>'Something went wrong !! Please try again.'));
        }
        

    }
}
