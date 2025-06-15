<ul class="menu-nav">

    <li class="{{ request()->segment(3) == 'dashboard' ? 'menu-item menu-item-active' : 'menu-item ' }}"
        aria-haspopup="true">
        <a href="{{ route('companies.index') }}" class="menu-link">
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
            <span class="menu-text">{{__('label.main')}} </span>
        </a>
    </li>




    <li class="{{ request()->segment(3) == 'users' ? 'menu-item menu-item-active' : 'menu-item ' }}"
        aria-haspopup="true">
        <a href="{{route('companies.users.index')}}" class="menu-link">
    <span class="svg-icon menu-icon">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Mirror.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24" />
                                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                                </g>
                                            </svg>
        <!--end::Svg Icon-->
										</span>
            <span class="menu-text">{{__('label.employees')}}</span>
        </a>
    </li>


    <li class="{{ request()->segment(3) == 'projects' ? 'menu-item menu-item-submenu menu-item-open' : 'menu-item menu-item-submenu' }}"  aria-haspopup="true" data-menu-toggle="hover">

        <a href="javascript:;" class="menu-link menu-toggle">
            <span class="svg-icon menu-icon">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <path d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z" fill="#000000" fill-rule="nonzero" transform="translate(10.000000, 11.000000) rotate(-315.000000) translate(-10.000000, -11.000000)" />
                        <path d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z" fill="#000000" opacity="0.3" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
            <span class="menu-text">{{__('label.projects')}}</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="menu-submenu">
            <i class="menu-arrow"></i>
            <ul class="menu-subnav">
                <li class="menu-item menu-item-parent" aria-haspopup="true">
                    <span class="menu-link">
                        <span class="menu-text">{{__('label.projects')}}</span>
                    </span>
                </li>

                <li class="{{ request()->segment(5) == 'pennding' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                    <a href="{{route('companies.projects.index','pennding')}}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">


                            {{__('label.projects_are_in_the_waiting_phase')}}

                            <span style="color: yellow ;margin-right:3%">

                            ({{\App\Models\CompanyProject::where('company_id',auth('company')->id())->where('status',1)->count()}})
                            </span>
                        </span>
                    </a>
                </li>

                <li class="{{ request()->segment(5) == 'processing' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                    <a href="{{route('companies.projects.index','processing')}}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">{{__('label.projects_implementation_stage')}}
                            <span style="color: yellow ;margin-right:3%">

                            ({{\App\Models\CompanyProject::where('company_id',auth('company')->id())->where('status',2)->count()}})
                            </span>

                        </span>
                    </a>
                </li>

                <li class="{{ request()->segment(5) == 'completed' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                    <a href="{{route('companies.projects.index','completed')}}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>

                        <span class="menu-text"> {{__('label.completed_projects')}}
                        <span style="color: yellow ;margin-right:3%">
                            ({{\App\Models\CompanyProject::where('company_id',auth('company')->id())->where('status',3)->count()}})
                        </span>

                        </span>
                    </a>
                </li>
                <li class="{{ request()->segment(5) == 'reject' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                    <a href="{{route('companies.projects.index','reject')}}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">{{__('label.projects_incomplete')}}
                            <span style="color: yellow ;margin-right:3%">

                            ({{\App\Models\CompanyProject::where('company_id',auth('company')->id())->where('status',4)->count()}})
                            </span>
                        </span>
                    </a>
                </li>
                <li class="{{ request()->segment(5) == 'ratting' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                    <a href="{{route('companies.projects.index','ratting')}}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">{{__('label.projects_evaluated')}}
                            <span style="color: yellow ;margin-right:3%">

                            ({{\App\Models\CompanyProject::where('company_id',auth('company')->id())->where('status',3)->wherehas('compnayRatting')->count()}})
                            </span>
                        </span>
                    </a>
                </li>
                <li class="{{ request()->segment(5) == 'not-ratting' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                    <a href="{{route('companies.projects.index','not-ratting')}}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">{{__('label.projects_not_evaluated')}}
                            <span style="color: yellow ;margin-right:3%">

                            ({{\App\Models\CompanyProject::where('company_id',auth('company')->id())->where('status',3)->doesntHave('compnayRatting')->count()}})
                            </span>

                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="{{ request()->segment(3) == 'my_stone' ? 'menu-item menu-item-active' : 'menu-item ' }}"  aria-haspopup="true">

        <a href="{{route('companies.mystone.index')}}" class="menu-link">
										<span class="svg-icon menu-icon">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="8" r="4"/>
                                                    <path d="M6 20v-2c0-1.1.9-2 2-2h8c1.1 0 2 .9 2 2v2"/>
                                                    <path d="M9 12l2 2l4-4"/>
                                                </g>


											</svg>
                                            <!--end::Svg Icon-->
										</span>
            <span class="menu-text">{{__('label.mystone')}}</span>
        </a>


    </li>

    <li class="{{ request()->segment(3) == 'jobs' ? 'menu-item menu-item-submenu menu-item-open' : 'menu-item menu-item-submenu' }}"  aria-haspopup="true" data-menu-toggle="hover">

        <a href="javascript:;" class="menu-link menu-toggle">
            <span class="svg-icon menu-icon">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M5.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L5.5,11 C4.67157288,11 4,10.3284271 4,9.5 L4,5.5 C4,4.67157288 4.67157288,4 5.5,4 Z M11,6 C10.4477153,6 10,6.44771525 10,7 C10,7.55228475 10.4477153,8 11,8 L13,8 C13.5522847,8 14,7.55228475 14,7 C14,6.44771525 13.5522847,6 13,6 L11,6 Z" fill="#000000" opacity="0.3"/>
                        <path d="M5.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M11,15 C10.4477153,15 10,15.4477153 10,16 C10,16.5522847 10.4477153,17 11,17 L13,17 C13.5522847,17 14,16.5522847 14,16 C14,15.4477153 13.5522847,15 13,15 L11,15 Z" fill="#000000"/>
                    </g>

                </svg>
                <!--end::Svg Icon-->
            </span>
            <span class="menu-text">{{__('label.jobs')}}</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="menu-submenu">
            <i class="menu-arrow"></i>
            <ul class="menu-subnav">
                <li class="menu-item menu-item-parent" aria-haspopup="true">
                    <span class="menu-link">
                        <span class="menu-text">{{__('label.jobs')}}</span>
                    </span>
                </li>

                <li class="{{ request()->segment(5) == 'pennding' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                    <a href="{{route('companies.jobs.index','pennding')}}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">


                            {{__('label.jobs_are_in_the_waiting_phase')}}

                            <span style="color: yellow ;margin-right:3%">

                            ({{\App\Models\Job::where('company_id',auth('company')->id())->where('status',1)->count()}})
                            </span>
                        </span>
                    </a>
                </li>

                <li class="{{ request()->segment(5) == 'processing' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                    <a href="{{route('companies.jobs.index','processing')}}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">{{__('label.jobs_implementation_stage')}}
                            <span style="color: yellow ;margin-right:3%">

                            ({{\App\Models\Job::where('company_id',auth('company')->id())->where('status',2)->count()}})
                            </span>

                        </span>
                    </a>
                </li>

                <li class="{{ request()->segment(5) == 'completed' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                    <a href="{{route('companies.jobs.index','completed')}}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>

                        <span class="menu-text"> {{__('label.completed_jobs')}}
                        <span style="color: yellow ;margin-right:3%">
                            ({{\App\Models\Job::where('company_id',auth('company')->id())->where('status',3)->count()}})
                        </span>

                        </span>
                    </a>
                </li>
                <li class="{{ request()->segment(5) == 'reject' ? 'menu-item menu-item-active' : 'menu-item' }} aria-haspopup="true">
                    <a href="{{route('companies.jobs.index','reject')}}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="menu-text">{{__('label.jobs_incomplete')}}
                            <span style="color: yellow ;margin-right:3%">

                            ({{\App\Models\Job::where('company_id',auth('company')->id())->where('status',4)->count()}})
                            </span>
                        </span>
                    </a>
                </li>


            </ul>
        </div>
    </li>
       <li class="{{ request()->segment(3) == 'attendances' ? 'menu-item menu-item-active' : 'menu-item ' }}"  aria-haspopup="true">

        <a href="{{route('companies.attendances.index')}}" class="menu-link">
										<span class="svg-icon menu-icon">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="8" r="4"/>
                                                    <path d="M6 20v-2c0-1.1.9-2 2-2h8c1.1 0 2 .9 2 2v2"/>
                                                    <path d="M9 12l2 2l4-4"/>
                                                </g>


											</svg>
                                            <!--end::Svg Icon-->
										</span>
            <span class="menu-text">{{__('label.attendance_departure')}}</span>
        </a>


    </li>


    {{-- {{auth('company')->user()->chats}} --}}
    @if(!is_null(auth('company')->user()->chats) )

    @if(auth('company')->user()->chats->count()>0)
    <li class="{{ request()->segment(2) == 'chats' ? 'menu-item menu-item-active' : 'menu-item ' }}"  aria-haspopup="true">


        <a href="{{route('companies.chats.view')}}" class="menu-link">
            <span class="svg-icon menu-icon "><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Chat4.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <path d="M21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L5,18 C3.34314575,18 2,16.6568542 2,15 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 Z M6.16794971,10.5547002 C7.67758127,12.8191475 9.64566871,14 12,14 C14.3543313,14 16.3224187,12.8191475 17.8320503,10.5547002 C18.1384028,10.0951715 18.0142289,9.47430216 17.5547002,9.16794971 C17.0951715,8.86159725 16.4743022,8.98577112 16.1679497,9.4452998 C15.0109146,11.1808525 13.6456687,12 12,12 C10.3543313,12 8.9890854,11.1808525 7.83205029,9.4452998 C7.52569784,8.98577112 6.90482849,8.86159725 6.4452998,9.16794971 C5.98577112,9.47430216 5.86159725,10.0951715 6.16794971,10.5547002 Z" fill="#000000"/>
                </g>
            </svg><!--end::Svg Icon--></span>
            <span class="menu-text">{{__('label.chat_menu')}}</span>
        </a>


    </li>
