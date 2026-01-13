{{--<div class="navigation">--}}
{{--    <div class="navigation-icon-menu">--}}
{{--        <ul>--}}
{{--            --}}{{-- @hasanyrole('mohammad') --}}
{{--            <li data-toggle="tooltip" title="کاربران">--}}
{{--                <a href="#users" title=" کاربران">--}}
{{--                    <i class="icon ti-user"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            --}}{{-- @endhasanyrole--}}
{{--            @hasanyrole('مدير فروش') --}}
{{--            <li data-toggle="tooltip" title="محصولات">--}}
{{--                <a href="#products" title=" محصولات">--}}
{{--                    <i class="icon ti-folder"></i>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li data-toggle="tooltip" title="برداخت">--}}
{{--                <a href="#payment" title=" برداخت">--}}
{{--                    <i class="icon ti-folder"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            --}}{{-- @endhasanyrole --}}
{{--        </ul>--}}
{{--        <ul>--}}
{{--            <li data-toggle="tooltip" title="ویرایش پروفایل">--}}
{{--                <a href="#" class="go-to-page">--}}
{{--                    <i class="icon ti-settings"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li data-toggle="tooltip" title="خروج">--}}
{{--                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                    @csrf--}}
{{--                </form>--}}

{{--                <a href="#" class="go-to-page"--}}
{{--                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">--}}
{{--                    <i class="icon ti-power-off"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--    <div class="navigation-menu-body">--}}
{{--        <ul id="users">--}}
{{--            <li>--}}
{{--                <a href="#">کاربران</a>--}}
{{--                <ul>--}}
{{--                    <li><a href="{{ route('users.create') }}">ایجاد کاربر</a></li>--}}
{{--                    <li><a href="{{ route('users.index') }}">لیست کاربران</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="#">نقش ها</a>--}}
{{--                <ul>--}}
{{--                    <li><a href="{{ route('roles.create') }}">ایجاد نقش </a></li>--}}
{{--                    <li><a href="{{ route('roles.index') }}">لیست نقش ها</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="#">لاك ها</a>--}}
{{--                <ul>--}}
{{--                    <li><a href="{{ route('logs') }}">ليست لاك ها </a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--        <ul id="products">--}}
{{--            <li>--}}
{{--                <a href="#">دستة بندي </a>--}}
{{--                <ul>--}}
{{--                    <li><a href="{{ route('category.create') }}">ایجاد دستة بندي </a></li>--}}
{{--                    <li><a href="{{ route('category.index') }}">لیست دستة بندي </a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="#">اسلايدر</a>--}}
{{--                <ul>--}}
{{--                    <li><a href="{{ route('sliders.create') }}">ایجاد اسلايدر</a></li>--}}
{{--                    <li><a href="{{ route('sliders.index') }}">لیست اسلايدر </a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="#"> برند ها</a>--}}
{{--                <ul>--}}
{{--                    <li><a href="{{ route('brands.create') }}">ایجاد برند</a></li>--}}
{{--                    <li><a href="{{ route('brands.index') }}">لیست برند ها</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="#">نقش ها</a>--}}
{{--                <ul>--}}
{{--                    <li><a href="{{ route('roles.create') }}">ایجاد نقش </a></li>--}}
{{--                    <li><a href="{{ route('roles.index') }}">لیست نقش ها</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="#"> رنك ها</a>--}}
{{--                <ul>--}}
{{--                    <li><a href="{{ route('colors.create') }}">ایجاد رنك</a></li>--}}
{{--                    <li><a href="{{ route('colors.index') }}">لیست رنك ها</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="#"> محصولات </a>--}}
{{--                <ul>--}}
{{--                    <li><a href="{{ route('products.create') }}">ایجاد محصول</a></li>--}}
{{--                    <li><a href="{{ route('products.index') }}">لیست محصولات </a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="#"> كروه ويزكي ها </a>--}}
{{--                <ul>--}}
{{--                    <li><a href="{{ route('property_groups.create') }}">ایجاد كروه ويزكي ها</a></li>--}}
{{--                    <li><a href="{{ route('property_groups.index') }}">لیست كروه ويزكي ها </a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="#"> ويزكي ها </a>--}}
{{--                <ul>--}}
{{--                    <li><a href="{{ route('properties.create') }}">ایجاد ويزكي ها</a></li>--}}
{{--                    <li><a href="{{ route('properties.index') }}">لیست ويزكي ها </a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="#">لاك ها</a>--}}
{{--                <ul>--}}
{{--                    <li><a href="{{ route('logs') }}">ليست لاك ها </a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--        <ul id="payment">--}}
{{--            <li>--}}
{{--                <a href="#">فروش</a>--}}
{{--                <ul>--}}
{{--                    <li><a href="{{ route('orders.panel') }}">ليست فروش</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--        </ul>--}}

{{--    </div>--}}
{{--</div>--}}
{{--<!-- end::navigation -->--}}






<div class="navigation">

    <!-- begin::icon menu -->
    <div class="navigation-icon-menu">
        <ul>
            <li data-toggle="tooltip" title="کاربران">
                <a href="#users">
                    <i class="icon ti-user"></i>
                </a>
            </li>

            <li data-toggle="tooltip" title="محصولات">
                <a href="#products">
                    <i class="icon ti-folder"></i>
                </a>
            </li>

            <li data-toggle="tooltip" title="پرداخت">
                <a href="#payment">
                    <i class="icon ti-credit-card"></i>
                </a>
            </li>
        </ul>

        <ul>
            <li data-toggle="tooltip" title="ویرایش پروفایل">
                <a href="{{ route('profile.edit') ?? '#' }}" class="go-to-page">
                    <i class="icon ti-settings"></i>
                </a>
            </li>

            <li data-toggle="tooltip" title="خروج">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

                <a href="#" class="go-to-page"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="icon ti-power-off"></i>
                </a>
            </li>
        </ul>
    </div>
    <!-- end::icon menu -->

    <!-- begin::menu body -->
    <div class="navigation-menu-body">

        <ul id="users">
            <li>
                <a href="#">کاربران</a>
                <ul>
                    <li><a href="{{ route('users.create') }}">ایجاد کاربر</a></li>
                    <li><a href="{{ route('users.index') }}">لیست کاربران</a></li>
                </ul>
            </li>

            <li>
                <a href="#">نقش‌ها</a>
                <ul>
                    <li><a href="{{ route('roles.create') }}">ایجاد نقش</a></li>
                    <li><a href="{{ route('roles.index') }}">لیست نقش‌ها</a></li>
                </ul>
            </li>

            <li>
                <a href="#">لاگ‌ها</a>
                <ul>
                    <li><a href="{{ route('logs') }}">لیست لاگ‌ها</a></li>
                </ul>
            </li>
        </ul>

        <ul id="products">
            <li>
                <a href="#">دسته‌بندی</a>
                <ul>
                    <li><a href="{{ route('category.create') }}">ایجاد دسته‌بندی</a></li>
                    <li><a href="{{ route('category.index') }}">لیست دسته‌بندی</a></li>
                </ul>
            </li>

            <li>
                <a href="#">اسلایدر</a>
                <ul>
                    <li><a href="{{ route('sliders.create') }}">ایجاد اسلایدر</a></li>
                    <li><a href="{{ route('sliders.index') }}">لیست اسلایدر</a></li>
                </ul>
            </li>

            <li>
                <a href="#">برندها</a>
                <ul>
                    <li><a href="{{ route('brands.create') }}">ایجاد برند</a></li>
                    <li><a href="{{ route('brands.index') }}">لیست برندها</a></li>
                </ul>
            </li>

            <li>
                <a href="#">رنگ‌ها</a>
                <ul>
                    <li><a href="{{ route('colors.create') }}">ایجاد رنگ</a></li>
                    <li><a href="{{ route('colors.index') }}">لیست رنگ‌ها</a></li>
                </ul>
            </li>

            <li>
                <a href="#">محصولات</a>
                <ul>
                    <li><a href="{{ route('products.create') }}">ایجاد محصول</a></li>
                    <li><a href="{{ route('products.index') }}">لیست محصولات</a></li>
                </ul>
            </li>

            <li>
                <a href="#">گروه ویژگی‌ها</a>
                <ul>
                    <li><a href="{{ route('property_groups.create') }}">ایجاد گروه</a></li>
                    <li><a href="{{ route('property_groups.index') }}">لیست گروه‌ها</a></li>
                </ul>
            </li>

            <li>
                <a href="#">ویژگی‌ها</a>
                <ul>
                    <li><a href="{{ route('properties.create') }}">ایجاد ویژگی</a></li>
                    <li><a href="{{ route('properties.index') }}">لیست ویژگی‌ها</a></li>
                </ul>
            </li>
        </ul>

        <ul id="payment">
            <li>
                <a href="#">فروش</a>
                <ul>
                    <li><a href="{{ route('orders.panel') }}">لیست فروش</a></li>
                </ul>
            </li>
        </ul>

    </div>
    <!-- end::menu body -->

</div>
<!-- end::navigation -->
