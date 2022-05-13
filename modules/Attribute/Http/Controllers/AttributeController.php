<?php

namespace Modules\Attribute\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Attribute\Contracts\AttributeRepositoryInterface;

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
}
