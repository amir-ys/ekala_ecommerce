<?php

namespace Modules\Attribute\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Attribute\Contracts\AttributeRepositoryInterface;
use Modules\Attribute\Http\Requests\AttributeRequest;
use Modules\AttributeGroup\Contracts\AttributeGroupRepositoryInterface;
use Modules\Core\Responses\AjaxResponse;

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

    public function saveValue($attributeId ,Request $request)
    {


    }
}
