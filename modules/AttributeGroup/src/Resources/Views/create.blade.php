<div class="col-lg-4">
    <div class="card overflow-hidden">
        <div class="card-header border border-5">
            <div class="alert alert-primary" role="alert">
                @lang('AttributeGroup::translation.create')
            </div>
        </div>
        <div class="card-body border border-5">
            <form method="POST" action="{{ route('panel.attributeGroups.store') }}">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-10 mb-2">
                            <div class="row">
                                <label for="name" class="col-sm-3 col-form-label">نام</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="نام"
                                           value="{{ old('name') }}">
                                    <x-validation-error field="name"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-10 mb-3">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">دسته بندی</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <select name="category_ids[]" class="select2-multiple form-control" multiple dir="rtl" id="select-category-id">
                                    @foreach($categories as  $category)
                                        <option
                                            value="{{ $category->id  }}"
                                        @if(is_array( old('category_ids')) && in_array($category->id ,  old('category_ids') )) selected  @endif
                                        >  {{ $category->name }} </option>

                                    @endforeach
                                </select>
                            </div>
                            <x-validation-error field="category_ids"/>
                        </div>
                    </div>
                </div>

                <div class="col-md-10 offset-md-3">
                    <button type="submit" class="btn btn-primary btn-uppercase">
                        <i class="ti-check-box m-l-5"></i> ذخیره
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
