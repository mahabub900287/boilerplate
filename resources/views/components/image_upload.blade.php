<div class="form-group mt-3">
                <div class="file-input">
                    <label class="form-label">{{ $label ?? 'Image Upload' }} <span class="error">*</span><span
                        class="subtext">(Min. Image Size ({{ $size ?? '' }}) PX)</span></label>
                    <input type="file" id="file" name="{{ $name ?? 'image' }}" value="{{ $value ?? '' }}" class="iamge-upload">
                    <label for="file" class="file image-upload-label bg-info">Upload File<i class="fa-solid fa-cloud-arrow-up"></i></label>
                    <div id='img_contain' class="mt-3">
                        <img id="image-preview" align='middle' src="{{ $src ?? get_default_image()}}"
                            alt="your image" title='' class="img-fluid"
                            style="{{ $style ?? 'width: 120px;height:120px' }}" />
                    </div>
                </div>
                @if (!empty($errorName))
                    @error($errorName)
                        <span class="text-danger fs-6">{{ $message }}</span>
                    @enderror
                @endif
            </div>
 
 