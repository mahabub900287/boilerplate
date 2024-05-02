<?php

namespace App\Http\Controllers\Admin\New;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\Admin\AdminService;
use App\DataTables\Admin\AdminDataTable;
use App\Http\Requests\Admin\ProfileRequest;
use App\Services\Utilities\FileUploadService;

class AdminController extends Controller
{
    protected $adminservice;

    protected $fileUploadService;

    public function __construct(AdminService $adminservice, FileUploadService $fileUploadService)
    {
        $this->adminservice = $adminservice;
        $this->fileUploadService = $fileUploadService;
    }

    public static function middleware(): array
    {
        return [
            'permission:All Admins|Create Admin|Edit Admin|Delete Admin' => ['only' => ['index', 'store']],
            'permission:Create Admin' => ['only' => ['create', 'store']],
            'permission:Edit Admin' => ['only' => ['edit', 'update']],
            'permission:Delete Admin' => ['only' => ['destroy']],
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminDataTable $dataTable)
    {
        $page_title = 'Admin list';
        setbreadcumb("Admin list");
        return $dataTable->render('admin.admin.new-admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        setbreadcumb("Admin Create", "Admin" , route('admin.new-admin.index'));
        $roles = \Spatie\Permission\Models\Role::select('id', 'name')->get();
        return view('admin.admin.new-admin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        $data = $request->validated();
        try {
            isset($data['status']) ? $data['status'] = 'active' : $data['status'] = 'inactive';
            $data['type']  = 'admin';
            $this->adminservice->storeOrUpdate($data);
            $notify[] = ['success', 'Admin Create successful'];
            return redirect()->route('admin.new-admin.index')->withNotify($notify);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        setbreadcumb("Show Admin", "Admin" , route('admin.new-admin.index'));
        $item = User::find($id);
        return view('admin.admin.new-admin.shows', compact('item'));
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
            $item = $this->adminservice->get($id);
            $roles = \Spatie\Permission\Models\Role::select('id', 'name')->get();
            setbreadcumb("Admin Edit", "Admin" , route('admin.new-admin.index'));
            // $roles = \Spatie\Permission\Models\Role::select('id', 'name')->get();
            return view('admin.admin.new-admin.edit', compact('item', 'roles'));
        } catch (\Exception $e) {
            $notify[] = ['error', 'Something is Wrong'];

            return redirect()->back()->withNotify($notify);
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        $data = $request->validated();
        // try {
        isset($data['status']) ? $data['status'] = 'active' : $data['status'] = 'inactive';
        $data['type']  = 'admin';
        $this->adminservice->storeOrUpdate($data, $id);
        $notify[] = ['success', 'Admin Update successful'];

        return redirect()->route('admin.new-admin.index')->withNotify($notify);
        // } catch (\Exception $e) {

        //     return back();
        // }
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
            $item = User::find($id);
            if ($item->avatar !== null) {
                $this->fileUploadService->delete('user/' . $item->avatar);
            }
            $item->delete();
            $notify[] = ['success', 'User Delete successfully'];

            return redirect()->route('admin.users.index')->withNotify($notify);
        } catch (\Exception $e) {
            return back();
        }
    }
}
