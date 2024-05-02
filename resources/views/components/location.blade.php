<div class="loading">
    <div class="ic-loader">
        <span class="loader"></span>
    </div>
</div>
<div class="col-lg-6 form-group mb-3 {{ $countryClass ?? '' }}">
    <label for="" class="form-label">@lang('country_name')</label>
    {{-- <select id="country-dd" name="country" class="form-control form-select" data-live-search="true">
        <option value="">Select Country</option>
        @foreach ($allcountries as $data)
            <option value="{{ $data->id }}">
                {{ $data->name }}
            </option>
        @endforeach
    </select> --}}
    <x-form-select class="form-control form-select" id="country-dd" name="country" :options="$allcountries" :default='59' />
</div>
{{-- <div class="form-group mb-3 {{ $stateClass ?? '' }}">
    <label for="" class="form-label">State</label>
    <select id="state-dd" name="state" class="form-control form-select">
    </select>
</div> --}}
<div class="col-lg-6 form-group mb_20 {{ $cityClass ?? '' }}">
    <label for="" class="form-label">@lang('city_name')</label>
    <select id="city-dd" name="city" class="form-control form-select">
    </select>
</div>
