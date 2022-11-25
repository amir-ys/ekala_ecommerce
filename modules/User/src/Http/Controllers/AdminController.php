<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Core\Responses\AjaxResponse;
use Modules\Core\Services\ImageService;
use Modules\RolePermissions\Contracts\RoleRepositoryInterface;
use Modules\User\Contracts\UserRepositoryInterface;
use Modules\User\Http\Requests\Panel\AdminRequest;
use Modules\User\Models\User;

class AdminController extends Controller
{
    private $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $this->authorize('view', User::class);
        $admins = $this->userRepo->getAdmins();
        return view('User::panel.admins.index', compact('admins'));
    }

    public function create()
    {
        $this->authorize('manage', User::class);
        $roles = resolve(RoleRepositoryInterface::class)->getAll();
        return view('User::panel.admins.create' , compact('roles'));
    }

    public function store(AdminRequest $request)
    {
        $this->authorize('manage', User::class);
        if ($request->hasFile('profile')) {
            $request->request->add(['uploadedProfile' => ImageService::uploadImage($request->file('profile'),  'user'
                ,User::getUploadDir())['default']]);
        } else {
            $request->request->add(['uploadedProfile' => null]);
        }
        $this->userRepo->store($request->all());

        newFeedback();
        return to_route('panel.admins.index');
    }

    public function edit($adminId)
    {
        $this->authorize('manage', User::class);
        $roles = resolve(RoleRepositoryInterface::class)->getAll();
        $admin = $this->userRepo->findById($adminId);
        return view('User::panel.admins.edit', compact('admin' , 'roles'));
    }

    public function update(AdminRequest $request, $adminId)
    {
        $this->authorize('manage', User::class);
        $admin = $this->userRepo->findById($adminId);
        if ($request->hasFile('profile')) {
            $request->request->add(['uploadedProfile' =>
                ImageService::uploadImage($request->file('profile'),'user', User::getUploadDir())['default']]);
        } else {
            $request->request->add(['uploadedProfile' => $admin->profile]);
        }

        $this->userRepo->update($adminId, $request->all());

        newFeedback();
        return to_route('panel.admins.index');
    }

    public function destroy($adminId)
    {
        $this->authorize('manage', User::class);
        $admin = $this->userRepo->findById($adminId);
        $this->userRepo->destroy($adminId);
        return AjaxResponse::success("کاربر  " . $admin->email . " با موفقیت حذف شد.");

    }

    public function showImage($name)
    {
        return ImageService::loadImage($name, User::getUploadDir());
    }

}
