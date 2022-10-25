<?php

namespace Modules\AttributeGroup\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\AttributeGroup\Contracts\AttributeGroupRepositoryInterface;
use Modules\AttributeGroup\Http\Requests\AttributeGroupRequest;
use Modules\AttributeGroup\Models\AttributeGroup;
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
        $this->authorize('view', AttributeGroup::class);
        $categories = $categoryRepo->all();
        $attributeGroups = $this->attributeGroupRepo->getAll();
        return view('AttributeGroup::index', compact('attributeGroups', 'categories'));
    }

    public function store(AttributeGroupRequest $request)
    {
        $this->authorize('manage', AttributeGroup::class);
        $this->attributeGroupRepo->store($request->all());
        newFeedback();
        return back();
    }

    public function edit($attributeGroupId, CategoryRepositoryInterface $categoryRepo)
    {
        $this->authorize('manage', AttributeGroup::class);
        $categories = $categoryRepo->all();
        $attributeGroup = $this->attributeGroupRepo->findById($attributeGroupId);
        return view('AttributeGroup::edit', compact('attributeGroup', 'categories'));
    }

    public function update(AttributeGroupRequest $request, $attributeGroupId)
    {
        $this->authorize('manage', AttributeGroup::class);
        $this->attributeGroupRepo->update($attributeGroupId, $request->all());
        newFeedback();
        return to_route('panel.attributeGroups.index');
    }

    public function destroy($attributeGroupId)
    {
        $this->authorize('manage', AttributeGroup::class);
        $attributeGroup = $this->attributeGroupRepo->findById($attributeGroupId);
        $this->attributeGroupRepo->destroy($attributeGroupId);
        return AjaxResponse::success(
            'گروه مشخصات' . $attributeGroup->name . ' با موفقیت حذف شد.'
        );

    }
}
