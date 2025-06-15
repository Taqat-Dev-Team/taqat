@extends('layouts.admin')
@section('title')
    {{ __('label.users') }}
@endsection

@section('style')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            /* This makes the element circular */
            overflow: hidden;
            /* Ensures content inside the circle stays within bounds */
        }

        img {
            width: 100%;
            /* Ensures the image fills the circular container */
            height: auto;
            /* Maintains aspect ratio */
            display: block;
            /* Removes any extra space below the image */
        }


        .modal {
            overflow: visible !important;
        }

        /* تحسين ظهور الـ Dropdown فوق الـ Modal */
        .dropdown-menu {
            z-index: 1080 !important;
            position: absolute !important;
            will-change: transform;
        }
    </style>
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">{{ __('label.view_all_users') }}</h1>
            </div>
            <div class="card-toolbar">



        </div>
        </div>
        <div class="card-body">

        <!--begin::Table-->

        <div class="table-responsive mt-3">
            <table class="table table-head-custom table-vertical-center verification-table" id="kt_advance_table_widget_1">
                <thead>
                    <tr class="text-left">
                        <td></td>
                        <th >{{ __('label.name') }} </th>
                        <th >{{ __('label.id_number') }} </th>
                        <th >{{ __('label.birth_date') }} </th>
                          <th > </th>

                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>


    <!-- Modal for accepting user request -->
    <div class="modal fade" id="acceptStatusModal" tabindex="-1" role="dialog" aria-labelledby="acceptStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="acceptStatusForm" name="acceptStatusForm" method="POST" action="">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="acceptStatusModalLabel">حالة الطلب</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('label.close') }}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-primary mt-3">بقبولك لهذا الطلب سيتم تفعيل الملف الشخصي لهذا المستخدم.</p>
                        <input type="hidden" name="user_id" id="edit_verification_user_id" value="">
                         <input type="hidden" name="is_verification" id="is_verification" value="1">


                    </div>
                    <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">{{ __('label.submit') }}</button>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('label.cancel') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    </div>


    <!-- Modal for showing the image -->
    <div class="modal fade" id="idPhotoModal" tabindex="-1" role="dialog" aria-labelledby="idPhotoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="idPhotoModalLabel">{{ __('label.id_photo') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('label.close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalIdPhoto" src="" alt="{{ __('label.id_photo') }}" style="max-width:100%;max-height:400px;">
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    @include('admin.users.js.js')
@endsection
