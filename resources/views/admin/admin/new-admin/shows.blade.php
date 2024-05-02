<x-admin.layouts.app :title="getbreadcumb()">
    <div class="ic-user">
        <!-- back btn -->
        <a role="button" class="ic-back mb_25" href="{{ route('admin.users.index') }}">
            <i class="ri-arrow-left-line"></i>
            <span>Back</span>
        </a>
        <!-- ic-profile-content-wrapper -->
        <h5 class="ic-top-title mb-3">User Info</h5>
        <div class="ic-profile-content-wrapper">
            <div class="left-content">
                <div class="ic-profile-content h-100">
                    <div class="ic-profile-image h-100 align-items-center">
                        <div class="view-user-profile ">
                            <div class="ic-image d-block mx-auto mb_24">
                                <img class="img-fluid "
                                    src="{{ $item->avatar == null ? get_default_image('user') : asset('storage/user') . '/' . $item->avatar }}"
                                    alt="">
                            </div>
                            <div class="user-info">
                                <h2 class="ic-user-name mt-1">{{ $item->first_name }} {{ $item->last_name }}</h2>
                                <p class="ic-user-mail">{{ $item->email }}</p>
                            </div>
                            {{-- <div class="ic-verified mt-1">
                                        <div class="icon">
                                            <img class="img-fluid" src="./assets/images/logo/verified.png" alt="">
                                        </div>
                                        <p class="txt">Verified User</p>
                                    </div> --}}
                        </div>

                    </div>
                </div>
            </div>
            <div class="right-content">
                <div class="ic-profile-content">
                    <div class="ic_form row row-cols-md-3 row-cols-sm-2 gx-xxl-4 gx-xl-2 gx-sm-2">
                        <!-- First name -->
                        <div class="mb_20">
                            <label for="" class="form-label">First Name</label>
                            <input type="text" class="form-control" value="{{ $item->first_name }}" readonly>
                        </div>
                        <!-- LAst name -->
                        <div class="mb_20">
                            <label for="" class="form-label">Last Name</label>
                            <input type="text" class="form-control" value="{{ $item->last_name }}" readonly>
                        </div>
                        <!-- Role -->
                        <div class="mb_20">
                            <label for="" class="form-label">Type</label>
                            <input type="text" class="form-control" value="{{ $item->type }}" readonly>
                        </div>
                        <!-- Email -->
                        <div class="mb_20">
                            <label for="" class="form-label">Email</label>
                            <input type="text" class="form-control" value="{{ $item->email }}" readonly>
                        </div>
                        <!-- Phone Number -->
                        <div class="mb_20">
                            <label for="" class="form-label">Phone</label>
                            <input type="text" class="form-control" value="{{ $item->phone }}" readonly>
                        </div>
                        <div class="mb_20">
                            <label for="" class="form-label">Company Name</label>
                            <input type="text" class="form-control" value="{{ $item->company_name }}" readonly>

                        </div>
                        <div class="mb_20">
                            <label for="" class="form-label">Country</label>
                            <input type="text" class="form-control" value="{{ $item->country }}" readonly>
                        </div>
                        <!-- status -->
                        <div class="mb_20">
                            <label for="exampleInputPassword1" class="form-label">Status</label>
                            <div class="form-check form-switch  ic-check">
                                <input class="form-check-input" name="status" type="checkbox" readonly
                                    {{ $item->status == 'active' ? 'checked' : '' }} id="flexSwitchCheckChecked">
                                <label class="form-check-label"
                                    for="flexSwitchCheckChecked">{{ $item->status == 'active' ? 'Active' : 'Inactive' }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="row ic_form mb_25">
                        <!-- Bio -->
                        <div class="">
                            <label class="form-label">Bio</label>
                            <textarea class="form-control ic-textarea" name="bio" readonly value="{{ $item->bio ?? old('bio') }}"
                                rows="3" placeholder="Write about your self">{!! $item->bio !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </x-admin.app>
