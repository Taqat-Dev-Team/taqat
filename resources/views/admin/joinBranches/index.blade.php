@extends('layouts.admin')
@section('title')
طلبات الانضمام الى الفروع
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">عرض كافة طلبات الانضمام الى الفروع</h1>
            </div>
            <div class="card-toolbar">


            </div>
        </div>
        <div class="card-body">



        <div class="form-group row m-1">

            <div class="col-lg-6">
                <label>{{ __('label.branches') }}</label>




                <select name="branch_id" class="form-control select2 branch_id" id="branch_id">
                    <option value="">{{ __('label.selected') }}</option>

                    @foreach ($branches as $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        <div class="form-group row m-2">
            <div class="col-lg-4">
                <button class="btn btn-primary " id="btnFiterSubmitSearch">بحث</button>
            </div>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
                <thead>

                    <tr class="text-left">
                        <th></th>

                        <th>{{ __('label.name') }}</th>
                        <th>المقر الحالي</th>

                        <th>{{ __('label.branch') }}</th>
                        <th>{{ __('label.actions') }}</th>


                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>


    <div class="modal fade" id="addToBranchModal" tabindex="-1" aria-labelledby="addToBranchModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addToBranchModalLabel">تغير الفرع</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x&times;</span>
                    </button>
                </div>
                <form class="needs-validation" id="my-form" name="my-form" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf

                        <input type="hidden" class="form-control" id="user_id" name="user_id" placeholder="">
                        <input type="hidden" class="form-control" id="add_branch_id" name="branch_id" placeholder="">

                        <p>هل انت متاكد من نقل <span class="user_name">  </span>  الى   <span class="branch_name"><span>
                        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <span><i class="fa fa-paper-plane" aria-hidden="true"></i></span> تاكيد
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    @include('Shared.delete')
@endsection

@section('scripts')
    @include('admin.joinBranches.js.js')
@endsection
