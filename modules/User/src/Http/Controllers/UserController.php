<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Core\Responses\AjaxResponse;
use Modules\Product\Services\ImageService;
use Modules\User\Contracts\CityRepositoryInterface;
use Modules\User\Contracts\UserRepositoryInterface;
use Modules\User\Http\Requests\Panel\UserAddressRequest;
use Modules\User\Http\Requests\Panel\UserRequest;
use Modules\User\Models\User;
use Modules\User\Models\UserAddress;

class UserController extends Controller
{
    private $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $this->authorize('view' , User::class);
        $users = $this->userRepo->getAll();
        return view('User::panel.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('manage' , User::class);
        return view('User::panel.create');
    }

    public function store(UserRequest $request)
    {
        $this->authorize('manage' , User::class);
        if ($request->hasFile('profile')) {
            $request->request->add(['uploadedProfile' => ImageService::uploadImage($request->file('profile') , User::getUploadDir())]);
        }else{
            $request->request->add(['uploadedProfile' => null ]);
        }
        $this->userRepo->store($request->all());

        newFeedback();
        return to_route('panel.users.index');
    }

    public function edit($userId)
    {
        $this->authorize('manage' , User::class);
        $user = $this->userRepo->findById($userId);
        return view('User::panel.edit', compact('user'));
    }

    public function update(UserRequest $request, $userId)
    {
        $this->authorize('manage' , User::class);
        $user = $this->userRepo->findById($userId);
        if ($request->hasFile('profile')) {
            $request->request->add(['uploadedProfile' => ImageService::uploadImage($request->file('profile') , User::getUploadDir())]);
        }else{
            $request->request->add(['uploadedProfile' => $user->profile ]);
        }

        $this->userRepo->update($userId, $request->all());

        newFeedback();
        return to_route('panel.users.index');
    }

    public function destroy($userId)
    {
        $this->authorize('manage' , User::class);
        $user = $this->userRepo->findById($userId);
        $this->userRepo->destroy($userId);
        return AjaxResponse::success("کاربر  ". $user->username." با موفقیت حذف شد.");

    }

    public function showImage($name)
    {
        return ImageService::loadImage($name, User::getUploadDir());
    }

    public function findCityByProvince(Request $request)
    {
        $cityRepository =  resolve(CityRepositoryInterface::class);
        if (!$request->filled('province_id')){
            return AjaxResponse::error('وارد کردن استان اجباری است.');
        }
        $cities =  $cityRepository->findByProvince($request->province_id);
        if ($cities->count() <= 0 ){
            return AjaxResponse::error('شهر های استان پیدا نشد.');
        }
        return  AjaxResponse::sendData($cities);
    }

    public function UserAddressStore(UserAddressRequest $request)
    {
        $this->userRepo->storeUserAddress(auth()->id() ,$request->all());
        alert()->success('آدرس با موفقیت ذخیره شد.');
        return back();
    }

    public function UserAddressFind($addressId)
    {
       $address =  $this->userRepo->findAddressById(auth()->id() , $addressId );
        return AjaxResponse::sendData($address);
    }

    public function UserAddressDelete($userAddressesId)
    {
        $this->userRepo->deleteUserAddress(auth()->id() , $userAddressesId);
        alert()->success('آدرس با موفقیت حذف شد.');
        return back();
    }

    public function UserAddressChangeStatus($userAddressesId)
    {
        $this->userRepo->changeUserAddressStatus(auth()->id() , $userAddressesId , UserAddress::STATUS_ACTIVE);
        alert()->success('آدرس با موفقیت به عنوان پیشفرض انتخاب شد.');
        return back();
    }
}
