<div class="col-lg-4">
    <div class="col-xl-12">
        <div class="card overflow-hidden">
            <div class="card-header border border-5">
                <div class="alert alert-primary" role="alert">
                    ساخت گروه مشخصات جدید
                </div>
            </div>
            <div class="card-body border border-5">
                <form method="POST" action="{{ route('panel.attributeGroups.store') }}">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-10 mb-3">
                                <div class="row">
                                    <label for="name" class="col-sm-3 col-form-label">نام</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="نام"
                                               value="{{ old('name') }}">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            <strong> {{ $message }} </strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 offset-3">
                        <button type="submit" class="btn btn-primary btn-uppercase">
                            <i class="ti-check-box m-l-5"></i> ذخیره
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
