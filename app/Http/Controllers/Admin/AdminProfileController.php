<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Common\UserService;
use App\Http\Requests\Admin\ProfileRequest;

class AdminProfileController extends Controller
{
    protected $userservice;

    public function __construct(UserService $userservice)
    {
        $this->userservice = $userservice;
    }
    //
    public function profileEdit($id)
    {
        setbreadcumb("Profile", "Administration");
        return view('admin.admin.edit');
    }
    public function profileupdate(ProfileRequest $request, $id)
    {
        $data = $request->validated();
        try {
            $this->userservice->storeOrUpdate($data, $id);
            $notify[] = ['success', 'Admin Profile Update successful'];
            return redirect()->back()->withNotify($notify);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
