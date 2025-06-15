<div class="modal fade" id="kt_modal_add_edit" tabindex="-1" aria-labelledby="kt_modal_add_editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kt_modal_add_editLabel">{{ __('label.add_service') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="my-form" method="POST" name="my-form" action="{{ route('front.services.store') }}">
                @csrf
                <div class="modal-body">

                    <!-- صف يحتوي على حقلين -->
                    <div class="row">
                        <!-- حقل الاسم -->
                        <div class="form-group col-md-6">
                            <label for="name">{{ __('label.services') }}

                                <span class="error">*</span>
                            </label>
                            <select class="form-control " name="service_id" id="add_edit_service_id" required
                                style="width: 100%">
                                <option value="">{{ __('label.selected') }}</option>

                                @foreach ($services as $value)
                                    <option value="{{ $value->id }}">{{ $value->name . '(' . $value->amount . ')' }}
                                        {{ $value->amount_type == 1 ? __('label.dollar') : __('label.shekel') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="quantity">{{ __('label.quantity') }}
                                <span class="error">*</span>
                            </label>
                            <input type="number" min="1" class="form-control" id="add_edit_quantity"
                                name="quantity" required>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">

                        <div class="service-amount"></div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                aria-hidden="true"></i></span> {{ __('label.submit') }} </button>
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('label.close') }}</button>
                </div>

                <!-- زر التأكيد -->
            </form>
        </div>
    </div>
</div>
</div>
