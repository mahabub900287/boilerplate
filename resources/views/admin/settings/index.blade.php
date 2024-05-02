<x-admin.layouts.app :title="getbreadcumb()">
    <div class="ic-user">
        <!-- ic-profile-content-wrapper -->
        <!-- <h5 class="ic-top-title mb-3">User Info</h5> -->
        <div class="ic-profile-content-wrapper ic-tab-content">
            <div class="left-content">

                <div class="ic-profile-content">
                    <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">


                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                            aria-selected="true">
                            <i class="ri-settings-4-line"></i>
                            General Settings
                        </button>

                        <button class="nav-link" id="v-pills-email-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-email" type="button" role="tab" aria-controls="v-pills-email"
                            aria-selected="false">
                            <i class="ri-mail-send-line"></i>
                            Email Settings
                        </button>
                        <button class="nav-link" id="v-pills-media-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-media" type="button" role="tab" aria-controls="v-pills-media"
                            aria-selected="false">
                            <i class="ri-gallery-upload-line"></i>
                            Social Media Settings
                        </button>
                    </div>
                </div>
            </div>

            <div class="right-content">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab" tabindex="0">
                        <div class="ic-profile-content">
                            <h5 class="ic-top-title">General Settings</h5>
                            <form action="{{ route('admin.application.settings-update') }}" method="POST"
                                enctype="multipart/form-data" class="ic-form1">
                                @csrf
                                <div class="ic_form row row-cols-md-2 row-cols-sm-2 gx-xxl-4 gx-xl-2 gx-sm-2">

                                    <div class="mb_20">
                                        <label class="form-label">Company Title</label>
                                        <input type="text" name="general[application_title]"
                                            value="{{ $settings['general']['application_title'] ?? '' }}"
                                            class="form-control" placeholder="Enter title">
                                        <x-validation-error-message name="general[application_title]" class="mt-2" />
                                    </div>
                                    <div class="mb_20">
                                        <label class="form-label">Currency Symbol</label>
                                        <input type="text" name="general[currency_symbol]"
                                            value="{{ $settings['general']['currency_symbol'] ?? '' }}"
                                            class="form-control" placeholder="Enter Symbol">
                                        <x-validation-error-message name="general[currency_symbol]" class="mt-2" />
                                    </div>
                                    <div class="mb_20">
                                        <label class="form-label">Address</label>
                                        <input type="text" name="general[store_address]"
                                            value="{{ $settings['general']['store_address'] ?? '' }}"
                                            class="form-control" placeholder="Enter Address">
                                        <x-validation-error-message name="general[store_address]" class="mt-2" />
                                    </div>
                                    <div class="mb_20">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" name="general[store_mobile]"
                                            value="{{ $settings['general']['store_mobile'] ?? '' }}"
                                            class="form-control" placeholder="Enter Store Name">
                                        <x-validation-error-message name="general[store_mobile]" class="mt-2" />
                                    </div>
                                    <div class="mb_20">
                                        <div class="ic-profile-image">
                                            <div class="ic-image">
                                                <img class="img-fluid d-block mx-auto" id="banner_image_preview"
                                                    src="{{ $settings['general']['system_logo'] ?? asset('images/default.png') }}"
                                                    alt="System Logo">
                                            </div>
                                            <div class="ic-setting-file-upload">
                                                <label for="system_logo_input" class="form-label">Upload System
                                                    Logo</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="system_logo_input"
                                                        name="general[system_logo]">
                                                    <label class="input-group-text"
                                                        for="system_logo_input">Upload</label>
                                                </div>
                                                <x-validation-error-message name="general[system_logo]"
                                                    class="mt-2" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb_20">
                                        <div class="ic-profile-image">
                                            <div class="ic-image">
                                                <img class="img-fluid d-block mx-auto" id="system_short_logo_preview"
                                                    src="{{ $settings['general']['system_short_logo'] ?? asset('images/default.png') }}"
                                                    alt="System Short Logo">
                                            </div>
                                            <div class="ic-setting-file-upload">
                                                <label for="system_short_logo_input" class="form-label">Upload Short
                                                    Logo</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control"
                                                        id="system_short_logo_input"
                                                        name="general[system_short_logo]">
                                                    <label class="input-group-text"
                                                        for="system_short_logo_input">Upload</label>
                                                </div>
                                                <x-validation-error-message name="general[system_short_logo]"
                                                    class="mt-2" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb_20">
                                        <div class="ic-profile-image">
                                            <div class="ic-image">
                                                <img class="img-fluid d-block mx-auto" id="favicon_preview"
                                                    src="{{ $settings['general']['favicon'] ?? asset('images/default.png') }}"
                                                    alt="Favicon">
                                            </div>
                                            <div class="ic-setting-file-upload">
                                                <label for="favicon_input" class="form-label">Upload Favicon</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="favicon_input"
                                                        name="general[favicon]">
                                                    <label class="input-group-text" for="favicon_input">Upload</label>
                                                </div>
                                                <x-validation-error-message name="general[favicon]" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ic-button-wrapper d-flex justify-content-end">
                                    <div class="right-button-group ">
                                        <button class="ic-button white">Cancel</button>
                                        <button type="submit" class="ic-button grey">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade " id="v-pills-email" role="tabpanel"
                        aria-labelledby="v-pills-email-tab" tabindex="0">

                        <div class="ic-profile-content">
                            <h5 class="ic-top-title">Email Settings</h5>
                            <form action="{{ route('admin.application.settings-update') }}" method="POST">
                                @csrf
                                <div class="ic_form row row-cols-md-2 row-cols-sm-2 gx-xxl-4 gx-xl-2 gx-sm-2">
                                    <!-- Mailer -->
                                    <div class="mb_20">
                                        <label class="form-label">Mailer</label>
                                        <input type="text" class="form-control" name="mail_settings[mailer]"
                                            value="{{ $settings['mail_settings']['mailer'] ?? '' }}"
                                            placeholder="Mailer">
                                    </div>
                                    <!-- Host -->
                                    <div class="mb_20">
                                        <label class="form-label">Host</label>
                                        <input type="text" class="form-control" name="mail_settings[host]"
                                            value="{{ $settings['mail_settings']['host'] ?? '' }}"
                                            placeholder="Enter Host">
                                    </div>
                                    <!-- User name -->
                                    <div class="mb_20">
                                        <label for="" class="form-label">User Name</label>
                                        <input type="text" class="form-control" name="mail_settings[username]"
                                            value="{{ $settings['mail_settings']['username'] ?? '' }}"
                                            placeholder="Enter Username">
                                    </div>
                                    <!-- Password -->
                                    <div class="mb_20">
                                        <label for="" class="form-label">Password</label>
                                        <input type="number" class="form-control" name="mail_settings[password]"
                                            value="{{ $settings['mail_settings']['password'] ?? '' }}"
                                            placeholder="Enter Password">
                                    </div>
                                    <!-- SMTP Port -->
                                    <div class="mb_20">
                                        <label for="" class="form-label">SMTP Port</label>
                                        <input type="number" class="form-control" name="mail_settings[port]"
                                            value="{{ $settings['mail_settings']['port'] ?? '' }}"
                                            placeholder="Enter Port">
                                    </div>
                                    <!-- Mail Encryption -->
                                    <div class="mb_20">
                                        <label for="" class="form-label">Mail Encryption</label>
                                        <input type="text" class="form-control" name="mail_settings[encryption]"
                                            value="{{ $settings['mail_settings']['encryption'] ?? '' }}"
                                            placeholder="Enter Encryption">
                                    </div>
                                    <!-- From Address -->
                                    <div class="mb_20">
                                        <label class="form-label">From Address</label>
                                        <input type="text" class="form-control" name="mail_settings[from_address]"
                                            value="{{ $settings['mail_settings']['from_address'] ?? '' }}"
                                            placeholder="From Address">
                                    </div>
                                    <!-- From Name -->
                                    <div class="mb_20">
                                        <label class="form-label">From Name</label>
                                        <input type="text" class="form-control" name="mail_settings[from_name]"
                                            value="{{ $settings['mail_settings']['from_name'] ?? '' }}"
                                            placeholder="From Name">
                                    </div>
                                </div>
                                <div class="ic-button-wrapper d-flex justify-content-end">
                                    <div class="right-button-group ">
                                        <button class="ic-button white">Cancel</button>
                                        <button type="submit" class="ic-button grey">Submit</button>
                                    </div>
                                </div>


                            </form>
                        </div>

                    </div>
                    <div class="tab-pane fade " id="v-pills-media" role="tabpanel"
                        aria-labelledby="v-pills-media-tab" tabindex="0">

                        <div class="ic-profile-content">
                            <h5 class="ic-top-title">Social Media Settings</h5>
                            <form action="{{ route('admin.application.settings-update') }}" method="POST">
                                @csrf
                                <div class="ic_form row row-cols-md-2 row-cols-sm-2 gx-xxl-4 gx-xl-2 gx-sm-2">
                                    <!-- Mailer -->
                                    <div class="mb_20">
                                        <label class="form-label">Facebook</label>
                                        <input type="text" class="form-control" name="midea_settings[facebook]"
                                            value="{{ $settings['midea_settings']['facebook'] ?? '' }}"
                                            placeholder="Enter facebook url">
                                    </div>
                                    <!-- Host -->
                                    <div class="mb_20">
                                        <label class="form-label">Linkedin</label>
                                        <input type="text" class="form-control" name="midea_settings[linkedin]"
                                            value="{{ $settings['midea_settings']['linkedin'] ?? '' }}"
                                            placeholder="Enter linkedin url">
                                    </div>
                                    <!-- User name -->
                                    <div class="mb_20">
                                        <label for="" class="form-label">Instagram</label>
                                        <input type="text" class="form-control" name="midea_settings[instagram]"
                                            value="{{ $settings['midea_settings']['instagram'] ?? '' }}"
                                            placeholder="Enter instagram url">
                                    </div>
                                    <!-- Password -->
                                    <div class="mb_20">
                                        <label for="" class="form-label">Twitter</label>
                                        <input type="text" class="form-control" name="midea_settings[twitter]"
                                            value="{{ $settings['midea_settings']['twitter'] ?? '' }}"
                                            placeholder="Enter instagram url">
                                    </div>
                                </div>
                                <div class="ic-button-wrapper d-flex justify-content-end">
                                    <div class="right-button-group ">
                                        <button class="ic-button white">Cancel</button>
                                        <button type="submit" class="ic-button grey">Submit</button>
                                    </div>
                                </div>


                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="bottomScript">
        <script>
            $(document).ready(function() {
                console.log('hi');
                // Function to preview image
                function readURL(input, previewId) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $(previewId).attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }

                // Trigger image preview on file input change
                $('#system_logo_input').change(function() {
                    console.log(this);
                    readURL(this, '#banner_image_preview');
                });

                $('#system_short_logo_input').change(function() {
                    readURL(this, '#system_short_logo_preview');
                });

                $('#favicon_input').change(function() {
                    readURL(this, '#favicon_preview');
                });
            });
        </script>
    </x-slot>
</x-admin.layouts.app>
