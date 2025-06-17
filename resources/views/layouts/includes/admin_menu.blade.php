<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
        data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->

        <ul class="menu-nav">



            @if (auth('admin')->user()->can('view_dashboard'))
                <li class="menu-item" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{ route('admin.home') }}" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                    <path
                                        d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                        fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">{{ __('label.main') }}</span>
                        <i class="menu-arrow"></i>
                    </a>

                </li>
            @endif




            @if (auth('admin')->user()->can('view_roles') || auth('admin')->user()->can('view_admin'))

                <li class="{{ request()->segment(3) == 'admins' || request()->segment(3) == 'roles' ? 'menu-item menu-item-submenu menu-item-open' : 'menu-item menu-item-submenu' }}"
                    aria-haspopup="true" data-menu-toggle="hover">

                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(10.000000, 11.000000) rotate(-315.000000) translate(-10.000000, -11.000000)" />
                                    <path
                                        d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z"
                                        fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">{{ __('label.system_manger') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">{{ __('label.admin_manger') }}</span>
                                </span>
                            </li>



                            @if (auth('admin')->user()->can('view_admin'))
                                <li
                                    class="{{ request()->segment(3) == 'admins' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                    <a href="{{ route('admin.admins.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        {{ __('label.admin_manger') }}
                                    </a>
                                </li>

                                @if (auth('admin')->user()->can('view_roles'))
                                    <li
                                        class="{{ request()->segment(3) == 'roles' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                        <a href="{{ route('admin.roles.index') }}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            {{ __('label.roles') }}


                                        </a>
                                    </li>
                                @endif

                            @endif

                        </ul>
                    </div>
                </li>
            @endif


            @if (auth('admin')->user()->can('view_branch'))
                <li class="{{ request()->segment(3) == 'branches' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                    aria-haspopup="true">
                    <a href="{{ route('admin.branchs.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16" />
                                    <path
                                        d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z"
                                        fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">{{ __('label.branches') }} </span>
                    </a>
                </li>
            @endif

            @if (auth('admin')->user()->can('view_users') ||
                    auth('admin')->user()->can('view_users_inside_hub_menu') ||
                    auth('admin')->user()->can('view_users_outside_hub_menu') ||
                    auth('admin')->user()->can('view_users_not_active_menu') ||
                    auth('admin')->user()->can('view_users_delete_hub_menu') ||
                    auth('admin')->user()->can('verification_users') ||
                    auth('admin')->user()->can('view_users_survey_menu') ||
                    auth('admin')->user()->can('under_examination_users'))

                <li class="{{ request()->segment(3) == 'users' ? 'menu-item menu-item-submenu menu-item-open' : 'menu-item menu-item-submenu' }}"
                    aria-haspopup="true" data-menu-toggle="hover">

                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(10.000000, 11.000000) rotate(-315.000000) translate(-10.000000, -11.000000)" />
                                    <path
                                        d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z"
                                        fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">{{ __('label.users') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">{{ __('label.users') }}</span>
                                </span>
                            </li>

                            @if (auth('admin')->user()->can('view_users'))
                                <li
                                    class="{{ request()->segment(3) == 'users' && !request()->has('status') ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                    <a href="{{ route('admin.users.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">


                                            {{ __('label.users') }}

                                            <span style="color: yellow ;margin-right:3%">

                                                ({{ \App\Models\User::query()->when(auth('admin')->user()->branch_id ?? false, function ($q) {
                                                        $q->where('branch_id', auth('admin')->user()->branch_id);
                                                    })->count() }})
                                            </span>
                                        </span>
                                    </a>
                                </li>
                            @endif
                            @if (auth('admin')->user()->can('view_users_inside_hub_menu'))
                                <li
                                    class="{{ request()->segment(3) == 'users' && request('status') == 'inside-hub' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                    <a href="{{ route('admin.users.index', ['status' => 'inside-hub']) }}"
                                        class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{ __('label.users_inside_hub_menu') }}
                                            <span style="color: yellow ;margin-right:3%">
                                                ({{ \App\Models\User::query()->when(auth('admin')->user()->branch_id ?? false, function ($q) {
                                                        $q->where('branch_id', auth('admin')->user()->branch_id);
                                                    })->where('status', 1)->count() }})
                                            </span>

                                        </span>
                                    </a>
                                </li>
                            @endif
                            @if (auth('admin')->user()->can('view_users_outside_hub_menu'))
                                <li
                                    class="{{ request()->segment(3) == 'users' && request('status') == 'non-hub' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                    <a href="{{ route('admin.users.index', ['status' => 'non-hub']) }}"
                                        class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>

                                        <span class="menu-text"> {{ __('label.users_no_hub_menu') }}
                                            <span style="color: yellow ;margin-right:3%">
                                                ({{ \App\Models\User::query()->when(auth('admin')->user()->branch_id ?? false, function ($q) {
                                                        $q->where('branch_id', auth('admin')->user()->branch_id);
                                                    })->where('status', 3)->count() }})

                                            </span>

                                        </span>
                                    </a>
                                </li>
                            @endif

                            @if (auth('admin')->user()->can('view_users_not_active_menu'))
                                <li
                                    class="{{ request()->segment(3) == 'users' && request('status') == 'non-active' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                    <a href="{{ route('admin.users.index', ['status' => 'non-active']) }}"
                                        class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{ __('label.users_not_avtive') }}
                                            <span style="color: yellow ;margin-right:3%">

                                                ({{ \App\Models\User::when(auth('admin')->user()->branch_id, function ($q) {
                                                    // $q->whereHas('branch', function ($q) {
                                                    $q->where('branch_id', auth('admin')->user()->branch_id);
                                                    // });
                                                })->where('status', 0)->count() }})
                                            </span>
                                        </span>
                                    </a>
                                </li>
                            @endif


                            @if (auth('admin')->user()->can('under_examination_users'))
                                <li class="{{ request()->segment(5) == 'veririfcation' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.users.veririfcation') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{ __('label.under_examination_users') }}
                                            <span style="color: yellow ;margin-right:3%">

                                                ({{ \App\Models\User::query()->where('is_verification', 3)->count() }})
                                            </span>
                                        </span>
                                    </a>
                                </li>
                            @endif

                            @if (auth('admin')->user()->can('verification_users'))
                                <li
                                    class="{{ request()->segment(3) == 'users' && request('status') == 'under-verification' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                    <a href="{{ route('admin.users.index', ['status' => 'under-verification']) }}"
                                        class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{ __('label.users_under_verification') }}
                                            <span style="color: yellow ;margin-right:3%">

                                                ({{ \App\Models\User::when(auth('admin')->user()->branch_id, function ($q) {
                                                    // $q->whereHas('branch', function ($q) {
                                                    $q->where('branch_id', auth('admin')->user()->branch_id);
                                                    // });
                                                })->where('is_verification', 2)->count() }})
                                            </span>
                                        </span>
                                    </a>
                                </li>
                            @endif


                            @if (auth('admin')->user()->can('view_users_delete_hub_menu'))
                                <li
                                    class="{{ request()->segment(3) == 'users' && request('status') == 'delete-hub' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                    <a href="{{ route('admin.users.index', ['status' => 'delete-hub']) }}"
                                        class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>

                                        <span class="menu-text"> {{ __('label.delete_users_list') }}
                                            <span style="color: yellow ;margin-right:3%">
                                                ({{ \App\Models\User::query()->onlyTrashed()->count() }})

                                            </span>

                                        </span>
                                    </a>
                                </li>
                            @endif

                            @if (auth('admin')->user()->can('view_users_survey_menu'))
                                <li
                                    class="{{ request()->segment(5) == 'surveys' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                    <a href="{{ route('admin.users.surveys') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>

                                        <span class="menu-text"> قائمة استبيانات المستخدمين


                                        </span>
                                    </a>
                                </li>
                            @endif

                            {{-- <li
                                class="{{ request()->segment(3) == 'users' && request('user_types') == 'اشتراك انترنت' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                <a href="{{ route('admin.users.index', ['user_types' => 'اشتراك انترنت']) }}"
                                    class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>

                                    <span class="menu-text"> {{ __('label.Users_with_internet_subscription') }}
                                        <span style="color: yellow ;margin-right:3%">
                                            ({{ \App\Models\User::query()->when(auth('admin')->user()->branch_id && !auth('admin')->user()->is_supper ?? false, function ($q) {
                                                    $q->where('branch_id', auth('admin')->user()->branch_id);
                                                })->where('status', 3)->count() }})

                                        </span>

                                    </span>
                                </a>
                            </li> --}}
                            {{-- <li
                                class="{{ request()->segment(3) == 'users' && request('user_types') == 'الطلاب' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                <a href="{{ route('admin.users.index', ['user_types' => 'الطلاب']) }}"
                                    class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>

                                    <span class="menu-text"> {{ __('label.students') }}
                                        <span style="color: yellow ;margin-right:3%">
                                            ({{ \App\Models\User::query()->when(auth('admin')->user()->branch_id && !auth('admin')->user()->is_supper ?? false, function ($q) {
                                                    $q->where('branch_id', auth('admin')->user()->branch_id);
                                                })->where('status', 3)->count() }})

                                        </span>

                                    </span>
                                </a>
                            </li> --}}

                            @if (auth('admin')->user()->can('view_users_outside_hub_menu'))
                                <li
                                    class="{{ request()->segment(3) == 'users' && request('user_types') == 'مولد' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                    <a href="{{ route('admin.users.index', ['user_types' => 'مولد']) }}"
                                        class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>

                                        <span class="menu-text"> {{ __('label.generator_users') }}
                                            <span style="color: yellow ;margin-right:3%">
                                                ({{ \App\Models\User::query()->when(auth('admin')->user()->branch_id ?? false, function ($q) {
                                                        $q->where('branch_id', auth('admin')->user()->branch_id);
                                                    })->where('user_type_cd_id', 21)->count() }})

                                            </span>

                                        </span>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </li>
            @endif



            @if (auth('admin')->user()->can('view_subscription_type') ||
                    auth('admin')->user()->can('view_internet_subscription') ||
                    auth('admin')->user()->can('view_pendding_internet_subscription') ||
                    auth('admin')->user()->can('view_ready_internet_subscription') ||
                    auth('admin')->user()->can('view_available_internet_subscription') ||
                    auth('admin')->user()->can('view_expired_internet_subscription'))
                <li class="{{ request()->segment(3) == 'internet-subscriptions' || request()->segment(3) == 'subscription-types' ? 'menu-item menu-item-submenu menu-item-open' : 'menu-item menu-item-submenu' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <!-- SVG Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M3,3 L21,3 L21,21 L3,21 Z" fill="#000000" opacity="0.3" />
                                    <path d="M5,5 L5,19 L19,19 L19,5 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!-- End SVG Icon -->
                        </span>
                        <span class="menu-text">{{ __('label.internet_subscriptions') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">{{ __('label.internet_subscriptions') }}</span>
                                </span>
                            </li>





                            <li class="{{ request()->segment(3) == 'subscription-types' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.subscriptionTypes.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">{{ __('label.subscription_types') }}</span>
                                </a>
                            </li>

                            @if (auth('admin')->user()->can('view_internet_subscription'))
                                <li class="{{ request()->segment(3) == 'internet-subscriptions' && !request()->segment(4) ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.internetSubscriptions.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">{{ __('label.internet_subscription_list') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (auth('admin')->user()->can('view_pendding_internet_subscription'))
                                <li class="{{ request()->segment(4) == 'pending' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.internetSubscriptions.pendding') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">{{ __('label.pending_internet_subscription') }}</span>
                                    </a>
                                </li>
                            @endif

                            {{-- @if (auth('admin')->user()->can('view_ready_internet_subscription')) --}}
                            <li class="{{ request()->segment(4) == 'ready' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.internetSubscriptions.ready') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">{{ __('label.active_internet_subscription') }}</span>
                                </a>
                            </li>
                            {{-- @endif --}}

                            @if (auth('admin')->user()->can('view_available_internet_subscription'))
                                <li class="{{ request()->segment(4) == 'available' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.internetSubscriptions.available') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span
                                            class="menu-text">{{ __('label.available_internet_subscription') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (auth('admin')->user()->can('view_expired_internet_subscription'))
                                <li class="{{ request()->segment(4) == 'expired' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.internetSubscriptions.expired') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">{{ __('label.expired_internet_subscription') }}</span>
                                    </a>
                                </li>
                            @endif





                        </ul>
                    </div>
                </li>
            @endif

            @if (auth('admin')->user()->can('view_generator_subscriptions') ||
                    auth('admin')->user()->can('view_generator') ||
                    auth('admin')->user()->can('view_generator_receipt') ||
                    auth('admin')->user()->can('view_generator_expense') ||
                    auth('admin')->user()->can('view_generator_readings'))
                <li class="{{ request()->segment(3) == 'generator-subscriptions' || request()->segment(3) == 'generators' || request()->segment(3) == 'receipt-generators' || request()->segment(3) == 'reading-generators' ? 'menu-item menu-item-submenu menu-item-open' : 'menu-item menu-item-submenu' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <!-- SVG Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                viewBox="0 0 24 24" version="1.1">
                                <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="3" y="3" width="18" height="18" rx="2" />
                                    <path d="M9 3v18M15 3v18" />
                                </g>
                            </svg>
                            <!-- End SVG Icon -->
                        </span>
                        <span class="menu-text">{{ __('label.generator_subscription_mangment') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class <li class="menu-item menu-item-parent" aria-haspopup="true">
                                {{-- <span class="menu-link">
                            <span class="menu-text">{{ __('label.generator_subscription_mangment') }}</span>
                        </span> --}}
                            </li>



                            @can('view_generator')
                                <li class="{{ request()->segment(3) == 'generators' && !request('status') ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.generators.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">{{ __('label.generators') }}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('restore_generator_list')
                                <li class="{{ request()->segment(3) == 'generators' && request('status') ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.generators.index', ['status' => 'delete-generator']) }}"
                                        class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">{{ __('label.restore_generators_list') }}</span>
                                    </a>
                                </li>
                            @endcan


                            @can('view_generator_subscriptions')
                                <li class="{{ request()->segment(3) == 'generator-subscriptions' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.generatorSubscriptions.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">{{ __('label.generator_subscription_list') }}</span>
                                    </a>
                                </li>
                            @endcan
                            <li class="{{ request()->segment(3) == 'generator-subscriptions' && request('status') ? 'menu-item menu-item-active' : 'menu-item' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.generatorSubscriptions.index', ['status' => 'delete-generator-subscriptions']) }}"
                                    class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span
                                        class="menu-text">{{ __('label.delete_generator_subscriptions_list') }}</span>
                                </a>
                            </li>
                            @can('view_generator_expense')
                                <li class="{{ request()->segment(3) == 'expense-generators' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.generatorExpenses.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">{{ __('label.expense_generator_list') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('view_generator_readings')
                                <li class="{{ request()->segment(3) == 'reading-generators' && !request('status') ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.readingGenerators.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">{{ __('label.reading_generator_list') }}</span>
                                    </a>
                                </li>
                            @endcan



                            <li class="{{ request()->segment(3) == 'reading-generators' && request('status') ? 'menu-item menu-item-active' : 'menu-item' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.readingGenerators.index', ['status' => 'delete-reading-generators']) }}"
                                    class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">{{ __('label.delete_reading_generator_list') }}</span>
                                </a>
                            </li>
                            @can('view_generator_receipt')
                                <li class="{{ request()->segment(3) == 'receipt-generators' && !request('status') ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.generatorReceipts.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">{{ __('label.generator_receipts') }}</span>
                                    </a>
                                </li>
                            @endcan
                            <li class="{{ request()->segment(3) == 'receipt-generators' && request('status') ? 'menu-item menu-item-active' : 'menu-item' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.generatorReceipts.index', ['status' => 'delete-receipt-generators']) }}"
                                    class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">{{ __('label.delete_generator_receipts_list') }}</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
            @endif





            @if (auth('admin')->user()->can('view_workspaces') ||
                    auth('admin')->user()->can('view_subscription_type') ||
                    auth('admin')->user()->can('view_room') ||
                    auth('admin')->user()->can('view_desk'))
                <li class="{{ request()->segment(4) == 'work-spaces' || request()->segment(4) == 'desk-mangments' || request()->segment(4) == 'room-mangments' ? 'menu-item menu-item-submenu menu-item-open' : 'menu-item menu-item-submenu' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <!-- SVG Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M3,3 L21,3 L21,21 L3,21 Z" fill="#000000" opacity="0.3" />
                                    <path d="M5,5 L5,19 L19,19 L19,5 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!-- End SVG Icon -->
                        </span>
                        <span class="menu-text">{{ __('label.workspace_mangments') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">{{ __('label.workspace_mangments') }}</span>
                                </span>
                            </li>


                            @can('view_service')
                                <li class="{{ request()->segment(4) == 'services' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.workSpaceManagments.services.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">{{ __('label.services') }}</span>
                                    </a>
                                </li>
                            @endcan


                            @can('view_desk_mangment')
                                <li class="{{ request()->segment(4) == 'work-spaces' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.workSpaceManagments.workSpaces.index') }}"
                                        class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">{{ __('label.work_space') }}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('view_work_space')
                                <li class="{{ request()->segment(4) == 'desk-mangments' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.workSpaceManagments.deskManagments.index') }}"
                                        class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">{{ __('label.desk_mangments') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('view_room_mangment')
                                <li class="{{ request()->segment(4) == 'room-mangments' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.workSpaceManagments.rooms.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">{{ __('label.room_mangments') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif

            @if (auth('admin')->user()->can('view_restaurant') ||
                    auth('admin')->user()->can('view_category') ||
                    auth('admin')->user()->can('view_product') ||
                    auth('admin')->user()->can('view_order'))



                <li class="{{ request()->segment(3) == 'restaurants' || request()->segment(3) == 'orders' || request()->segment(3) == 'categories' || request()->segment(3) == 'products' ? 'menu-item menu-item-submenu menu-item-open' : 'menu-item menu-item-submenu' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <!-- SVG Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M3,3 L21,3 L21,21 L3,21 Z" fill="#000000" opacity="0.3" />
                                    <path d="M5,5 L5,19 L19,19 L19,5 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!-- End SVG Icon -->
                        </span>
                        <span class="menu-text">{{ __('label.restaurants') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">{{ __('label.restaurant_list') }}</span>
                                </span>
                            </li>


                            @if (auth('admin')->user()->can('view_restaurant'))
                                <li class="{{ request()->segment(3) == 'restaurants' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.restaurants.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">{{ __('label.restaurant_list') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (auth('admin')->user()->can('view_category'))
                                <li class="{{ request()->segment(3) == 'categories' && !request()->segment(4) ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.categories.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">{{ __('label.category_list') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (auth('admin')->user()->can('view_product'))
                                <li class="{{ request()->segment(3) == 'products' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.products.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">{{ __('label.product_list') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (auth('admin')->user()->can('view_order'))
                                <li class="{{ request()->segment(3) == 'orders' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.orders.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">{{ __('label.order_list') }}</span>
                                    </a>
                                </li>
                            @endif






                        </ul>
                    </div>
                </li>

            @endif
            @if (auth('admin')->user()->can('view_wallet_movements')|| auth('admin')->user()->can('view_wallets'))
                <li class="{{ request()->segment(3) == 'wallets' ? 'menu-item menu-item-submenu menu-item-open' : 'menu-item menu-item-submenu' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <!-- SVG Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M3,3 L21,3 L21,21 L3,21 Z" fill="#000000" opacity="0.3" />
                                    <path d="M5,5 L5,19 L19,19 L19,5 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!-- End SVG Icon -->
                        </span>
                        <span class="menu-text">{{ __('label.wallet_list') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">{{ __('label.wallet_list') }}</span>
                                </span>
                            </li>





                            @if(auth('admin')->user()->can('view_wallet'))
                            <li class="{{ request()->routeIs('admin.wallets.index') ? 'menu-item menu-item-active' : 'menu-item' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.wallets.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">{{ __('label.wallet_list') }}</span>
                                </a>
                            </li>

                            @endif

                            <li class="{{ request()->routeIs('admin.wallets.walletRecipt') ? 'menu-item menu-item-active' : 'menu-item' }}"
                                aria-haspopup="true">
                                <a href="{{ route('admin.wallets.walletRecipt') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">{{ __('label.recipt_wallet_list') }}</span>
                                </a>
                            </li>







                        </ul>
                    </div>
                </li>
            @endif




            @if (auth('admin')->user()->can('view_user_branch'))
                <li class="{{ request()->segment(3) == 'join-bracnhes' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                    aria-haspopup="true">

                    <a href="{{ route('admin.joinBranches.index') }}" class="menu-link">
                        <span
                            class="svg-icon menu-icon "><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Chat4.svg--><svg
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M5.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L5.5,11 C4.67157288,11 4,10.3284271 4,9.5 L4,5.5 C4,4.67157288 4.67157288,4 5.5,4 Z M11,6 C10.4477153,6 10,6.44771525 10,7 C10,7.55228475 10.4477153,8 11,8 L13,8 C13.5522847,8 14,7.55228475 14,7 C14,6.44771525 13.5522847,6 13,6 L11,6 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M5.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M11,15 C10.4477153,15 10,15.4477153 10,16 C10,16.5522847 10.4477153,17 11,17 L13,17 C13.5522847,17 14,16.5522847 14,16 C14,15.4477153 13.5522847,15 13,15 L11,15 Z"
                                        fill="#000000" />
                                </g>


                            </svg><!--end::Svg Icon--></span>
                        <span class="menu-text">{{ __('label.join_bracnhes') }}</span>
                    </a>


                </li>
            @endif



            @if (auth('admin')->user()->can('view_agreement'))
                <li class="{{ request()->segment(3) == 'agreements' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                    aria-haspopup="true">
                    <a href="{{ route('admin.agreements.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M6 20v-2c0-1.1.9-2 2-2h8c1.1 0 2 .9 2 2v2" />
                                    <path d="M9 12l2 2l4-4" />
                                </g>


                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">بيانات الاتفاقية </span>
                    </a>
                </li>
            @endif
            @if (auth('admin')->user()->can('view_company'))
                <li class="{{ request()->segment(3) == 'companies' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                    aria-haspopup="true">
                    <a href="{{ route('admin.companies.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M6 20v-2c0-1.1.9-2 2-2h8c1.1 0 2 .9 2 2v2" />
                                    <path d="M9 12l2 2l4-4" />
                                </g>


                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">{{ __('label.companies') }} </span>
                    </a>
                </li>
            @endif

            @if (auth('admin')->user()->can('view_income_movements'))
                <li class="{{ request()->segment(3) == 'income_movements' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                    aria-haspopup="true">
                    <a href="{{ route('admin.incomeMovements.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <path opacity="0.5"
                                    d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                                    fill="currentColor" />
                                <path
                                    d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                                    fill="currentColor" />
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">{{ __('label.income_movements') }} </span>
                    </a>
                </li>
            @endif

            @if (auth('admin')->user()->can('view_job_constrancts'))
                <li class="{{ request()->segment(3) == 'job_constrancts' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                    aria-haspopup="true">
                    <a href="{{ route('admin.jobConstrancts.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z"
                                    fill="currentColor"></path>
                                <path
                                    d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z"
                                    fill="currentColor"></path>
                                <path opacity="0.3"
                                    d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z"
                                    fill="currentColor"></path>
                                <path opacity="0.3"
                                    d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z"
                                    fill="currentColor"></path>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">{{ __('label.job_contracts') }} </span>
                    </a>
                </li>
            @endif


            @if (auth('admin')->user()->can('view_projects'))
                <li class="{{ request()->segment(3) == 'projects' ? 'menu-item menu-item-submenu menu-item-open' : 'menu-item menu-item-submenu' }}"
                    aria-haspopup="true" data-menu-toggle="hover">

                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(10.000000, 11.000000) rotate(-315.000000) translate(-10.000000, -11.000000)" />
                                    <path
                                        d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z"
                                        fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">{{ __('label.projects') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">{{ __('label.projects') }}</span>
                                </span>
                            </li>

                            <li
                                class="{{ request()->segment(4) == 'pennding' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                <a href="{{ route('admin.projects.index', 'pennding') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">


                                        {{ __('label.projects_are_in_the_waiting_phase') }}

                                        <span style="color: yellow ;margin-right:3%">

                                            ({{ \App\Models\CompanyProject::where('status', 1)->count() }})
                                        </span>
                                    </span>
                                </a>
                            </li>

                            <li
                                class="{{ request()->segment(4) == 'processing' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                <a href="{{ route('admin.projects.index', 'processing') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{ __('label.projects_implementation_stage') }}
                                        <span style="color: yellow ;margin-right:3%">

                                            ({{ \App\Models\CompanyProject::where('status', 2)->count() }})
                                        </span>

                                    </span>
                                </a>
                            </li>

                            <li
                                class="{{ request()->segment(4) == 'completed' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                <a href="{{ route('admin.projects.index', 'completed') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>

                                    <span class="menu-text"> {{ __('label.completed_projects') }}
                                        <span style="color: yellow ;margin-right:3%">
                                            ({{ \App\Models\CompanyProject::where('status', 3)->count() }})
                                        </span>

                                    </span>
                                </a>
                            </li>
                            <li
                                class="{{ request()->segment(4) == 'reject' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                <a href="{{ route('admin.projects.index', 'reject') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{ __('label.projects_incomplete') }}
                                        <span style="color: yellow ;margin-right:3%">

                                            ({{ \App\Models\CompanyProject::where('status', 4)->count() }})
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li
                                class="{{ request()->segment(4) == 'ratting' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                <a href="{{ route('admin.projects.index', 'ratting') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{ __('label.projects_evaluated') }}
                                        <span style="color: yellow ;margin-right:3%">

                                            ({{ \App\Models\CompanyProject::where('status', 3)->wherehas('compnayRatting')->count() }})
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li
                                class="{{ request()->segment(4) == 'not-ratting' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                <a href="{{ route('admin.projects.index', 'not-ratting') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{ __('label.projects_not_evaluated') }}
                                        <span style="color: yellow ;margin-right:3%">

                                            ({{ \App\Models\CompanyProject::where('status', 3)->doesntHave('compnayRatting')->count() }})
                                        </span>

                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            @if (auth('admin')->user()->can('view_jobs'))
                <li class="{{ request()->segment(3) == 'jobs' ? 'menu-item menu-item-submenu menu-item-open' : 'menu-item menu-item-submenu' }}"
                    aria-haspopup="true" data-menu-toggle="hover">

                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M5.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L5.5,11 C4.67157288,11 4,10.3284271 4,9.5 L4,5.5 C4,4.67157288 4.67157288,4 5.5,4 Z M11,6 C10.4477153,6 10,6.44771525 10,7 C10,7.55228475 10.4477153,8 11,8 L13,8 C13.5522847,8 14,7.55228475 14,7 C14,6.44771525 13.5522847,6 13,6 L11,6 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M5.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M11,15 C10.4477153,15 10,15.4477153 10,16 C10,16.5522847 10.4477153,17 11,17 L13,17 C13.5522847,17 14,16.5522847 14,16 C14,15.4477153 13.5522847,15 13,15 L11,15 Z"
                                        fill="#000000" />
                                </g>

                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">{{ __('label.jobs') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">{{ __('label.jobs') }}</span>
                                </span>
                            </li>

                            <li
                                class="{{ request()->segment(4) == 'pennding' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                <a href="{{ route('admin.jobs.index', 'pennding') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">


                                        {{ __('label.jobs_are_in_the_waiting_phase') }}

                                        <span style="color: yellow ;margin-right:3%">

                                            ({{ \App\Models\Job::where('status', 1)->count() }})
                                        </span>
                                    </span>
                                </a>
                            </li>

                            <li
                                class="{{ request()->segment(4) == 'processing' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                <a href="{{ route('admin.jobs.index', 'processing') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{ __('label.jobs_implementation_stage') }}
                                        <span style="color: yellow ;margin-right:3%">

                                            ({{ \App\Models\Job::where('status', 2)->count() }})
                                        </span>

                                    </span>
                                </a>
                            </li>

                            <li
                                class="{{ request()->segment(4) == 'completed' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                <a href="{{ route('admin.jobs.index', 'completed') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>

                                    <span class="menu-text"> {{ __('label.completed_jobs') }}
                                        <span style="color: yellow ;margin-right:3%">
                                            ({{ \App\Models\Job::where('status', 3)->count() }})
                                        </span>

                                    </span>
                                </a>
                            </li>
                            <li
                                class="{{ request()->segment(4) == 'reject' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                <a href="{{ route('admin.jobs.index', 'reject') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{ __('label.jobs_incomplete') }}
                                        <span style="color: yellow ;margin-right:3%">

                                            ({{ \App\Models\Job::where('status', 4)->count() }})
                                        </span>
                                    </span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
            @endif


            @if (auth('admin')->user()->can('view_chats'))
                <li class="{{ request()->segment(2) == 'chats' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                    aria-haspopup="true">


                    <a href="{{ route('admin.chats.view') }}" class="menu-link">
                        <span
                            class="svg-icon menu-icon "><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Chat4.svg--><svg
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L5,18 C3.34314575,18 2,16.6568542 2,15 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 Z M6.16794971,10.5547002 C7.67758127,12.8191475 9.64566871,14 12,14 C14.3543313,14 16.3224187,12.8191475 17.8320503,10.5547002 C18.1384028,10.0951715 18.0142289,9.47430216 17.5547002,9.16794971 C17.0951715,8.86159725 16.4743022,8.98577112 16.1679497,9.4452998 C15.0109146,11.1808525 13.6456687,12 12,12 C10.3543313,12 8.9890854,11.1808525 7.83205029,9.4452998 C7.52569784,8.98577112 6.90482849,8.86159725 6.4452998,9.16794971 C5.98577112,9.47430216 5.86159725,10.0951715 6.16794971,10.5547002 Z"
                                        fill="#000000" />
                                </g>
                            </svg><!--end::Svg Icon--></span>
                        <span class="menu-text">{{ __('label.chat_menu') }}</span>
                    </a>


                </li>
            @endif
            @if (auth('admin')->user()->can('view_attendances'))
                <li class="{{ request()->segment(3) == 'attendances' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                    aria-haspopup="true">
                    <a href="{{ route('admin.attendances.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16" />
                                    <path
                                        d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z"
                                        fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">{{ __('label.attendance_departure') }} </span>
                    </a>
                </li>
            @endif





            @if (auth('admin')->user()->can('view_logs'))
                <li class="{{ request()->segment(3) == 'logs' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                    aria-haspopup="true">
                    <a href="{{ route('admin.logs.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16" />
                                    <path
                                        d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z"
                                        fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">{{ __('label.attendance_logs') }} </span>
                    </a>
                </li>
            @endif

            @if (auth('admin')->user()->is_supper)
                <li class="{{ request()->segment(3) == 'notifications' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                    aria-haspopup="true">
                    <a href="{{ route('admin.notifications.create') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0 1 18 14.5V11a6.5 6.5 0 1 0-13 0v3.5c0 .372-.123.738-.345 1.055L3 17h5">
                                </path>
                                <path d="M10 21h4a2 2 0 1 1-4 0z"></path>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">{{ __('label.notifications') }} </span>
                    </a>
                </li>
            @endif

            @if (auth('admin')->user()->can('view_invoice'))
                <li class="{{ request()->segment(3) == 'invoices' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                    aria-haspopup="true">
                    <a href="{{ route('admin.invoices.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z"
                                    fill="currentColor"></path>
                                <path
                                    d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z"
                                    fill="currentColor"></path>
                                <path opacity="0.3"
                                    d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z"
                                    fill="currentColor"></path>
                                <path opacity="0.3"
                                    d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z"
                                    fill="currentColor"></path>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">{{ __('label.invoices') }} </span>
                    </a>
                </li>
            @endif
            @if (auth('admin')->user()->can('view_report'))
                <li class="{{ request()->segment(3) == 'reports' ? 'menu-item menu-item-submenu menu-item-open' : 'menu-item menu-item-submenu' }}"
                    aria-haspopup="true" data-menu-toggle="hover">

                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(10.000000, 11.000000) rotate(-315.000000) translate(-10.000000, -11.000000)" />
                                    <path
                                        d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z"
                                        fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">{{ __('label.reports') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">



                            <li
                                class="{{ request()->segment(4) == 'get_user_report' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                <a href="{{ route('admin.reports.getAattendances') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">


                                        {{ __('label.report_attendances_by_users') }}


                                    </span>
                                </a>
                            </li>


                            <li
                                class="{{ request()->segment(4) == 'completion_report' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                <a href="{{ route('admin.reports.completionReport') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">



                                        {{ __('label.completion_report') }}


                                    </span>
                                </a>
                            </li>

                            <li
                                class="{{ request()->segment(4) == 'reports' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                                <a href="{{ route('admin.reports.index') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">


                                        {{ __('label.attendance_departure_report') }}


                                    </span>
                                </a>
                            </li>




                        </ul>
                    </div>
                </li>
            @endif


            @if (auth('admin')->user()->can('view_tree') ||
                    auth('admin')->user()->can('view_equity') ||
                    auth('admin')->user()->can('view_liability') ||
                    auth('admin')->user()->can('view_expense'))
                <li class="{{ request()->segment(4) == 'trees' || request()->segment(4) == 'assets' || request()->segment(4) == 'expenses' || request()->segment(4) == 'equities' || request()->segment('4') == 'liabilities' ? 'menu-item menu-item-submenu menu-item-open' : 'menu-item menu-item-submenu' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <!-- SVG Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M3,3 L21,3 L21,21 L3,21 Z" fill="#000000" opacity="0.3" />
                                    <path d="M5,5 L5,19 L19,19 L19,5 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!-- End SVG Icon -->
                        </span>
                        <span class="menu-text">{{ __('label.account_mangment') }}</span>
                        <i class="menu-arrow"></i>
                    </a>

                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">{{ __('label.account_tree') }}</span>
                                </span>
                            </li>
                            @if (auth('admin')->user()->can('view_tree'))
                                <li class="{{ request()->segment(4) == 'trees' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.accounts.trees.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">
                                            {{ __('label.trees') }}

                                        </span>
                                    </a>
                                </li>
                            @endif
                            @if (auth('admin')->user()->can('view_tranactions_report'))
                                <li class="{{ request()->segment(4) == 'tranactions' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.accounts.tranactions.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">
                                            {{ __('label.transaction_report') }}

                                        </span>
                                    </a>
                                </li>
                            @endif


                            @if (auth('admin')->user()->can('view_asset'))
                                <li class="{{ request()->segment(4) == 'assets' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.accounts.assets.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">
                                            {{ __('label.assets') }}

                                        </span>
                                    </a>
                                </li>
                            @endif



                            @if (auth('admin')->user()->can('view_equity'))
                                <li class="{{ request()->segment(4) == 'equities' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.accounts.equities.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">
                                            {{ __('label.equities') }}

                                        </span>
                                    </a>
                                </li>
                            @endif

                            @if (auth('admin')->user()->can('view_liability'))
                                <li class="{{ request()->segment(4) == 'liabilities' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.accounts.liabilities.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">
                                            {{ __('label.liabilities') }}

                                        </span>
                                    </a>
                                </li>
                            @endif
                            @if (auth('admin')->user()->can('view_expense'))
                                <li class="{{ request()->segment(4) == 'expenses' ? 'menu-item menu-item-active' : 'menu-item' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('admin.accounts.expenses.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                        <span class="menu-text">
                                            {{ __('label.expenses') }}

                                        </span>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </li>
            @endif



            @if (auth('admin')->user()->can('view_constrancts'))
                <li class="{{ request()->segment(3) == 'contrancts' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                    aria-haspopup="true">

                    <a href="{{ route('admin.contrancts.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M6 20v-2c0-1.1.9-2 2-2h8c1.1 0 2 .9 2 2v2" />
                                    <path d="M9 12l2 2l4-4" />
                                </g>


                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">{{ __('label.contrancts') }}</span>
                    </a>


                </li>
            @endif

            @if (auth('admin')->user()->can('view_withdraws'))
                <li class="{{ request()->segment(3) == 'withdraws' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                    aria-haspopup="true">
                    <a href="{{ route('admin.withdraws.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <path opacity="0.5"
                                    d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                                    fill="currentColor" />
                                <path
                                    d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                                    fill="currentColor" />
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">{{ __('label.withdraws') }} </span>
                    </a>
                </li>
            @endif

            @if (auth('admin')->user()->can('view_activities'))
                <li class="{{ request()->segment(3) == 'contrancts' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                    aria-haspopup="true">

                    <a href="{{ route('admin.activities.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M6 20v-2c0-1.1.9-2 2-2h8c1.1 0 2 .9 2 2v2" />
                                    <path d="M9 12l2 2l4-4" />
                                </g>


                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">{{ __('label.activities') }}</span>
                    </a>


                </li>
            @endif

            @if (auth('admin')->user()->can('view_interviews'))
                <li class="{{ request()->segment(3) == 'interviews' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                    aria-haspopup="true">


                    <a href="{{ route('admin.interviews.index') }}" class="menu-link">
                        <span
                            class="svg-icon menu-icon "><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Chat4.svg--><svg
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M5.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L5.5,11 C4.67157288,11 4,10.3284271 4,9.5 L4,5.5 C4,4.67157288 4.67157288,4 5.5,4 Z M11,6 C10.4477153,6 10,6.44771525 10,7 C10,7.55228475 10.4477153,8 11,8 L13,8 C13.5522847,8 14,7.55228475 14,7 C14,6.44771525 13.5522847,6 13,6 L11,6 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M5.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M11,15 C10.4477153,15 10,15.4477153 10,16 C10,16.5522847 10.4477153,17 11,17 L13,17 C13.5522847,17 14,16.5522847 14,16 C14,15.4477153 13.5522847,15 13,15 L11,15 Z"
                                        fill="#000000" />
                                </g>


                            </svg><!--end::Svg Icon--></span>
                        <span class="menu-text">{{ __('label.interviews') }}</span>
                    </a>


                </li>
            @endif
        </ul>


        <!--end::Menu Nav-->
    </div>

    <!--end::Menu Container-->
</div>
