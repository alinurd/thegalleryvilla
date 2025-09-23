<?php

namespace App\Http\Controllers\Admin\Userman;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function view(){
        $data['role']= DB::table('roles')->get();
        return view('admin.userman.user',$data);
    }

    public function getAll(){
        // $hideUser = ['muhammad.andialrizki@gmail.com'];
        $data = DB::table('users')
            ->leftJoin('model_has_roles','model_has_roles.model_id','=','users.id')
            ->leftJoin('roles','roles.id','=','model_has_roles.role_id')
            ->select('users.*','roles.name as role')
            // ->whereNotIn('email', $hideUser)
            // ->orderByRaw('CAST(status AS SIGNED) ASC, created_at DESC')
            ->orderByRaw("
                CASE
                    WHEN status = '1' THEN 1
                    WHEN status = '-1' THEN 2
                    ELSE 3
                END,
                created_at DESC
            ")
            ->get();
        return response()->json(['data' => $data], 200);
    }

    public function store(Request $req){
        if ($req['mobile_phone']) {
            $req['mobile_phone'] = phoneIndo($req['mobile_phone']);
        }
        $req = $this->validate($req,
        [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile_phone' => 'nullable|unique:users,mobile_phone',
            'password' => 'required|confirmed|min:6',
            'status' => 'required',
            'role'  =>'required|exists:roles,name',
            'avatar'  =>'nullable|mimes:jpeg,png,jpg,gif',
        ]);
        try {

            if (request()->file('avatar')) {
                $avatar = request()->file('avatar');
                $req['avatar'] = fileUpload($avatar,'images/user/');
            }
            $req['password'] = bcrypt($req['password']);
            $req['created_at'] = now();

            DB::beginTransaction();
            $user = User::create(Arr::except($req,['role']));
            $role = Role::where('name',$req['role'])->first()->id;
            User::find($user->id)->syncRoles($role);
            DB::commit();
            return response()->json(['success' => "User created successfully"], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update($id){
        $req = request();
        if ($req['mobile_phone']) {
            $req['mobile_phone'] = phoneIndo($req['mobile_phone']);
        }
        $req = $this->validate($req,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'mobile_phone' => 'nullable',
            'password' => 'nullable|confirmed',
            'status' => 'required',
            'role'  =>'required|exists:roles,name',
            'avatar'  =>'nullable|mimes:jpeg,png,jpg,gif',
        ]);
        $user = DB::table('users')->where('id',$id)->first();
        if (!$user) {
            return response()->json(['error' => "User not found"], 404);
        }
        try {
            if (request()->file('avatar')) {
                $avatar = request()->file('avatar');
                $req['avatar'] = fileUpload($avatar,'images/user/',$user->avatar);
            }
            $req['password'] = $req['password'] ? bcrypt($req['password']) : $user->password;
            DB::table('users')->where('id',$id)->update(Arr::except($req,['role']));
            $role = Role::where('name',$req['role'])->first();
            User::find($id)->syncRoles($role);

            return response()->json(['success' => "User updated successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function delete($id){
        $user = DB::table('users')->where('id',$id)->first();
        if (!$user) {
            return response()->json(['error' => "User not found"], 404);
        }
        try {
            DB::table('users')->delete($id);
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            fileDelete($user->avatar,'images/user/');
            return response()->json(['success' => "User deleted successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => "Internal server error"], 500);
        }
    }
    public function changeStatus(Request $request){
        $id = $request->id;
        $newStatus = $request->status;
        $user = DB::table('users')->where('id',$id)->first();
        if (!$user) {
            return response()->json(['error' => "User not found"], 404);
        }
        try {
            // if($user->status == 1) {
            //     $newStatus = 0;
            // } else {
            //     $newStatus = 1;
            // }
            DB::table('users')->where(['id' => $id])->update([
                'status' => $newStatus
            ]);
            return response()->json(['success' => "User status change successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => "Internal server error"], 500);
        }
    }

    public function browseUserData(Request $type)
    {

        $users = User::doesntHave('profile')->role('member'); // Spatie Role filter

        return DataTables::eloquent($users)
            ->addIndexColumn()
            ->addColumn('action', function ($user) {
                return '<button type="button" class="btn btn-sm btn-primary" onclick="selectUser('
                    . $user->id . ',  \''
                    . addslashes($user->idcode) . '\', \''
                    . addslashes($user->name) . '\', \''
                    . addslashes($user->email) . '\', \''
                    . addslashes($user->mobile_phone)
                    . '\')">Pilih</button>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function browseUserDataByUserType($type)
    {
        $users = User::doesntHave('profile')->role($type);
        return DataTables::eloquent($users)
            ->addIndexColumn()
            ->addColumn('action', function ($user) {
                return '<button type="button" class="btn btn-sm btn-primary" onclick="selectUser('
                    . $user->id . ',  \''
                    . addslashes($user->idcode) . '\', \''
                    . addslashes($user->name) . '\', \''
                    . addslashes($user->email) . '\', \''
                    . addslashes($user->mobile_phone)
                    . '\')">Pilih</button>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
