<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('laporan_harian_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/weldings*") ? "c-show" : "" }} {{ request()->is("admin/attendances*") ? "c-show" : "" }} {{ request()->is("admin/overtimes*") ? "c-show" : "" }} {{ request()->is("admin/deliveries*") ? "c-show" : "" }} {{ request()->is("admin/crews*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-book-open c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.laporanHarian.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('welding_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.weldings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/weldings") || request()->is("admin/weldings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bolt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.welding.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('attendance_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.attendances.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/attendances") || request()->is("admin/attendances/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-calendar-check c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.attendance.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('overtime_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.overtimes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/overtimes") || request()->is("admin/overtimes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-clock c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.overtime.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('delivery_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.deliveries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/deliveries") || request()->is("admin/deliveries/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-truck c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.delivery.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('crew_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.crews.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/crews") || request()->is("admin/crews/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users-cog c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.crew.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('produk_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/product-categories*") ? "c-show" : "" }} {{ request()->is("admin/products*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-database c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.produk.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('product_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-categories") || request()->is("admin/product-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-atlas c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.products.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/products") || request()->is("admin/products/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-box c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.product.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('penggajian_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/kasbons*") ? "c-show" : "" }} {{ request()->is("admin/salaries*") ? "c-show" : "" }} {{ request()->is("admin/salary-constants*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-hand-holding-usd c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.penggajian.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('kasbon_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.kasbons.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/kasbons") || request()->is("admin/kasbons/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-credit-card c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.kasbon.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('salary_access')
                            <li class="c-sidebar-nav-item">
                                <a href="#" id="toWeeklySalaryForm" class="c-sidebar-nav-link {{ request()->is("admin/salaries/weekly/form") ? "c-active" : "" }}">
                                    <i class="fa-fw fas fa-book c-sidebar-nav-icon"></i>
                                    Input Mingguan
                                </a>
                            </li>
                            <li class="c-sidebar-nav-item">
                                <a href="#" id="toMonthlySalaryForm" class="c-sidebar-nav-link {{ request()->is("admin/salaries/monthly/form") ? "c-active" : "" }}">
                                    <i class="fa-fw fas fa-book c-sidebar-nav-icon"></i>
                                    Input Bulanan
                                </a>
                            </li>
                    @endcan
                    @can('salary_constant_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.salary-constants.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/salary-constants") || request()->is("admin/salary-constants/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-pen-nib c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.salaryConstant.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('pemasukan_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/fakturs*") ? "c-show" : "" }} {{ request()->is("admin/pembayarans*") ? "c-show" : "" }} {{ request()->is("admin/carts*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-dollar-sign c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.pemasukan.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('faktur_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.fakturs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/fakturs") || request()->is("admin/fakturs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-invoice c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faktur.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('pembayaran_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.pembayarans.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/pembayarans") || request()->is("admin/pembayarans/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-money-bill-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.pembayaran.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('cart_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.carts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/carts") || request()->is("admin/carts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cart-arrow-down c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.cart.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('pelanggan_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.pelanggans.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/pelanggans") || request()->is("admin/pelanggans/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-user-tag c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.pelanggan.title') }}
                </a>
            </li>
        @endcan
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('setting_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.settings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/settings") || request()->is("admin/settings/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.setting.title') }}
                </a>
            </li>
        @endcan
        @can('content_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/content-categories*") ? "c-show" : "" }} {{ request()->is("admin/content-tags*") ? "c-show" : "" }} {{ request()->is("admin/content-pages*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.contentManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('content_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-categories") || request()->is("admin/content-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('content_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-tags") || request()->is("admin/content-tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('content_page_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-pages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-pages") || request()->is("admin/content-pages/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentPage.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('faq_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/faq-categories*") ? "c-show" : "" }} {{ request()->is("admin/faq-questions*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.faqManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('faq_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('faq_question_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-questions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqQuestion.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>