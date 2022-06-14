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
                    <span>گروه ویژگی ها</span> <span class="badge bg-danger-gradient"></span></a>
            </li>

            <li><a data-attr="layout-builder-toggle" class="{{ request()->url(route('panel.attributes.index')) == route('panel.attributes.index') ? 'c-active' : '' }}" href="{{ route('panel.attributes.index') }}">
                    <i class="icon ti-layout"></i>
                    <span>ویژگی ها</span> <span class="badge bg-danger-gradient"></span></a>
            </li>

            <li><a data-attr="layout-builder-toggle" class="{{ request()->url(route('panel.categories.index')) == route('panel.categories.index') ? 'c-active' : '' }}" href="{{ route('panel.categories.index') }}">
                    <i class="icon ti-layout"></i>
                    <span>دسته بندی ها</span> <span class="badge bg-danger-gradient"></span></a>
            </li>

            <li><a data-attr="layout-builder-toggle" class="{{ request()->url(route('panel.products.index')) == route('panel.products.index') ? 'c-active' : '' }}" href="{{ route('panel.products.index') }}">
                    <i class="icon ti-layout"></i>
                    <span> محصولات </span> <span class="badge bg-danger-gradient"></span></a>
            </li>

            <li><a data-attr="layout-builder-toggle" class="{{ request()->url(route('panel.slides.index')) == route('panel.slides.index') ? 'c-active' : '' }}" href="{{ route('panel.slides.index') }}">
                    <i class="icon ti-layout"></i>
                    <span> اسلایدر </span> <span class="badge bg-danger-gradient"></span></a>
            </li>

            <li><a data-attr="layout-builder-toggle" class="{{ request()->url(route('panel.comments.index')) == route('panel.comments.index') ? 'c-active' : '' }}" href="{{ route('panel.comments.index') }}">
                    <i class="icon ti-layout"></i>
                    <span> کامنت ها </span> <span class="badge bg-danger-gradient"></span></a>
            </li>


        </ul>
    </div>
</div>

