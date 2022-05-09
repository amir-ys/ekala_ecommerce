x<div class="side-menu">
    <div class="side-menu-body">
        <ul>
            <li class="side-menu-divider">فهرست</li>


            <li><a data-attr="layout-builder-toggle" class="{{ request()->url(route('panel.home')) == route('panel.home') ? 'c-active' : '' }}" href="/home">
                    <i class="icon ti-layout"></i>
                    <span>داشبرد</span> <span class="badge bg-danger-gradient"></span></a>
            </li>
            <li><a data-attr="layout-builder-toggle" class="{{ request()->url(route('panel.brands.index')) == route('panel.brands.index') ? 'c-active' : '' }}" href="{{ route('panel.brands.index') }}">
                    <i class="icon ti-layout"></i>
                    <span>برند ها</span> <span class="badge bg-danger-gradient"></span></a>
            </li>

            <li><a data-attr="layout-builder-toggle" class="{{ request()->url(route('panel.attributeGroups.index')) == route('panel.attributeGroups.index') ? 'c-active' : '' }}" href="{{ route('panel.attributeGroups.index') }}">
                    <i class="icon ti-layout"></i>
                    <span>گروه مشخصات</span> <span class="badge bg-danger-gradient"></span></a>
            </li>
        </ul>
    </div>
</div>

