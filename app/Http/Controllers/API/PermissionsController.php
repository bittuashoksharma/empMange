<?php

namespace App\Http\Controllers\API;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
class PermissionsController extends Controller
{

     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPermission(Request $request)
    {
        $permission = new Permission;

        $show_records = env('DEFAULT_PAGINATION_RECORD');
        $parmas = (!empty(request('params'))) ? request('params') : [];
        if(!empty($parmas)){
           $show_records = $parmas['show_records'];
        }
        if(!empty($parmas['search'])){
            $search_data = $parmas['search'];
            $permission = $permission->where('name', 'like',  '%' . $search_data .'%');
        }
        
        $permission = $permission->paginate($show_records);
        
        return json_encode(array('code'=>'success','permission'=>$permission));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePermission(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:permissions|regex:/^[a-zA-Z_\-]*$/',
        ]);
        if ($validator->fails()) {

          $validationError = [];
          $validationErrors = $validator->errors();
          return json_encode(array('code'=>'error_validate','errors'=>$validator->errors()));
          
        }
        
        $permissionData = Permission::updateOrCreate(
                            [
                                'id' => $request->input('id')
                            ],
                            [
                                'name' => $request->input('name'),
                                'guard_name' => 'web',
                            ]);

        return json_encode(array('code'=>'success','data'=>$permissionData));
    }


    /**
     * get a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPermissionListing(Request $request)
    {
        $permission = Permission::get();
        return json_encode(array('code'=>'success','permission'=>$permission));
    }
}
