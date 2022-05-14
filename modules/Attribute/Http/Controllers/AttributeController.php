<?php

namespace Modules\Attribute\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Attribute\Contracts\AttributeRepositoryInterface;
use Modules\Attribute\Http\Requests\AttributeRequest;
use Modules\AttributeGroup\Contracts\AttributeGroupRepositoryInterface;

class AttributeController extends Controller
{
    private $attributeRepo;
    public function __construct(AttributeRepositoryInterface $attributeRepo)
    {
        $this->attributeRepo = $attributeRepo;
    }
    public function index()
    {
        $attributes = $this->attributeRepo->getAllPaginate();
        return view('Attribute::index' ,compact('attributes'));
    }

    public function create(AttributeGroupRepositoryInterface $attributeGroupRepository)
    {
        $attributeGroups = $attributeGroupRepository->all();
        return view('Attribute::create' , compact('attributeGroups'));
    }

    public function store(AttributeRequest $request)
    {
        $this->attributeRepo->store($request->all());
        newFeedback();
        return to_route('panel.attributes.index');
    }

    public function edit($attributeId , AttributeGroupRepositoryInterface $attributeGroupRepository)
    {
        $attribute = $this->attributeRepo->findById($attributeId);
        $attributeGroups = $attributeGroupRepository->all();
        return view('Attribute::edit' , compact('attribute' , 'attributeGroups'));
    }

    public function update(AttributeRequest $request , $attributeId)
    {
        $this->attributeRepo->update($attributeId , $request->all());
        newFeedback();
        return to_route('panel.attributes.index');
    }
}
