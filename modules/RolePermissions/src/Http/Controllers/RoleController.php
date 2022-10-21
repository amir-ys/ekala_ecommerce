<?php
namespace Modules\RolePermissions\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Core\Responses\AjaxResponse;
use Modules\RolePermissions\Contracts\PermissionRepositoryInterface;
use Modules\RolePermissions\Contracts\RoleRepositoryInterface;
use Modules\RolePermissions\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    protected  $roleRepo;
    public function __construct(RoleRepositoryInterface $roleRepo)
    {
        $this->roleRepo = $roleRepo;
    }

    public function index()
    {
        $roles = $this->roleRepo->getAll();
        return view('RolePermissions::roles.index' , compact('roles'));
    }

    public function create(PermissionRepositoryInterface $permissionRepo)
    {
        $permissions = $permissionRepo->getAll();
        return view('RolePermissions::roles.create' , compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        $this->roleRepo->store($request->all());
        newFeedback();
        return redirect()->route('panel.roles.index');
    }

    public function edit($id)
    {
        $role = $this->roleRepo->findById($id);
        $permissions = resolve(PermissionRepositoryInterface::class)->getAll();
        return view('RolePermissions::roles.edit' , compact( 'role' , 'permissions'));
    }

    public function update(RoleRequest $request , $id)
    {
        $this->roleRepo->update($id , $request->validated());
        newFeedback();
        return redirect()->route('panel.roles.index');
    }

    public function destroy($id)
    {
       $role =  $this->roleRepo->findById($id);
       $this->roleRepo->destroy($id);
       return AjaxResponse::success("نقش کاربری ". $role->name ." با موفقیت حذق شد.");
    }

}
