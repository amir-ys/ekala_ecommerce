<?php

namespace Modules\AttributeGroup\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\AttributeGroup\Contracts\AttributeGroupRepositoryInterface;
use Modules\AttributeGroup\Http\Requests\AttributeGroupRequest;

class AttributeGroupController extends Controller
{
    private AttributeGroupRepositoryInterface $attributeGroupRepo;

    public function __construct(AttributeGroupRepositoryInterface $attributeGroupRepo)
    {
        $this->attributeGroupRepo = $attributeGroupRepo;
    }
    public function index()
    {
        $attributeGroups = $this->attributeGroupRepo->getAllPaginate();
        return view('AttributeGroup::index' , compact('attributeGroups'));
    }

    public function store(AttributeGroupRequest $request)
    {
        $this->attributeGroupRepo->store($request->all());
        newFeedback();
        return back();
    }

}
