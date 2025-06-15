@extends('layouts.admin')
@section('title')
    {{ __('label.trees') }}
@endsection

@section('content')
    <div class="modern-tree">

        <div class="tree-node">
            <div class="node-content node-action">
                <button class="add-main-account-btn parent_account" data-toggle="modal" data-target="#kt_modal_add_edit">+
                    اضافة حساب
                    رئيسي</button>
            </div>
        </div>

        @foreach ($accounts as $account)
            <div class="node-container">
                @include('admin.accounts.tree.partials.node', [
                    'account' => $account,
                    'level' => 0,
                    'parent' => null,
                ])
            </div>
        @endforeach

        <div class="modal fade" id="kt_modal_add_edit" tabindex="-1" aria-labelledby="kt_modal_add_editLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="kt_modal_add_editLabel">اضافة حسابات رئيسية</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="my-form" method="POST" name="my-form" action="{{ route('admin.accounts.trees.store') }}">
                        @csrf
                        <div class="modal-body">

                            <div class="row">
                                <!-- حقل الاسم -->
                                <div class="form-group col-md-6">
                                    <label for="code">{{ __('label.code') }}

                                        <span class="error">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="add_edit_code" name="code" required>
                                </div>
                            </div>

                            <!-- صف يحتوي على حقلين -->
                            <div class="row">
                                <!-- حقل الاسم -->
                                <div class="form-group col-md-6">
                                    <label for="name">{{ __('label.name') }}

                                        <span class="error">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="add_edit_name" name="name" required>
                                </div>
                                <input type="hidden" class="form-control" id="add_edit_account_id" name="account_id"
                                    required placeholder="">

                                <!-- حقل parent_id -->
                                <div class="form-group col-md-6">
                                    <label for="balance_type_id">{{ __('label.balance_type') }}

                                        <span class="error">*</span>

                                    </label>
                                    <select class="form-control" id="add_edit_balance_type_id" name="balance_type_id"
                                        style="width: 100%">
                                        <option value="">{{ __('label.select_balance_type') }}</option>
                                        @foreach ($balanceTypes as $balanceType)
                                            <option value="{{ $balanceType->id }}">
                                                {{ $balanceType->value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                        aria-hidden="true"></i></span> تاكيد </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        </div>

                        <!-- زر التأكيد -->
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="kt_modal_add_edit_child" tabindex="-1" aria-labelledby="kt_modal_add_edit_childLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="kt_modal_add_edit_childLabel">اضافة حسب محاسبي جديد</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="my-child-form" method="POST" name="my-child-form"
                        action="{{ route('admin.accounts.trees.storeChild') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <!-- حقل الاسم -->
                                <div class="form-group col-md-6">
                                    <label for="code">{{ __('label.code') }}

                                        <span class="error">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="add_edit_child_code" name="code"
                                        required>
                                </div>
                            </div>
                            <!-- صف يحتوي على حقلين -->
                            <div class="row">
                                <!-- حقل الاسم -->
                                <div class="form-group col-md-6">
                                    <label for="name">{{ __('label.name') }}

                                        <span class="error">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="add_edit_name" name="name" required>
                                </div>
                                <input type="hidden" class="form-control" id="add_edit_account_id" name="account_id"
                                    required placeholder="">

                                <input type="hidden" class="form-control" id="add_edit_parent_id" name="parent_id"
                                    required>




                                <!-- حقل parent_id -->
                                <div class="form-group col-md-6">
                                    <label for="balance_type_id">{{ __('label.balance_type') }}

                                        <span class="error">*</span>

                                    </label>
                                    <select class="form-control" name="balance_type_id" style="width: 100%">
                                        <option value="">{{ __('label.select_balance_type') }}</option>
                                        @foreach ($balanceTypes as $balanceType)
                                            <option value="{{ $balanceType->id }}">
                                                {{ $balanceType->value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                        aria-hidden="true"></i></span> تاكيد </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        </div>

                        <!-- زر التأكيد -->
                    </form>
                </div>
            </div>
        </div>


    </div>

    </div>
    </div>

    </div>

    <style>
        .node-action {
            display: flex;
            justify-content: flex-end;
            /* يجعل الزر على أقصى اليمين */
            background: transparent;
            box-shadow: none;
            padding: 0;
        }

        .add-main-account-btn {
            background-color: var(--primary-color);
            color: #fff;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .add-main-account-btn:hover {
            background-color: #5a4de0;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(108, 92, 231, 0.2);
        }

        .modern-tree {
            --primary-color: #6C5CE7;
            --secondary-color: #A8A5E6;
            --background: #F8F9FF;
            padding: 2rem;
            background: var(--background);
            min-height: 100vh;
        }

        .tree-node {
            position: relative;
            margin: 1.5rem 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .node-content {
            display: flex;
            align-items: center;
            padding: 1.2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(108, 92, 231, 0.1);
            cursor: pointer;
            transform: scale(1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .node-content::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background: var(--primary-color);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .node-content:hover {
            transform: scale(1.02) translateX(10px);
            box-shadow: 0 12px 40px rgba(108, 92, 231, 0.15);
        }

        .node-content:hover::before {
            transform: scaleY(1);
        }

        .node-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 1.5rem;
            flex-shrink: 0;
        }

        .node-info {
            flex-grow: 1;
        }

        .node-code {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.1em;
        }

        .node-name {
            color: #2D3436;
            font-size: 1.05em;
            margin-top: 0.3rem;
        }

        .node-balance {
            background: rgba(108, 92, 231, 0.1);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            color: var(--primary-color);
            margin-left: 1.5rem;
            min-width: 120px;
            text-align: right;
        }

        .children-container {
            margin-left: 4rem;
            padding-left: 2rem;
            position: relative;
        }

        .children-container::before {
            content: '';
            position: absolute;
            left: 0;
            top: -20px;
            width: 2px;
            height: calc(100% + 40px);
            background: repeating-linear-gradient(180deg,
                    transparent,
                    transparent 10px,
                    var(--secondary-color) 10px,
                    var(--secondary-color) 20px);
        }

        .toggle-button {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 1rem;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .toggle-button.expanded {
            transform: rotate(180deg);
        }

        /* تأثيرات الإضاءة */
        .tree-node::after {
            content: '';
            position: absolute;
            top: 50%;
            left: -30px;
            width: 60px;
            height: 60px;
            background: radial-gradient(rgba(108, 92, 231, 0.1), transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .tree-node:hover::after {
            opacity: 1;
        }

        /* أنيميشن التوسيع */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .expanding {
            animation: slideDown 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

    <script>
        $("#my-form").validate({
            rules: {
                name: {
                    required: true
                },
                code: {
                    required: true
                },
                balance_type_id: {
                    required: true
                },


            },
            submitHandler: function(form) {
                $('#spinner').show();
                $('.error').hide(); // Hide previous error messages

                $('#submit-button').prop('disabled',
                    true); // Disable submit button to prevent multiple submissions

                var url = $('#my-form').attr('action');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Hide the spinner and enable the submit button
                        $('#spinner').hide();
                        $('#submit-button').prop('disabled', false);

                        // Handle the response on success
                        if (response.success) {
                            toastr.success(response.message,
                                '{{ __('label.success') }}', {
                                    timeOut: 3000
                                });
                            $('#kt_modal_add_edit').modal('hide');
                            setTimeout(() => {
                                location.reload(); // Reload the page
                            }, 1000); // Wait for 1 second before reloading

                        } else {
                            toastr.error(response.message, 'Error', {
                                timeOut: 3000
                            });
                        }
                    },
                    error: function(xhr) {
                        // Hide the spinner and enable the submit button
                        $('#spinner').hide();
                        $('#submit-button').prop('disabled', false);

                        if (xhr.status === 422) {
                            // Loop through the validation errors and display them with toastr
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                // Show the error messages in the corresponding fields
                                var errorContainer = $('#' + field + '_error');
                                errorContainer.text(messages.join(', '))
                                    .show(); // Join messages if there are multiple
                            });
                        } else {
                            // For other errors, display a general error message
                            toastr.error(
                                '{{ __('messages.An error occurred. Please try again later') }}',
                                'Error', {
                                    timeOut: 3000
                                });
                        }
                    }
                });
            }
        });

        $("#my-child-form").validate({
            rules: {
                name: {
                    required: true
                },
                code: {
                    required: true
                },
                balance_type_id: {
                    required: true
                },


            },
            submitHandler: function(form) {
                $('#spinner').show();
                $('.error').hide(); // Hide previous error messages

                $('#submit-button').prop('disabled',
                    true); // Disable submit button to prevent multiple submissions

                var url = $('#my-child-form').attr('action');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Hide the spinner and enable the submit button
                        $('#spinner').hide();
                        $('#submit-button').prop('disabled', false);

                        // Handle the response on success
                        if (response.success) {
                            toastr.success(response.message,
                                '{{ __('label.success') }}', {
                                    timeOut: 3000
                                });
                            $('#kt_modal_add_edit_child').modal('hide');

                            setTimeout(() => {
                                location.reload(); // Reload the page
                            }, 1000); // Wait for 1 second before reloading
                        } else {
                            toastr.error(response.message, 'Error', {
                                timeOut: 3000
                            });
                        }
                    },
                    error: function(xhr) {
                        // Hide the spinner and enable the submit button
                        $('#spinner').hide();
                        $('#submit-button').prop('disabled', false);

                        if (xhr.status === 422) {
                            // Loop through the validation errors and display them with toastr
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                // Show the error messages in the corresponding fields
                                var errorContainer = $('#' + field + '_error');
                                errorContainer.text(messages.join(', '))
                                    .show(); // Join messages if there are multiple
                            });
                        } else {
                            // For other errors, display a general error message
                            toastr.error(
                                '{{ __('messages.An error occurred. Please try again later') }}',
                                'Error', {
                                    timeOut: 3000
                                });
                        }
                    }
                });
            }
        });





        $('#kt_modal_add_edit_child').on('hidden.bs.modal', function() {

            $('.error').text('');
            $('#my-child-form')[0].reset();

            $('#add_edit_balance_type_id').val('').trigger('change.select2');




        });
        $('#kt_modal_add_edit').on('hidden.bs.modal', function() {
            const form = $('#my-child-form'); // The form you want to set the action for
            $('.error').text('');
            $('#my-form')[0].reset();

            $('#add_edit_balance_type_id').val('').trigger('change.select2');




        });
        $(document).on('click', '.sub_account', function() {
            const parentId = $(this).data('parent_id');
            $('#add_edit_parent_id').val(parentId);
            $('#kt_modal_add_edit_child').modal('show');

            $.ajax({
                url: '{{ route('admin.accounts.getAccountChildCode', ['parentId' => '']) }}' + parentId,
                type: 'GET',
                success: function(response) {
                    $('#add_edit_child_code').val(response.new_code);
                },
                error: function(xhr) {
                    toastr.error(
                        '{{ __('messages.An error occurred while fetching the account code') }}',
                        'Error', {
                            timeOut: 3000
                        });
                }
            });
        });
        $(document).on('click', '.parent_account', function() {


            $.ajax({
                url: '{{ route('admin.accounts.getAccountCode') }}',
                type: 'GET',
                success: function(response) {
                    $('#add_edit_code').val(response.new_code);
                },
                error: function(xhr) {
                    toastr.error(
                        '{{ __('messages.An error occurred while fetching the account code') }}',
                        'Error', {
                            timeOut: 3000
                        });
                }
            });
        });



        // إظهار الـ modal


        document.querySelectorAll('.node-content').forEach(node => {
            node.addEventListener('click', function(e) {
                const parentNode = this.closest('.tree-node');
                const childrenContainer = parentNode.querySelector('.children-container');
                const toggleButton = parentNode.querySelector('.toggle-button');

                if (childrenContainer) {
                    childrenContainer.classList.toggle('expanded');
                    toggleButton.classList.toggle('expanded');

                    if (childrenContainer.classList.contains('expanded')) {
                        childrenContainer.style.display = 'block';
                        childrenContainer.classList.add('expanding');
                        setTimeout(() => {
                            childrenContainer.classList.remove('expanding');
                        }, 400);
                    } else {
                        childrenContainer.style.display = 'none';
                    }
                }
            });
        });
    </script>
@endsection
