<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
        data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->

        <ul class="menu-nav">













            <li class="{{ request()->segment(1) == 'dashboard' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                aria-haspopup="true">
                <a href="{{ route('front.index') }}" class="menu-link">
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
                    <span class="menu-text">الرئيسية </span>
                </a>
            </li>

            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
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
                    <span class="menu-text">ادارة السيرة الذاتية</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">ادارة السيرة الذاتية</span>
                            </span>
                        </li>
                        <li
                            class="{{ request()->segment(1) == 'projects' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                            <a href="{{ route('front.profile.personalData') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">البيانات الشخصية</span>
                            </a>
                        </li>
                        <li
                            class="{{ request()->segment(1) == 'projects' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                            <a href="{{ route('front.projects.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">مشاريع</span>
                            </a>
                        </li>
                        <li
                            class="{{ request()->segment(1) == 'projects' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                            <a href="{{ route('front.trainingCourses.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">الدورات التدريبية</span>
                            </a>
                        </li>

                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('front.scientificCerificates.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">الشهادات العلمية</span>
                            </a>
                        </li>
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('front.workExperiences.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">الخبرات العملية</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @if (auth()->user()->status == 1)
                <li class="{{ request()->segment(1) == 'attendances' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                    aria-haspopup="true">
                    <a href="{{ route('front.attendances.index') }}" class="menu-link">
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
                        <span class="menu-text">الحضور والانصراف </span>
                    </a>
                </li>
            @endif

            <li class="{{ request()->segment(2) == 'taqat-projects' ? 'menu-item menu-item-submenu menu-item-open' : 'menu-item menu-item-submenu' }}"
                aria-haspopup="true" data-menu-toggle="hover">

                <a href="javascript:;" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            version="1.1">
                            <g fill="none" fill-rule="evenodd">
                                <rect width="24" height="24" />
                                <path
                                    d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z"
                                    fill="#000" fill-rule="nonzero"
                                    transform="translate(10, 11) rotate(-315) translate(-10, -11)" />
                                <path
                                    d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z"
                                    fill="#000" opacity="0.3" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-text">مشاريع طاقات</span>
                    <i class="menu-arrow"></i>
                </a>

                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">مشاريع طاقات</span>
                            </span>
                        </li>


                        <li class="{{ request()->segment(3) == 'processing' ? 'menu-item menu-item-active' : 'menu-item' }}"
                            aria-haspopup="true">
                            <a href="{{ route('front.companyProjects.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">قائمة المشاريع
                                    <span class="badge badge-warning"
                                        style="margin-right: 9px;">({{ \App\Models\CompanyProject::query()->count() }})</span>
                                </span>
                            </a>
                        </li>

                        <li class="{{ request()->segment(3) == 'processing' ? 'menu-item menu-item-active' : 'menu-item' }}"
                            aria-haspopup="true">
                            <a href="{{ route('front.myProjects.index', 'processing') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">المشاريع قيد التنفيذ
                                    <span class="badge badge-warning"
                                        style="margin-right: 9px;">({{ \App\Models\CompanyProject::where('user_id', auth()->id())->where('status', 2)->count() }})</span>
                                </span>
                            </a>
                        </li>

                        <li class="{{ request()->segment(3) == 'completed' ? 'menu-item menu-item-active' : 'menu-item' }}"
                            aria-haspopup="true">
                            <a href="{{ route('front.myProjects.index', 'completed') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">المشاريع المكتملة
                                    <span class="badge badge-warning"
                                        style="margin-right: 9px;">({{ \App\Models\CompanyProject::where('user_id', auth()->id())->where('status', 3)->count() }})</span>
                                </span>
                            </a>
                        </li>

                        <li class="{{ request()->segment(3) == 'ratting' ? 'menu-item menu-item-active' : 'menu-item' }}"
                            aria-haspopup="true">
                            <a href="{{ route('front.myProjects.index', 'ratting') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">المشاريع تم تقييمها
                                    <span class="badge badge-warning"
                                        style="margin-right: 9px;">({{ \App\Models\CompanyProject::where('user_id', auth()->id())->whereHas('userRattings')->where('status', 3)->count() }})</span>
                                </span>
                            </a>
                        </li>

                        <li class="{{ request()->segment(3) == 'not-ratting' ? 'menu-item menu-item-active' : 'menu-item' }}"
                            aria-haspopup="true">
                            <a href="{{ route('front.myProjects.index', 'not-ratting') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">المشاريع لم يتم تقييمها
                                    <span class="badge badge-warning"
                                        style="margin-right: 9px;">({{ \App\Models\CompanyProject::where('user_id', auth()->id())->doesntHave('userRattings')->where('status', 3)->count() }})</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            @if (auth()->user()->status == 1)


            <li class="{{ request()->segment(2) == 'restaurants' ? 'menu-item menu-item-submenu menu-item-open' : 'menu-item menu-item-submenu' }}"
                aria-haspopup="true" data-menu-toggle="hover">

                <a href="javascript:;" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            version="1.1">
                            <g fill="none" fill-rule="evenodd">
                                <rect width="24" height="24" />
                                <path
                                    d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z"
                                    fill="#000" fill-rule="nonzero"
                                    transform="translate(10, 11) rotate(-315) translate(-10, -11)" />
                                <path
                                    d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z"
                                    fill="#000" opacity="0.3" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-text">ادارة الكفي والطلبات</span>
                    <i class="menu-arrow"></i>
                </a>

                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">ادارة الكفي والطلبات</span>
                            </span>
                        </li>


                        <li class="{{ request()->segment(3) == 'processing' ? 'menu-item menu-item-active' : 'menu-item' }}"
                            aria-haspopup="true">
                            <a href="{{ route('front.restaurants.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">المطاعم

                                </span>
                            </a>
                        </li>

                        <li class="{{ request()->segment(3) == 'processing' ? 'menu-item menu-item-active' : 'menu-item' }}"
                            aria-haspopup="true">
                            <a href="{{ route('front.orders.index', 'processing') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">طلباتي

                            </a>
                        </li>





                    </ul>
                </div>
            </li>

            @endif



            {{--            <li class="{{ request()->segment(1) == 'influencesProjects' ? 'menu-item menu-item-active' : 'menu-item ' }}" --}}
            {{--                    aria-haspopup="true"> --}}
            {{--                    <a href="{{ route('front.companyProjects.index') }}" class="menu-link"> --}}
            {{--                        <span class="svg-icon menu-icon"> --}}
            {{--                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg--> --}}
            {{--                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" --}}
            {{--                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1"> --}}
            {{--                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> --}}
            {{--                                    <rect x="0" y="0" width="24" height="24" /> --}}
            {{--                                    <rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16" /> --}}
            {{--                                    <path --}}
            {{--                                        d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z" --}}
            {{--                                        fill="#000000" fill-rule="nonzero" /> --}}
            {{--                                </g> --}}
            {{--                            </svg> --}}
            {{--                            <!--end::Svg Icon--> --}}
            {{--                        </span> --}}
            {{--                        <span class="menu-text">قائمة المشاريع  </span> --}}
            {{--                    </a> --}}
            {{--                </li> --}}

            <li class="{{ request()->segment(1) == 'incomeMovements' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                aria-haspopup="true">
                <a href="{{ route('front.incomeMovements.index') }}" class="menu-link">
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
                    <span class="menu-text">الحركات المالية </span>
                </a>
            </li>

            <li class="{{ request()->segment(1) == 'my_stone' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                aria-haspopup="true">
                <a href="{{ route('front.mystone.index') }}" class="menu-link">
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
                    <span class="menu-text">قائمة الدفعات المالية </span>
                </a>
            </li>



            @if (auth()->user()->invoices()->exists())
                <li class="{{ request()->segment(1) == 'invoices' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                    aria-haspopup="true">
                    <a href="{{ route('front.invoices.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <!-- Replace this SVG block with your new SVG code -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                viewBox="0 0 24 24" version="1.1">
                                <!-- Add your new SVG path data here -->
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <!-- Example of new path data -->
                                    <path d="M12 2L2 12h10l10-10H12z" fill="#000000" />
                                </g>
                            </svg>
                            <!-- end new SVG -->
                        </span>
                        <span class="menu-text">قائمة الفواتير </span>
                    </a>
                </li>
            @endif

            <li class="{{ request()->segment(1) == 'withdraws' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                aria-haspopup="true">
                <a href="{{ route('front.withdraws.index') }}" class="menu-link">
                    <span class="svg-icon menu-icon">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path opacity="0.5"
                                d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                                fill="currentColor" />
                            <path
                                d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                                fill="currentColor" />
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-text">قائمة طلبا ت السحب</span>
                </a>
            </li>






            <li class="{{ request()->segment(1) == 'contrancts' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                aria-haspopup="true">

                <a href="{{ route('front.contrancts.index') }}" class="menu-link">
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
                    <span class="menu-text">عقود العمل طاقات</span>
                </a>


            </li>

            <li class="{{ request()->segment(1) == 'jobConstrancts' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                aria-haspopup="true">
                <a href="{{ route('front.jobConstrancts.index') }}" class="menu-link">
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
                    <span class="menu-text">عقود العمل </span>
                </a>
            </li>











            @if (auth()->user()->chats->count() > 0)
                <li class="{{ request()->segment(2) == 'chats' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                    aria-haspopup="true">


                    <a href="{{ route('front.chats.view') }}" class="menu-link">
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
                        <span class="menu-text">قائمة الدردشة</span>
                    </a>


                </li>
            @endif





            <li class="{{ request()->segment(2) == 'wallets' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                aria-haspopup="true">


                <a href="{{ route('front.wallets.index') }}" class="menu-link">
                    <span class="svg-icon menu-icon">
                        <!--begin::Svg Icon | Wallet-->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect x="2" y="7" width="20" height="14" rx="4" fill="#000"
                                opacity="0.3" />
                            <rect x="2" y="3" width="20" height="4" rx="2" fill="#000" />
                            <circle cx="17" cy="14" r="2" fill="#fff" />
                        </svg>
                        <!--end::Svg Icon-->
                    </span>


                    </svg><!--end::Svg Icon--></span>
                    <span class="menu-text">محفظتي</span>
                </a>


            </li>


            <li class="{{ request()->segment(1) == 'interviews' ? 'menu-item menu-item-active' : 'menu-item ' }}"
                aria-haspopup="true">


                <a href="{{ route('front.interviews.index') }}" class="menu-link">
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
                    <span class="menu-text">المقابلات</span>
                </a>


            </li>

        </ul>
        <!--end::Menu Nav-->
    </div>

    <!--end::Menu Container-->
</div>