@endif
    @endif


    <li class="{{ request()->segment(3) == 'contrancts' ? 'menu-item menu-item-active' : 'menu-item ' }}"  aria-haspopup="true">

        <a href="{{route('companies.contrancts.index')}}" class="menu-link">
										<span class="svg-icon menu-icon">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="8" r="4"/>
                                                    <path d="M6 20v-2c0-1.1.9-2 2-2h8c1.1 0 2 .9 2 2v2"/>
                                                    <path d="M9 12l2 2l4-4"/>
                                                </g>


											</svg>
                                            <!--end::Svg Icon-->
										</span>
            <span class="menu-text">{{__('label.contrancts')}}</span>
        </a>


    </li>


<li class="{{ request()->segment(2) == 'interviews' ? 'menu-item menu-item-active' : 'menu-item ' }}"  aria-haspopup="true">


    <a href="{{route('companies.interveiws.index')}}" class="menu-link">
        <span class="svg-icon menu-icon "><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Chat4.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"/>
                <path d="M5.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L5.5,11 C4.67157288,11 4,10.3284271 4,9.5 L4,5.5 C4,4.67157288 4.67157288,4 5.5,4 Z M11,6 C10.4477153,6 10,6.44771525 10,7 C10,7.55228475 10.4477153,8 11,8 L13,8 C13.5522847,8 14,7.55228475 14,7 C14,6.44771525 13.5522847,6 13,6 L11,6 Z" fill="#000000" opacity="0.3"/>
                <path d="M5.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M11,15 C10.4477153,15 10,15.4477153 10,16 C10,16.5522847 10.4477153,17 11,17 L13,17 C13.5522847,17 14,16.5522847 14,16 C14,15.4477153 13.5522847,15 13,15 L11,15 Z" fill="#000000"/>
            </g>


        </svg><!--end::Svg Icon--></span>
        <span class="menu-text">{{__('label.interviews')}}</span>
    </a>


</li>




</ul>
