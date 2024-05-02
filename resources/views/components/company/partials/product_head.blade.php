    <div class="ic-status-wrapper">
        <div class="ic-stage ">
            <a href="">CSV Import</a>
        </div>
        <div class="ic-stage {{ Request::routeIs('company.product.create') ? 'active' : '' }}">
            <a href="{{ route('company.product.create') }}">Manually</a>
        </div>
    </div>
