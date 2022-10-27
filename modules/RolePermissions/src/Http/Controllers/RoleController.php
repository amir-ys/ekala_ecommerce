<?php
namespace Modules\RolePermissions\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Core\Responses\AjaxResponse;
use Modules\RolePermissions\Contracts\PermissionRepositoryInterface;
use Modules\RolePermissions\Contracts\RoleRepositoryInterface;
use Modules\RolePermissions\Http\Requests\RoleRequest;
use Modules\RolePermissions\Models\Role;

class RoleController extends Controller
{
    protected  $roleRepo;
    public function __construct(RoleRepositoryInterface $roleRepo)
    {
        $this->roleRepo = $roleRepo;
    }

    public function index()
    {
        $this->authorize('view' , Role::class);
        $roles = $this->roleRepo->getAll();
        return view('RolePermissions::roles.index' , compact('roles'));
    }

    public function create(PermissionRepositoryInterface $permissionRepo)
    {
        $this->authorize('manage' , Role::class);
        $permissions = $permissionRepo->getAll();
        return view('RolePermissions::roles.create' , compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        $this->authorize('manage' , Role::class);
        $this->roleRepo->store($request->all());
        newFeedback();
        return redirect()->route('panel.roles.index');
    }

    public function edit($id)
    {
        $this->authorize('manage' , Role::class);
        $role = $this->roleRepo->findById($id);
        $permissions = resolve(PermissionRepositoryInterface::class)->getAll();
        return view('RolePermissions::roles.edit' , compact( 'role' , 'permissions'));
    }

    public function update(RoleRequest $request , $id)
    {
        $this->authorize('manage' , Role::class);
        $this->roleRepo->update($id , $request->validated());
        newFeedback();
        return redirect()->route('panel.roles.index');
    }

    public function destroy($id)
    {
        $this->authorize('manage' , Role::class);
       $role =  $this->roleRepo->findById($id);
       $this->roleRepo->destroy($id);
       return AjaxResponse::success("نقش کاربری ". $role->name ." با موفقیت حذق شد.");
    }

}
