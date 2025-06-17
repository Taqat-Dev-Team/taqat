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
                <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                    <thead>
                        <tr class="text-left">
                            <th></th>
                            <th></th>

                            @foreach ($surveies as $value)
                                <th>{{ $value->title }}</th>
                            @endforeach

                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#kt_advance_table_widget_1').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.users.getDatatable') }}",
                    columns: [{
                            data: 'photo',
                            name: 'photo'
                        },

                        {
                            data: 'name',
                            name: 'name'
                        },
                        @foreach ($surveies as $survey)
                            {
                                data: 'survey_{{ $survey->id }}',
                                name: 'survey_{{ $survey->id }}'
                            },
                        @endforeach
                    ]
                });
            });
        </script>
    @endsection
