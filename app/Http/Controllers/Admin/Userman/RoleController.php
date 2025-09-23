<?php

namespace App\Http\Controllers\Admin\Userman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    public function view(){
    $data['permission'] = DB::table('permissions')->get()->map(function($input){
            $permission = str_replace('-',' ',explode(' ',$input->name));
            $count = count($permission);
            $data['id'] = $input->id;
            $data['title'] = $count == 3 ? ucwords($permission[0].' -> '.$permission[1]) : ucwords($permission[0]) ;
            $data['permission'] = $count == 3 ? $permission[2] : $permission[1];
            return $data;
        })->groupBy('title');
        return view('admin.userman.role',$data);
    }

    public function getAll(){
        $data = DB::table('roles')
            ->leftJoin('model_has_roles','model_has_roles.role_id','=','roles.id')
            ->select('roles.*', DB::raw("count(model_has_roles.model_id) as user_count"))
            ->groupBy('roles.id')
            ->get()->map(function($input){
                $permission = DB::table('role_has_permissions')->where('role_id',$input->id)->pluck('permission_id');
                $input->permission = $permission;
                return $input;
            });
        return response()->json(['data' => $data], 200);
    }
    public function store(){
        $req = $this->validate(request(),
            [
                'name' => 'required',
                'guard' => 'required',
                'permission' => 'nullable',
            ]);
        if ($req['permission']) {
            $permission = explode(',',$req['permission']);
            $permission = Permission::whereIn('id',$permission)->get();
        }
        try {
            $role =  Role::create(['name' => strtolower($req['name']),'guard_name' => strtolower($req['guard'])]);
            $role->syncPermissions($permission?? null);
            return response()->json(['success' => "Role created successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    public function update($id){
        $req = $this->validate(request(),[
            'name' => 'required',
            'guard' => 'required',
            'permission' => 'nullable',
        ]);
        $req['updated_at'] = now();
        if ($req['permission']) {
            $permission = explode(',',$req['permission']);
            $permission = Permission::whereIn('id',$permission)->get();
        }
        $role = Role::where('id',$id)->first();
        if (!$role) {
            return response()->json(['error' => "role not found"], 404);
        }
        if ($role->name == 'admin') {
            return response()->json(['error' => "Cannot update role admin"], 404);
        }
        try {
            $roleUpdate =  Role::where('id',$id)->update(['name' => strtolower($req['name']),'guard_name' => strtolower($req['guard'])]);
            $role->syncPermissions($permission?? null);
            return response()->json(['success' => "User updated successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function delete($id){
        $role = DB::table('roles')->where('id',$id)->first();
        if ($role->name == 'admin') {
            return response()->json(['error' => "Cannot update role admin"], 404);
        }
        if (!$role) {
            return response()->json(['error' => "Role not found"], 404);
        }
        try {
            DB::table('roles')->delete($id);
            DB::table('model_has_roles')->where('role_id',$id)->delete();
            return response()->json(['success' => "Role deleted successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => "Internal server error"], 500);
        }
    }
}
