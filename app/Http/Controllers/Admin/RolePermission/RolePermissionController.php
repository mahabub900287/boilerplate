<?php

namespace App\Http\Controllers\Admin\RolePermission;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Services\Admin\RolePermission\RolePermissionService;
use App\DataTables\Admin\RolePermission\RolePermissionDataTable;
use App\Http\Requests\Admin\RolePermissionRequest;

class RolePermissionController extends Controller
{
    protected $rolePermissionService;

    public function __construct(RolePermissionService $rolePermissionService)
    {
        $this->rolePermissionService = $rolePermissionService;
    }
    public static function middleware(): array
    {
        return [
            'permission:All Roles|Create Role|Edit Role|Delete Role' => ['only' => ['index', 'store']],
            'permission:Create Role' => ['only' => ['create', 'store']],
            'permission:Edit Role' => ['only' => ['edit', 'update']],
            'permission:Delete Role' => ['only' => ['destroy']],
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RolePermissionDataTable $dataTable)
    {
        $page_title = 'Show Role Permission List';
        setbreadcumb("Role-Permission List");
        return $dataTable->render('admin.role_permission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        setbreadcumb("Create Role", "Role-Permission", route('admin.roles.index'));
        return view('admin.role_permission.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolePermissionRequest $request)
    {
        $data = $request->validated();
        try {
            $this->rolePermissionService->storeOrUpdate($data);
            $notify[] = ['success', 'Role Create successfully'];

            return redirect()->route('admin.roles.index')->withNotify($notify);
        } catch (\Exception $e) {
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = $this->rolePermissionService->roleEdit($id);
            $role = $data['role'];
            $permissions = $data['permissions'];
            $rolePermissions = $data['rolePermissions'];
            setbreadcumb("Edit Role", "Role-Permission" , route('admin.roles.index'));
            return view('admin.role_permission.edit', compact('role', 'permissions', 'rolePermissions'));
        } catch (\Exception $e) {
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolePermissionRequest $request, $id)
    {
        $data = $request->validated();
        try {
            $this->rolePermissionService->storeOrUpdate($data, $id);
            $notify[] = ['success', 'Role Update successfully'];

            return redirect()->route('admin.roles.index')->withNotify($notify);
        } catch (\Exception $e) {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->rolePermissionService->delete($id);
            $notify[] = ['success', 'Role delete successfully'];

            return redirect()->route('admin.roles.index')->withNotify($notify);
        } catch (\Exception $e) {
            return back();
        }
    }
}
