<?php

namespace App\Http\Controllers\API;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use DB;
use Carbon\Carbon;
use Storage;
use Auth;

class RolesController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRoleListing(Request $request)
    {
        $roles = Role::where('soft_delete',0);

        $show_records = env('DEFAULT_PAGINATION_RECORD');
        $parmas = (!empty(request('params'))) ? request('params') : [];
        if(!empty($parmas)){
           $show_records = $parmas['show_records'];
        }
        if(!empty($parmas['search'])){
            $search_data = $parmas['search'];
            $roles = $roles->where('name', 'like',  '%' . $search_data .'%');
        }

        $roles = $roles->with('permissions')->paginate($show_records);

        return json_encode(array('code'=>'success','roles'=>$roles));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRolePermission(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'label' => 'required',
            'name' => 'required|unique:roles',
            'permissions' => 'required'
        ]);
        if ($validator->fails()) {

          $validationError = [];
          $validationErrors = $validator->errors();
          return json_encode(array('code'=>'error_validate','errors'=>$validator->errors()));
          
        }
        
        $role = Role::create([
            'name'=> $request->input('name'),
            'label'=> $request->input('label'),
            'guard_name'=> 'web',
        ]);
        $role->givePermissionTo($request->permissions);

        return json_encode(array('code'=>'success','data'=>$role));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Role::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRolePermission(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'label' => 'required',
            'name' => 'required|unique:roles,name,'.$request->input('id'),
            'permissions' => 'required'
        ]);
        if ($validator->fails()) {

          $validationError = [];
          $validationErrors = $validator->errors();
          return json_encode(array('code'=>'error_validate','errors'=>$validator->errors()));
          
        }
        
        $role = Role::updateOrCreate([
            'id'=> $request->input('id'),
        ],[
            'name'=> $request->input('name'),
            'label'=> $request->input('label'),
            'guard_name'=> 'web',
        ]);
        $role->syncPermissions($request->permissions);

        return json_encode(array('code'=>'success','data'=>$role));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteRole($id)
    {
        try {
            Role::where('id',$id)->update(['soft_delete'=>'1']);
            return ['status'=>'success'];
        } catch (ModelNotFoundException $e) {
            return ['status'=>'error'];
        }
    }
}
