<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\User;

use App\Http\Controllers\Controller;
use App\Services\Common\UserService;
use App\DataTables\Admin\UserDataTable;
use App\Http\Requests\Admin\ProfileRequest;
use App\Services\Utilities\FileUploadService;

class UserController extends Controller
{
    protected $userservice;

    protected $fileUploadService;

    public function __construct(UserService $userservice, FileUploadService $fileUploadService)
    {
        $this->userservice = $userservice;
        $this->fileUploadService = $fileUploadService;
    }
    public static function middleware(): array
    {
        return [
            'permission:All Users|Create User|Edit User|Delete User' => ['only' => ['index', 'store']],
            'permission:Create User' => ['only' => ['create', 'store']],
            'permission:Edit User' => ['only' => ['edit', 'update']],
            'permission:Delete User' => ['only' => ['destroy']],
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTable)
    {
        setbreadcumb("Users List");
        return $dataTable->render('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        setbreadcumb("Users Create", "Users", route('admin.users.index'));
        return view('admin.users.create');
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
            $this->userservice->storeOrUpdate($data);
            $notify[] = ['success', 'User Create successful'];
            return redirect()->route('admin.users.index')->withNotify($notify);
        } catch (\Exception $e) {
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
        setbreadcumb("Users Show", "Users", route('admin.users.index'));
        $item = User::find($id);
        return view('admin.users.shows', compact('item'));
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
            $item = $this->userservice->get($id);
            setbreadcumb("Users Edit", "Users", route('admin.users.index'));
            return view('admin.users.edit', compact('item'));
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
        try {
            isset($data['status']) ? $data['status'] = 'active' : $data['status'] = 'inactive';
            $this->userservice->storeOrUpdate($data, $id);
            $notify[] = ['success', 'User Update successful'];

            return redirect()->route('admin.users.index')->withNotify($notify);
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
