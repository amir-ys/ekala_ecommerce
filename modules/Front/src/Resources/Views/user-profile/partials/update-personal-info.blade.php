<div class="modal fade bd-example-modal-lg" id="edit_personal_info_modal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ویرایش پروفایل</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('front.profile.edit'  , auth()->id()) }}" method="post" id="edit_profile">
                    @csrf
                    @method('patch')
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name" class="col-form-label"> نام </label>
                                <input name="first_name" id="first_name" value="{{ old('first_name' , auth()->user()->first_name) }}" type="text"  class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last_name" class="col-form-label"> نام خانوادگی </label>
                                <input name="last_name" id="last_name" value="{{ old('last_name' , auth()->user()->last_name) }}" type="text"  class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="national_code" class="col-form-label"> کد ملی </label>
                                <input name="national_code" id="national_code"
                                       value="{{ old('national_code' , auth()->user()->national_code) }}" type="number"  class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mobile" class="col-form-label">  شماره تلفن همراه  </label>
                                <input name="mobile" id="mobile" value="{{ old('mobile' , auth()->user()->mobile) }}"
                                       type="number"  class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email" class="col-form-label"> ایمیل </label>
                                <input name="email" id="email" value="{{ old('email' , auth()->user()->email) }}" type="email"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cart_number" class="col-form-label">  شماره کارت </label>
                                <input name="cart_number" id="cart_number" value="{{ old('cart_number' , auth()->user()->cart_number) }}"
                                       type="number"  class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password" class="col-form-label"> کلمه عبور </label>
                                <input name="password" id="password" type="text"  class="form-control">
                            </div>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                <button type="submit"  form="edit_profile" class="btn btn-primary">ذخیره تغییرات</button>
            </div>
        </div>
    </div>
</div>
