<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use Illuminate\Support\Facades\Input;
use \Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use \Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $employees = User::all();
        $roles = Role::all();
        $user = Auth::user();
        return view('employee.index')->with('employee', $employees)->with('roles', $roles)->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
            return view('employee.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users',
            'name'=>'required',
            'password'=>'required|min:6',
            'password_confirmation'=>'required|same:password'
        ]);
        // store
        $users = new User;
        $users->name = Input::get('name');
        $users->email = Input::get('email');
        $users->password = Hash::make(Input::get('password'));
        $users->save();

        Session::flash('message', __('You have successfully added employee'));
        return Redirect::to('employees');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $employees = User::find($id);
        return view('employee.edit')
            ->with('employee', $employees);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        if ($id == 1) {
            Session::flash('message', 'You cannot edit admin on FlexiblePos v2.0');
            Session::flash('alert-class', 'alert-danger');
                return Redirect::to('employees');
        } else {
            $rules = array(
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id .'',
            'password' => 'nullable|min:6|max:30|confirmed',
            );
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                 return Redirect::to('employees/' . $id . '/edit')
                ->withErrors($validator);
            } else {
                $users = User::find($id);
                $users->name = Input::get('name');
                $users->email = Input::get('email');
                if (!empty(Input::get('password'))) {
                    $users->password = Hash::make(Input::get('password'));
                }
                $users->save();
                // redirect
                Session::flash('message', __('You have successfully updated employee'));
                return Redirect::to('employees');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($id == 1) {
            Session::flash('message', __('You cannot delete admin on FlexiblePos'));
            Session::flash('alert-class', 'alert-danger');
                return Redirect::to('employees');
        } else {
            try {
                $users = User::find($id);
                $users->delete();
                // redirect
                Session::flash('message', __('You have successfully deleted employee'));
                return Redirect::to('employees');
            } catch (\Illuminate\Database\QueryException $e) {
                Session::flash('message', __('Integrity constraint violation: You Cannot delete a parent row'));
                Session::flash('alert-class', 'alert-danger');
                return Redirect::to('employees');
            }
        }
    }

    public function assignRoles(Request $request)
    {
        $this->validate($request, [
            'email'=>'required|exists:users',
            'role'=>'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user->id == 1) {
            Session::flash('message', 'You can not assign admin role');
            Session::flash('alert-class', 'alert-danger');
            return back();
        }
        $role = $request->role;
        $all_past_roles = $user->getRoleNames();

        foreach ($all_past_roles as $value) {
            $user->removeRole($value);
        }
        $user->assignRole($role);
        Session::flash('message', __('Role Assigned Successfully!'));
        return back();
    }

    public function roleCreate(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
        ]);
        Role::create(['name' => str_slug($request->name)]);
        return back();
    }

    public function permissionList($role_id = null)
    {
        $roles = Role::pluck('name', 'id');
        $all_permissions = [];
        $permissions = Permission::all();
        foreach ($permissions as $key => $value) {
            $permission_set = '';
            $permission_name = explode(' ', $value->label);
            if ($key == 0) {
                $permission_set = $permission_name[1];
            }
            if (strtolower($permission_set) == strtolower($permission_name[1])) {
                $all_permissions[$permission_set][] = $value;
            } else {
                $permission_set = $permission_name[1];
                $all_permissions[$permission_set][] = $value;
            }
        }
        $role= Role::oldest()->first();
        if (!empty($role_id)) {
            $role = Role::findById($role_id);
        }
        return view('employee.permissions', compact('permissions', 'roles', 'role', 'role_id', 'all_permissions'));
    }

    public function createPermission(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'label'=>'required',
        ]);
        Permission::create(['label'=>$request->label, 'name' => $request->name]);
        return back();
    }

    public function rolePermissionMapping(Request $request)
    {
        $this->validate($request, [
            'role_id'=>'required',
            'permissions'=>'required',
        ]);
        $role = Role::findById($request->role_id);
        if ($role->name == 'admin') {
            Session::flash('message', 'You can not edit admin permissions');
            Session::flash('alert-class', 'alert-danger');
            return back();
        }
        $permissions = $request->permissions;
        
        // Delete all Previous Permissions
        $this->deleteAllPrevPermissions($role->id);
       
        foreach ($permissions as $value) {
            $permission = Permission::findById($value);
            $role->givePermissionTo($permission->name);
        }
        Session::flash('message', __('Permission given to role successfully!'));
        return back();
    }

    public function deleteAllPrevPermissions($role_id)
    {
        DB::table('role_has_permissions')->where('role_id', $role_id)->delete();
    }

}
