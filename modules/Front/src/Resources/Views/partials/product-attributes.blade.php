<div id="details-tab" class="tabs-container px-0 px-md-3 pb-0 pb-md-3"
     style="display:none">
    @foreach($product->category->attributeGroups as $attributeGroup)
        <!-- Detail Section -->
        <div class="row">
            <div class="col-12 my-2">
                                                            <span class="detail-title"><i
                                                                    class="fa fa-chevron-left small"></i> {{ $attributeGroup->name }} </span>
            </div>
        </div>
        @foreach($attributeGroup->attributes as $attribute)
            <div class="row mb-2">
                <div class="col-12 col-md-3 font-weight-bold">
                    <div
                        class="bg-light p-2">{{ $attribute->name }}</div>
                </div>
                <div class="col-12 col-md-9 pr-md-0">
                    <div
                        class="bg-light p-2">  {{ $attribute->getValueForProduct($product) }}</div>
                </div>
            </div>
        @endforeach
        <!-- /Detail Section -->
    @endforeach
</div>
