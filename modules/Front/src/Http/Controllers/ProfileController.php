<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\Front\Http\Requests\UpdateProfileRequest;
use Modules\Core\Services\ImageService;
use Modules\User\Contracts\UserRepositoryInterface;
use Modules\User\Models\User;

class ProfileController extends Controller
{
    public function edit(UpdateProfileRequest $request, $userId)
    {
        $userRepo = resolve(UserRepositoryInterface::class);
        $userRepo->updateFields($userId, $request->all());
        alert()->success('عملیات موفق', 'پروفایل با موفقیت بروزرسانی شد.');
        return back();
    }

    public function displayImage($id)
    {
        $user = resolve(UserRepositoryInterface::class)->findById($id);
        return ImageService::loadImage($user->profile , User::getUploadDir());
    }

    public function profileCompletePage()
    {
        return view('Front::user-profile.complete-before-checkout');
    }

    public function profileCompleteSave(Request $request)
    {
        $data = $this->validateInputs();
        $userRepo = resolve(UserRepositoryInterface::class);
        $userRepo->updateFields(auth()->id(), $data);
        return redirect()->route('front.checkout.addressPage');
    }

    private function validateInputs()
    {
        return \request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'mobile' => ['required', 'min:10', 'max:14'],
        ]);
    }
}
