<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Product\Services\ImageService;
use Modules\User\Contracts\UserRepositoryInterface;
use Modules\User\Http\Requests\Panel\UpdateUserRequest;
use Modules\User\Models\User;

class UserController extends Controller
{
    private $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $users = $this->userRepo->getAll();
        return view('User::panel.index', compact('users'));
    }

    public function edit($userId)
    {
        $user = $this->userRepo->findById($userId);
        return view('User::panel.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $userId)
    {
        if ($request->hasFile('profile')) {
            $request->request->add(['uploadedProfile' => ImageService::uploadImage($request->file('profile') , User::getUploadDir())]);
        }else{
            $request->request->add(['uploadedProfile' => null ]);

        }

        $this->userRepo->update($userId, $request->all());

        newFeedback();
        return to_route('panel.users.index');
    }

    public function showImage($name)
    {
        return ImageService::loadImage($name, User::getUploadDir());
    }

}
