<div>
    <h3>@yield('title')</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('panel.home') }}">داشبورد</a></li>
            @yield('breadcrumb')
        </ol>
    </nav>
</div>
