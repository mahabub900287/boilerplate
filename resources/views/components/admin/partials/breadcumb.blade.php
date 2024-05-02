<nav class="ic-breadcrumb-wrapper">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a
                href="{{ auth()->user()->type == 'admin' ? route('admin.dashboard') : route('company.dashboard') }}">Dashboard</a>
        </li>
        @if ($title['submenus'] != null)
            <li class="breadcrumb-item"><a href="{{ $title['url'] ?? '' }}">{{ $title['submenus'] ?? '' }}</a></li>
        @endif
        <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $title['page_title'] ?? '' }}</a></li>
    </ol>
</nav>
