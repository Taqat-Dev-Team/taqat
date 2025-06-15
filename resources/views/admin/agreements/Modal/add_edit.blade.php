<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">
                    بيانات شروط الاتفاقية
                    </h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <h5 style="color: #0c0e1a">&times;</h5>
                        </span>
                    </button>
            </div>

            <form class="needs-validation" id="my-form" novalidate method="post">

                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="agreement_id" name="agreement_id">
                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">

                            <label for="value">
                                {{ __('label.description_ar') }}

                                <span class="text-danger">*</span>


                            </label>
                            <textarea id="value" class="form-control description" name="value" required></textarea>

                        </div>


                        <div class="col-lg-6 col-sm-12">

                            <label for="value">
                                {{ __('label.description_en') }}

                                <span class="text-danger">*</span>


                            </label>
                            <textarea id="value_en" class="form-control description" name="value_en" required></textarea>

                        </div>







                    </div>







                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><span>
                                <i class="fa fa-paper-plane hiden_icon" aria-hidden="true">
                                </i>
                                <span id="spinner" style="display: none;">
                                    <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                                </span>
                                {{ __('label.submit') }}


                        </button>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fa fa-window-close" aria-hidden="true"></i>
                            {{ __('label.cancel') }}
                        </button>

                    </div>
            </form>
        </div>
    </div>
</div>
