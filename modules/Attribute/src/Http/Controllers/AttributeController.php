<?php

namespace Modules\Attribute\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Attribute\Contracts\AttributeRepositoryInterface;
use Modules\Attribute\Http\Requests\AttributeRequest;
use Modules\Attribute\Models\Attribute;
use Modules\Attribute\Policies\AttributePolicy;
use Modules\AttributeGroup\Contracts\AttributeGroupRepositoryInterface;
use Modules\Core\Responses\AjaxResponse;

class AttributeController extends Controller
{
    private $attributeRepo;

    public function __construct(AttributeRepositoryInterface $attributeRepo)
    {
        $this->attributeRepo = $attributeRepo;
    }

    public function index()
    {
        $this->authorize('view', Attribute::class);
        $attributes = $this->attributeRepo->getAll();
        return view('Attribute::index', compact('attributes'));
    }

    public function create(AttributeGroupRepositoryInterface $attributeGroupRepository)
    {
        $this->authorize('manage', AttributePolicy::class);
        $attributeGroups = $attributeGroupRepository->all();
        return view('Attribute::create', compact('attributeGroups'));
    }

    public function store(AttributeRequest $request)
    {
        $this->authorize('manage', AttributePolicy::class);
        $this->attributeRepo->store($request->all());
        newFeedback();
        return to_route('panel.attributes.index');
    }

    public function edit($attributeId, AttributeGroupRepositoryInterface $attributeGroupRepository)
    {
        $this->authorize('manage', AttributePolicy::class);
        $attribute = $this->attributeRepo->findById($attributeId);
        $attributeGroups = $attributeGroupRepository->all();
        return view('Attribute::edit', compact('attribute', 'attributeGroups'));
    }

    public function update(AttributeRequest $request, $attributeId)
    {
        $this->authorize('manage', AttributePolicy::class);
        $this->attributeRepo->update($attributeId, $request->all());
        newFeedback();
        return to_route('panel.attributes.index');
    }

    public function destroy($attributeId)
    {
        $this->authorize('manage', AttributePolicy::class);
        $attribute = $this->attributeRepo->findById($attributeId);
        $this->attributeRepo->destroy($attributeId);
        return AjaxResponse::success("ویژگی  " . $attribute->name . " با موفقیت حذف شد.");
    }
}
