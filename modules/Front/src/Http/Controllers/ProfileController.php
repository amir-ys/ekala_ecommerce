<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\User\Contracts\UserRepositoryInterface;

class ProfileController extends Controller
{
    public function profileCompletePage()
    {
        return view('Front::user-profile.complete-before-checkout');
    }

    public function profileCompleteSave(Request $request)
    {
        $data = $this->validateInputs();
        $userRepo = resolve(UserRepositoryInterface::class);
        $userRepo->updateFields(auth()->id() , $data);
        return redirect()->route('front.checkout.check');
    }

    private function validateInputs()
    {
       return \request()->validate([
            'first_name' => ['required'] ,
            'last_name' => ['required'] ,
            'mobile' => ['required' , 'min:10' , 'max:14'] ,
            'email' => ['required' , Rule::unique('users' , 'email' )->ignore(auth()->user())] ,
        ]);
    }


}
