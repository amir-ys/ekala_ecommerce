<div class="col-lg-4">
        <div class="card overflow-hidden">
            <div class="card-header border border-5">
                <div class="alert alert-primary" role="alert">
                   @lang('Brand::translation.create')
                </div>
            </div>
            <div class="card-body border border-5">
                <form method="POST" action="{{ route('panel.brands.store') }}">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-10 mb-3">
                                <div class="row">
                                    <label for="name" class="col-sm-3 col-form-label">نام</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="نام"
                                               value="{{ old('name') }}">
                                        <x-validation-error field="name" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10 mb-3">
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">وضعیت</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="is_active" aria-hidden="true">
                                            <option value>یک وضعیت را انتخاب کنید</option>
                                            @foreach(\Modules\Brand\Enums\BrandStatus::cases() as  $status)
                                                <option
                                                    value="{{ $status->value }}">  @lang($status->name) </option>
                                            @endforeach
                                        </select>
                                    <x-validation-error field="is_active" />
                                    </div>
                                </div>
                            </div>

                        <div class="col-md-10 offset-md-3">
                            <button type="submit" class="btn btn-primary btn-uppercase">
                                <i class="ti-check-box m-l-5"></i> ذخیره
                            </button>
                        </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
</div>
