<?php

namespace App\Http\Controllers\Admin;

use App\Branch;
use App\EmployeeInfo;
use App\Http\Controllers\AppHelper;
use App\Http\Controllers\Controller;
use App\Role;
use App\SubCategory;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EmployeeInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!Gate::denies('employee_access')) {
            $employeeInfo = EmployeeInfo::with('user:id,name,email')->get();
        } elseif (!Gate::denies('branch_employee_access')) {
            $master = Branch::all();
            $empid = array();
            foreach ($master as $value) {
                if (is_array($value['manager']) && in_array(Auth::id(), $value['manager'])) {
                    $empid = array_merge($empid, $value['employee']);
                }
            }

            $employeeInfo = EmployeeInfo::with('user:id,name,email')->whereIn('emp_id', $empid)->get();
        } else {

            abort_if(true, Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        return view('admin.employee.index', compact('employeeInfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        abort_if(Gate::denies('employee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $subCate = SubCategory::orderBy('name', 'asc')->get();
        $roles = Role::all();
        return view('admin.employee.create', compact('subCate', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'bail|required|max:255|min:4',
            'email' => 'bail|required|email|unique:users|max:255',
            'password' => 'bail|required|min:6',
            'icon' => 'bail|required|image',
            'address' => 'bail|required',
        ]);
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        $reqData = $request->all();
        $reqData['status'] = $request->has('status') ? 1 : 0;
        $reqData['emp_id'] = $user['id'];
        if ($request->icon && $request->icon != "undefined") {
            $reqData['icon'] = (new AppHelper)->saveImage($request);
        }
        EmployeeInfo::create($reqData);

        return redirect()->route('employee.index')->withStatus(__('Employee is added successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeeInfo  $employeeInfo
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeInfo $employee)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeInfo  $employeeInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeInfo $employee)
    {

        abort_if(Gate::denies('employee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subCate = SubCategory::orderBy('name', 'asc')->get();
        $roles = Role::all();
        $user = User::find($employee->emp_id);
        return view('admin.employee.edit', compact('roles', 'subCate', 'user', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeInfo  $employeeInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeInfo $employee)
    {

        $request->validate([
            'name' => 'bail|required|max:255|min:4',

        ]);
        $user = User::find($employee->emp_id);
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        if ($request->icon && $request->icon != "undefined") {
            $reqData['icon'] = (new AppHelper)->saveImage($request);
        }

        $reqData['status'] = $request->has('status') ? 1 : 0;
        $employee->update($reqData);

        return redirect()->route('employee.index')->withStatus(__('Employee is updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeInfo  $employeeInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeInfo $employee)
    {

        abort_if(Gate::denies('employee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employee->delete();

        return back()->withStatus(__('employee is deleted successfully.'));
    }
}
