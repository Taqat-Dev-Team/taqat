@extends('layouts.front')
@section('title')
    الدفع المالية الخاصة بالمشاريع
@endsection
@section('content')


<div class="card card-custom">
    <div class="card-header flex-wrap">
        <div class="card-title">
            <h1 class="card-label">{{__('label.display_all_payments')}}</h1>
        </div>
        <div class="card-toolbar">


        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3 col-sm6">
                <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                    <label>{{__('label.mystone_count')}}</label>
                    <span id="user_count">({{$mystone_count}})</span>
                </div>
            </div>

            <div class="col-lg-3 col-sm6">
                <div class="col bg-light-success px-6 py-8 rounded-2 mb-7">
                    <label>{{__('label.mystone_amount')}}</label>
                    <span id="presence_count">({{$mystone_amount}})</span>
                </div>

            </div>

            <div class="col-lg-3 col-sm6">
                <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                    <label>{{__('label.mystone_payment')}}</label>
                    <span id="absence_count">({{$mystone_payment}})</span>
                </div>


            </div>
            <div class="col-lg-3 col-sm6">
                <div class="col bg-light-danger px-6 py-8 rounded-2 me-7 mb-7">
                    <label>{{__('label.mystone_no_payment')}}</label>
                    <span id="hours_count">({{$mystone_no_payment}})</span>
                </div>

            </div>
        </div>

    <div class="table-responsive mt-3">
        <table class="table table-head-custom table-vertical-center data-table" id="kt_advance_table_widget_1">
            <thead>

                <tr class="text-left">

                    <th>العنوان</th>
                    <th>المشروع</th>
                    <th>قيمة الحوالة</th>
                    <th>التاريخ</th>
                    <th>الحالة</th>
                    <th>العمليات</th>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
</div>





<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <label class="modal-title" id="exampleModalLabel"></label>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="my-form" name="my-form" method="POST">
                @csrf
                <input type="hidden" value="" name="my_stone_id" id="my_stone_id">

                <div class="form-row">
                    <!-- First row of inputs -->
                    <div class="form-group col-md-6">
                        <label for="name">الاسم</label>
                        <input type="text" class="form-control" id="name" name="name">

                    </div>

                    <div class="form-group col-md-6">
                        <label for="mobile">رقم الجوال</label>
                        <input type="text" class="form-control" id="mobile" name="mobile">

                    </div>


                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="bank_name">اسم البنك</label>
                        <input type="text" class="form-control" id="bank_name" name="bank_name">

                    </div>
                    <!-- First row of inputs -->
                    <div class="form-group col-md-6">
                        <label for="iban">IBAN</label>
                        <input type="text" class="form-control" id="iban" name="iban">

                    </div>




                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="account_number">رقم الحساب البنكي</label>
                        <input type="text" class="form-control" id="account_number" name="account_number">

                    </div>
                    <!-- First row of inputs -->


                </div>


        </div>
        <div class="modal-footer row">
            <div class="col-log-6">

                <button type="submit" class="btn btn-primary"
                    id="save-button">تاكيد </button>
            </div>
            <div class="col-log-6">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">الغاء</button>
            </div>

        </form>

        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
    @include('front.mystones.js.js')
@endsection
