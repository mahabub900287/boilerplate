<x-admin.layouts.app :title="getbreadcumb()">
    <div class="ic-user">

        <!-- back btn -->
        <a role="button" class="ic-back mb_25" href="{{ route('admin.users.index') }}">
            <i class="ri-arrow-left-line"></i>
            <span>Back</span>
        </a>
        <!-- ic-profile-content-wrapper -->
        <x-form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
            <div class="ic-profile-content-wrapper">
                <div class="left-content">
                    <h5 class="ic-top-title">Profile Image</h5>
                    <div class="ic-profile-content">
                        <div class="ic-profile-image">
                            <div class="ic-image">
                                <img class="img-fluid d-block mx-auto" id="Image_change"
                                    src="{{ asset('images/user_default.png') }}" alt="">
                            </div>

                            <div class="ic-file-wrapper">
                                <input type="file" name="avatar" value="{{ auth()->user()->avatar }}"
                                    onchange="document.getElementById('Image_change').src = window.URL.createObjectURL(this.files[0])">

                                <div class="ic-content text-center">
                                    <div class="ic-upload-icon">
                                        <img src="{{ asset('assets/admin/images/logo/image-upload.png') }}"
                                            alt="">
                                    </div>
                                    <p class="ic-main-content">
                                        <span class="upload">Click to upload</span>
                                        <span>or drag and drop</span>
                                    </p>
                                    <p class="ic-sub-content">
                                        SVG, PNG, JPG or GIF (max. 800x400px)
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right-content">
                    <h5 class="ic-top-title">Create New User</h5>
                    <div class="ic-profile-content">

                        <div class="ic_form row row-cols-md-2 row-cols-sm-2 gx-xxl-4 gx-xl-2 gx-sm-2">
                            <!-- First name -->
                            <div class="mb_20">
                                <x-form_input label="First Name" placeholder="Enter your first name" name="first_name"
                                    errorName='first_name' value="{{ old('first_name') }}" required>
                                </x-form_input>
                            </div>
                            <!-- LAst name -->
                            <div class="mb_20">
                                <x-form_input label="Last Name" placeholder="Enter your last name" name="last_name"
                                    errorName='last_name' value="{{ old('last_name') }}">
                                </x-form_input>
                            </div>
                            <!-- Role -->
                            <div class="mb_20">
                                <label for="" class="form-label">Type</label>
                                <input type="text" class="form-control" value="company" readonly>
                            </div>
                            <!-- Email -->
                            <div class="mb_20">
                                <x-form_input label="Email" placeholder="Enter your email" name="email"
                                    errorName='email' value="{{ old('email') }}" required>
                                </x-form_input>
                            </div>
                            <!-- Phone Number -->
                            <div class="mb_20">
                                <x-form_input label="Phone" placeholder="Enter your phone" name="phone"
                                    errorName='phone' value="{{ old('phone') }}">
                                </x-form_input>
                            </div>
                            <div class="mb_20">
                                <x-form_input label="Company Name" placeholder="Enter your company name"
                                    name="company_name" errorName='company_name' value="{{ old('company_name') }}">
                                </x-form_input>
                            </div>
                            <div class="mb_20">
                                <x-form_input label="Country" placeholder="Enter your country" name="country"
                                    errorName='country' value="{{ old('country') }}">
                                </x-form_input>
                            </div>
                            <!-- status -->
                            <div class="mb_20">
                                <label for="exampleInputPassword1" class="form-label">Status</label>
                                <div class="form-check form-switch  ic-check">
                                    <input class="form-check-input" name="status" type="checkbox"
                                        id="flexSwitchCheckChecked">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Inactive</label>
                                </div>
                            </div>
                            <div class="mb_20">
                                <x-form_input label="Password" placeholder="Enter your password" name="password"
                                    errorName="password" type="password"></x-form_input>
                            </div>
                            <div class="mb_20">
                                <x-form_input label="Confirm Password" placeholder="Enter your confirm password"
                                    name="password_confirmation" type="password"></x-form_input>
                            </div>
                        </div>

                        <div class="row ic_form mb_25">
                            <!-- Bio -->
                            <div class="">
                                <label class="form-label">Bio</label>
                                <textarea class="form-control ic-textarea" name="bio" value="" rows="3"
                                    placeholder="Write about your self"></textarea>
                            </div>
                        </div>

                        <div class="ic-button-wrapper d-flex justify-content-end">
                            <div class="right-button-group ">
                                <a href="{{ route('admin.users.index') }}" class="ic-button white">Cancel</a>
                                <button type="submit" class="ic-button primary">Create</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </x-form>
    </div>
    </x-admin.app>
