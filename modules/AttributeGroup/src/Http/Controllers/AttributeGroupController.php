<?php

namespace Modules\AttributeGroup\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\AttributeGroup\Contracts\AttributeGroupRepositoryInterface;
use Modules\AttributeGroup\Http\Requests\AttributeGroupRequest;
use Modules\Category\Contracts\CategoryRepositoryInterface;
use Modules\Core\Responses\AjaxResponse;

class AttributeGroupController extends Controller
{
    private AttributeGroupRepositoryInterface $attributeGroupRepo;

    public function __construct(AttributeGroupRepositoryInterface $attributeGroupRepo)
    {
        $this->attributeGroupRepo = $attributeGroupRepo;
    }
    public function index(CategoryRepositoryInterface $categoryRepo)
    {
        $categories = $categoryRepo->all();
        $attributeGroups = $this->attributeGroupRepo->getAll();
        return view('AttributeGroup::index' , compact('attributeGroups' , 'categories'));
    }

    public function store(AttributeGroupRequest $request)
    {
        $this->attributeGroupRepo->store($request->all());
        newFeedback();
        return back();
    }

    public function edit($attributeGroupId , CategoryRepositoryInterface $categoryRepo)
    {
        $categories = $categoryRepo->all();
        $attributeGroup = $this->attributeGroupRepo->findById($attributeGroupId);
        return view('AttributeGroup::edit' , compact('attributeGroup' , 'categories'));
    }

    public function update(AttributeGroupRequest $request ,$attributeGroupId)
    {
        $this->attributeGroupRepo->update($attributeGroupId , $request->all());
        newFeedback();
        return to_route('panel.attributeGroups.index');
    }

    public function destroy($attributeGroupId)
    {
       $attributeGroup =  $this->attributeGroupRepo->findById($attributeGroupId);
        $this->attributeGroupRepo->destroy($attributeGroupId);
        return AjaxResponse::success(
            'گروه مشخصات'. $attributeGroup->name .' با موفقیت حذف شد.'
        );

    }
}
