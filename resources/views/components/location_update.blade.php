<div class="loading">
    <div class="ic-loader">
        <span class="loader"></span>
     </div>
</div>

<div class="form-group mb-3 {{ $countryClass ?? '' }}">
    <label for="country-dd" class="form-label">Country</label>
    <select id="country-dd" name="country" class="form-control form-select">
        <option value="">Select Country</option>
        @foreach ($allcountries as $data)
            <option value="{{ $data->id }}" @if ($selectedcountry == $data->id) selected @endif>
                {{ $data->name }}
            </option>
        @endforeach
    </select>
</div>

<<<<<<< HEAD
=======
<div class="form-group mb-3 {{ $stateClass ?? '' }}">
    <label for="state-dd" class="form-label">State</label>
    <select id="state-dd" name="state" class="form-control form-select">
        <option value="">Select State</option>
        @foreach ($selectedstates as $data)
            <option value="{{ $data->id }}" @if ($selectedstate == $data->id) selected @endif>
                {{ $data->name }}
            </option>
        @endforeach
    </select>
</div>
>>>>>>> 13_mar_language_module

<div class="form-group {{ $cityClass ?? '' }}">
    <label for="city-dd" class="form-label">City</label>
    <select id="city-dd" name="city" class="form-control form-select">
        <option value="">Select City</option>
        @foreach ($selectedcities as $data)
            <option value="{{ $data->id }}" @if ($selectedcity == $data->id) selected @endif>
                {{ $data->name }}
            </option>
        @endforeach
    </select>
</div>