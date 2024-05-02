  <div class="ic-stage-wrapper">
      <div class="ic-stage {{ Request::routeIs('company.product.index') ? 'active' : '' }}">
          <a href="{{ route('company.product.index') }}">Products</a>
      </div>
      <div class="ic-stage">
          <a href="">Deliveries</a>
      </div>
      <div class="ic-stage {{ Request::routeIs('company.packaging.index') ? 'active' : '' }}">
          <a href="{{ route('company.packaging.index') }}">Packaging Material</a>
      </div>
  </div>
