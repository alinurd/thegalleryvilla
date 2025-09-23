<?php

namespace App\Http\Controllers\Admin\Userman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Arr;

class PermissionController extends Controller
{
    public function view(){
        return view('admin.userman.permission');
    }

    public function getAll(){
        $data = DB::table('permissions')
            ->select('permissions.*','guard_name as guard')
            ->get();
        return response()->json(['data' => $data], 200);
    }
    public function store(Request $req){
        $req = $this->validate($req,
            [
                'name' => 'required',
                'guard' => 'required',
            ]);
        $req['guard_name'] = $req['guard'];
        $req['created_at'] = now();
        $req['updated_at'] = now();
        try {
            $role = DB::table('permissions')->insertGetId($req);
            return response()->json(['success' => "Permission created successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    public function update($id){
        $req = $this->validate(request(),[
            'name' => 'required',
            'guard' => 'required',
        ]);
        $req['guard_name'] = $req['guard'];
        $req['updated_at'] = now();
        $role = DB::table('permissions')->where('id',$id)->first();
        if (!$role) {
            return response()->json(['error' => "Permission not found"], 404);
        }
        try {
            DB::table('permissions')->where('id',$id)->update(Arr::except($req,['guard']));
            return response()->json(['success' => "Permission updated successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function delete($id){
        $permission = DB::table('permissions')->where('id',$id)->first();
        if (!$permission) {
            return response()->json(['error' => "Permission not found"], 404);
        }
        try {
            DB::table('permissions')->delete($id);
            DB::table('role_has_permissions')->where('permission_id',$id)->delete();
            DB::table('model_has_permissions')->where('permission_id',$id)->delete();
            return response()->json(['success' => "Permission deleted successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => "Internal server error"], 500);
        }
    }
}
