<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Validator;
use Auth;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
use App\Models\Role;
use App\Models\RouteModel;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->get_privilege();
    }

    public function index()
    {
        # code...
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }


    public function create()
    {
        # code...
        return view('roles.create');
    }


    public function store(RoleRequest $request)
    {
        \Session::flash('success', trans('messages.Added Successfully'));
        Role::create($request->all());
        return redirect('roles');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('roles.edit', compact('role'));
    }


    public function update(RoleRequest $request)
    {
        $role = Role::findOrFail($request->id);
        $role->update($request->all());
        \Session::flash('success', trans('messages.updated successfully'));
        return redirect('roles');
    }


    public function destroy($id)
    {

        $role = Role::findOrFail($id);

        $role->delete();


        \Session::flash('success', trans('messages.custom-messages.deleted'));

        return redirect('roles');
    }

    public function view_access($id)
    {
        $controllers = $this->get_controllers(); // in main controller
        $routes = RouteModel::all();
        $role = Role::findOrFail($id);
        $query = "SELECT * FROM routes JOIN role_route ON routes.id = role_route.route_id JOIN roles ON role_route.role_id = roles.id WHERE roles.id = $id ORDER BY routes.controller_name"; // order by here to sort them as the file system sorting
        $methods = \DB::select($query);
        return view('roles.access', compact('role', 'routes', 'controllers', 'methods'));
    }
}
