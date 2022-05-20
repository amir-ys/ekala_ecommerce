<?php

namespace Modules\Attribute\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Attribute\Contracts\AttributeRepositoryInterface;
use Modules\Attribute\Http\Requests\AttributeValue\DeleteAttributeValueRequest;
use Modules\Attribute\Http\Requests\AttributeValue\SaveAttributeValueRequest;

class AttributeValueController extends Controller
{
    private $attributeRepo;
    public function __construct(AttributeRepositoryInterface $attributeRepo)
    {
        $this->attributeRepo = $attributeRepo;
    }

    public function saveValueIndex($attributeId)
    {
        $attribute = $this->attributeRepo->findById($attributeId);
        return view('Attribute::attribute-value.save' , compact('attribute'));
    }

    public function saveValue($attributeId , SaveAttributeValueRequest $request)
    {
        $this->attributeRepo->saveValue($attributeId , $request->attributeValue);
        newFeedback();
        return to_route('panel.attributes.value.index' , $attributeId);
    }

    public function deleteValue($attributeId , DeleteAttributeValueRequest $request)
    {
        $this->attributeRepo->deleteValue($attributeId , $request->value);
        newFeedback();
        return to_route('panel.attributes.value.index' , $attributeId);
    }
}
