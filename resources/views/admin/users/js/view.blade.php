<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>
    $(document).on('click', '.sendSms', function() {
        // Optionally, set dynamic values if needed
        var userId = $(this).data('user_id'); // Get dynamic invoice ID
        $('#invoice_user_id').val(userId); // Set invoice ID to the hidden input field

        $('#exemptionModal').modal('show');
    });

    $(document).ready(function() {
        // Handle form submission using AJAX
        $('#exemptionForm').on('submit', function(e) {
            e.preventDefault(); // Prevent normal form submission

            var formData = new FormData(this); // Gather form data

            $.ajax({
                url: $(this).attr('action'), // Get the action URL from the form
                method: 'POST',
                data: formData, // Send the form data
                processData: false, // Don't process the data
                contentType: false, // Don't set content type manually
                success: function(response) {
                    // On success, handle the response
                    if (response.status) {
                        // SweetAlert success message
                        Swal.fire({
                            icon: 'success',
                            title: 'تم إرسال  بنجاح!',
                            text: 'تم ارسال شعار (Sms).',
                            confirmButtonText: 'موافق'
                        });

                        // Close the modal
                        $('#exemptionForm')[0].reset();

                        $('#exemptionModal').modal('hide');
                    } else {
                        // Handle errors with SweetAlert error message
                        Swal.fire({
                            icon: 'error',
                            title: 'حدث خطأ!',
                            text: 'لم يتم تقديم الطلب بنجاح، حاول مرة أخرى.',
                            confirmButtonText: 'موافق'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX error with SweetAlert error message
                    Swal.fire({
                        icon: 'error',
                        title: 'حدث خطأ غير متوقع!',
                        text: 'يرجى المحاولة مرة أخرى لاحقاً.',
                        confirmButtonText: 'موافق'
                    });
                }
            });
        });
    });
    $(document).on('click', '.add_experience', function(e) {

        $('#JobContractModal').modal('show');


        $('#exampleModalLabel').text('اضافة عقد عمل')
        $('#my-form').prop('action', '{{ route('admin.jobConstrancts.store') }}');


    });
    $(document).on('click', '.edit_experience', function(e) {

        $('#JobContractModal').modal('show');
        var sallary = $(this).data('sallary');
        var company_name = $(this).data('company_name');
        var date = $(this).data('date');
        var note = $(this).data('note');
        var duration = $(this).data('duration');
        var job_type = $(this).data('job_type');
        var job_construct_id = $(this).data('id');

        $('#my-form').prop('action', '{{ route('admin.jobConstrancts.update') }}');

        $('#company_name').val(company_name);
        $('#sallary').val(sallary);
        $('.start_at').val(date);
        $('#description').val(note);
        $('#duration').val(duration);
        $(".job_type").val(job_type).change();
        $('#job_construct_id').val(job_construct_id);

    });
    table = $('.project-table').DataTable({
        processing: true,
        serverSide: true,

        searching: false,
        ajax: {
            url: "{{ route('admin.projects.getIndex') }}",
            type: 'get',
            "data": function(d) {
                d.user_id = $('#user_id').val();
            }

        },

        columns: [{
                data: 'photo',
                name: 'photo'
            },
            {
                data: 'title',
                name: 'title',
                searchable: true
            },
        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
        }
    });

    table = $('.scientific-cerificates-table').DataTable({
        processing: true,
        serverSide: true,

        searching: true,
        ajax: {
            url: "{{ route('admin.scientificCerificates.getIndex') }}",
            type: 'get',
            "data": function(d) {
                d.user_id = $('#user_id').val();
            },

        },

        columns: [{
                data: 'title',
                name: 'title',
                searchable: true
            },
            {
                data: 'specialization',
                name: 'specialization',
                searchable: true
            },
            {
                data: 'country',
                name: 'country',
                searchable: true
            },
            {
                data: 'graduation_year',
                name: 'graduation_year',
                searchable: true
            },
        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
        }
    });



    table = $('.training-courses-table').DataTable({
        processing: true,
        serverSide: true,

        searching: true,
        ajax: {
            url: "{{ route('admin.trainingCourses.getIndex') }}",
            type: 'get',
            "data": function(d) {
                d.user_id = $('#user_id').val();
            }


        },

        columns: [{
                data: 'title',
                name: 'title',
                searchable: true
            },
            {
                data: 'specialty',
                name: 'specialty',
                searchable: true
            },
            {
                data: 'location',
                name: 'location',
                searchable: true
            },
            {
                data: 'start_date',
                name: 'start_date',
                searchable: true
            },
            {
                data: 'end_date',
                name: 'end_date',
                searchable: true
            },
        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
        }
    });

    table = $('.work-Experiences-table').DataTable({
        processing: true,
        serverSide: true,

        searching: true,
        ajax: {
            url: "{{ route('admin.workExperiences.getIndex') }}",
            type: 'get',
            "data": function(d) {
                d.user_id = $('#user_id').val();
            }

        },

        columns: [{
                data: 'company_name',
                name: 'company_name',
                searchable: true
            },
            {
                data: 'location',
                name: 'location',
                searchable: true
            },
            {
                data: 'start_date',
                name: 'start_date',
                searchable: true
            },
            {
                data: 'end_date',
                name: 'end_date',
                searchable: true
            },
        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
        }
    });


    $('.orders_table').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true, // Improves speed by deferring the rendering of rows
        ajax: {
            url: "{{ route('admin.orders.getIndex') }}",
            data: function(d) {
                d.user_id = $('#user_id').val();

                d.restaurant_id = $('#restaurant_id').val();
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
                d.status_cd_id = $('#status_cd_id').val();
            },
            cache: true, // Avoid unnecessary repeated requests
        },
        columns: [{


                data: 'logo',
                name: 'logo',
                orderable: true,
                searchable: false
            },
            {




                data: 'user_name',
                name: 'user_name',
                orderable: true,
                searchable: false
            },

            {




                data: 'restaurant_name',
                name: 'restaurant_name',
                orderable: true,
                searchable: false
            },
            {
                data: 'price',
                name: 'price',
                orderable: true,
                searchable: false
            },

            {
                data: 'quantity',
                name: 'quantity',
                orderable: true,
                searchable: false
            },
            {
                data: 'total_price',
                name: 'total_price',
                orderable: true,
                searchable: false
            },
            {
                data: 'date',
                name: 'date',
                orderable: true,
                searchable: false
            },
            {
                data: 'status',
                name: 'status',
                orderable: true,
                searchable: false
            },


            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
        order: [
            [1, 'asc']
        ], // Ensure proper default ordering
        language: {
            loadingRecords: "Please wait - loading...",
        },
        lengthMenu: [10, 25, 50, 100], // Custom page lengths for better UX
    });
    $('.invocie_submit').on('click', function(e) {
        e.preventDefault();
        updateData();
    });




    function updateData() {
        const start_date = $('#start_date').val();
        const end_date = $('#end_date').val();
        const user_id = $('#user_id').val();

        $.ajax({
            url: '{{ route('admin.invoices.getInvoicesData') }}',
            method: 'POST',
            data: {
                start_date: start_date,
                end_date: end_date,
                user_id: user_id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                updateCounters(response.data);
            },
            error: function(response) {
                console.error(response);
            }
        });
    }

    function updateCounters(data) {
        $('#user_count').text("(" + data.user_count + ")");
        $('#total_invoice').text("(" + data.total_invoice + ")");
        $('#total_payment').text("(" + data.total_payment + ")");
        // $('.invoice_table').text()
        $('.invoice_table').DataTable().draw();
    }

    $(document).ready(function() {
        updateData();
    });
    $(document).on('click', '.view', function(e) {
        e.preventDefault();
        var orderId = $(this).data('order_id');

        $.ajax({
            url: '{{ route('admin.orders.show') }}',
            method: 'POST',
            data: {
                order_id: orderId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#orderDetailsModal').modal('show');
                $('#order-details-content').html(response.html);

            },
            error: function() {
                toastr.error('حدث خطأ أثناء تحميل التفاصيل');
            }
        });
    });



    $('.wallet-table').DataTable({
        processing: true,
        serverSide: true,

        searching: false,
        ajax: {
            url: "{{ route('admin.users.getWallet') }}",
            type: 'get',
            "data": function(d) {
                d.user_id = $('#user_id').val();



            },

        },




        columns: [{
                data: 'logo',
                name: 'logo',
                searchable: false,
                orderable: false,

            },




            {
                data: 'amount',
                name: 'amount',
                searchable: true,
                orderable: false,
            },

            {
                data: 'status',
                name: 'status',
                searchable: true,
                orderable: false,

            },


            {
                data: 'date',
                name: 'date',
                searchable: true,
                orderable: false,

            },


            {
                data: 'action',
                name: 'action',
                searchable: true,
                orderable: false,

            },

        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
        }
    });
    $('.invoice_table').DataTable({
        processing: true,
        serverSide: true,

        searching: false,
        ajax: {
            url: "{{ route('admin.invoices.getIndex') }}",
            type: 'get',
            "data": function(d) {
                d.user_id = $('#user_id').val();
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();



            },

        },




        columns: [{
                data: 'photo',
                name: 'photo',
                searchable: false,
                orderable: false,

            },
            {
                data: 'user_name',
                name: 'user_name',

                searchable: true
            },



            {
                data: 'amount',
                name: 'amount',
                searchable: true,
                orderable: false,
            },



            {
                data: 'status',
                name: 'status',
                searchable: true,
                orderable: false,
            },

            {
                data: 'created_at',
                name: 'created_at',
                orderable: true
            },

            {
                data: 'action',
                name: 'action',
                orderable: true
            },

        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
        }
    });



    $('#btnFiterSubmitSearch').click(function(e) {
        e.preventDefault();
        getTotalHours();
        $('.log-table').DataTable().draw(true);
    });


    function getTotalHours() {
        $.ajax({
            url: '{{ route('admin.users.getTotalHours') }}',
            type: 'GET',
            data: {
                user_id: $('#user_id').val(),
                end_date: $('.end_date').val(),
                start_date: $('.start_date').val()
            },
            success: function(response) {
                $('#total_work_hours').text(response.total_hours);
            },
            error: function(response) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'An error occurred',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    }

    getTotalHours();

    $('.export_excel').click(function(e) {
        e.preventDefault();

        $.ajax({
            url: '{{ route('admin.users.exportLog') }}',
            type: 'GET',
            data: {
                user_id: $('#user_id').val(),
                end_date: $('.end_date').val(),
                start_date: $('.start_date').val()
            },
            xhrFields: {
                responseType: 'blob' // Set response type to blob for file download
            },
            success: function(response) {
                // Create a link element to trigger the download
                var blob = new Blob([response], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'logs_export_' + new Date().toISOString().slice(0, 19).replace(/:/g,
                    '-') + '.xlsx';
                link.click();
            },
            error: function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ',
                    text: 'حدث خطأ أثناء تصدير السجل. حاول مرة أخرى لاحقاً.',
                    confirmButtonText: 'موافق'
                });
            }
        });
    });

    $('.log-table').DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        ajax: {
            url: "{{ route('admin.users.getLog') }}",
            type: 'GET',
            data: function(d) {
                d.user_id = $('#user_id').val();
                d.end_date = $('.end_date').val();
                d.start_date = $('.start_date').val();

            },
        },
        columns: [
            // {
            //     data: 'photo',
            //     name: 'photo'
            // },
            // {
            //     data: 'name',
            //     name: 'name',
            //     searchable: true,

            // },
            // {
            //     data: 'mobile',
            //     name: 'mobile',
            //     searchable: true,

            // },


            {
                data: 'date',
                name: 'date'
            },
            {
                data: 'time_in',
                name: 'time_in'
            },
            {
                data: 'time_out',
                name: 'time_out'
            },
            {
                data: 'hours',
                name: 'hours'
            },




        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
        }
    });

    function readURL(input) {
        console.log(input.files);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(".img-preview").attr("src", e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, 'يجيب ان يكون حجم المرفق اقل من 5 ميجا بايت');
    $("form[name='my-form']").validate({
        rules: {

            company_name: {
                required: true
            },
            location: {
                required: true
            },
            job: {
                required: true
            },
            start_date: {
                required: true
            },
            end_date: {
                required: true
            },

            tasks: {
                required: true
            },
            photo: {
                filesize: 5 * 1024 * 1024 // 0.5 MB in bytes
            },






        },
        messages: {
            company_name: {
                required: "اسم المؤسسة مطلوب"
            },
            tasks: {
                required: "المهام مطلوبة"
            },
            location: {
                required: "مكان المؤسسة مطلوب"
            },
            job: {
                required: "المسمى الوظيفي مطلوب"
            },
            start_date: {
                required: "تاريخ البداية مطلوب"
            },
            end_date: {
                required: "تاريخ الانتهاء مطلوب"
            },

            // photo: {
            //     required: "الصورة مطلوبة"
            // },
        },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // var my_form=$('#my-form');
            var data = new FormData(document.getElementById("my-form"));


            var url = $('#my-form').attr('action');
            $("#spinner").show();

            $.ajax({
                url: url,
                type: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    $("#spinner").hide();
                    $('#JobContractModal').hide();

                    $("#my-form")[0].reset();
                    if (response.status) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1000
                        });
                        setTimeout(function() {
                            location.reload();


                        }, 2000);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message
                        });
                    }
                },
                error: function(response) {
                    // Hide the spinner
                    $("#spinner").hide();

                    var errors = response.responseJSON.errors;
                    if (errors) {
                        var errorText = "";
                        $.each(errors, function(key, value) {
                            errorText += value + "\n";
                            $('.' + key).text(value);
                        });
                    }
                }
            });



        }

    });



    $(document).on("click", ".invoice", function(e) {
        e.preventDefault();

        let invoiceId = $(this).data("invoice_id");
        let amount = $(this).data("amount");
        let amountType = $(this).data("amount_type");
        let dueDate = $(this).data("due_date");
        let expirationDate = $(this).data("expiration_date");
        let status = $(this).data("status");

        // Show modal
        $("#invoiceModal").modal("show");

        // Set form values
        $("#invoce_id").val(invoiceId);
        $("#amount").val(amount);
        $("#amout_type").val(amountType).trigger("change"); // Fix ID mismatch
        if (dueDate) {
            $("#due_date").datepicker("setDate", dueDate);
        }
        if (expirationDate) {
            $("#expiration_date").datepicker("setDate", expirationDate);
        }
        $("#status").val(status).trigger("change");
    });


    $("form[name='my-invoice']").validate({
        rules: {

            status: {
                required: true
            },
            amount: {
                required: true

            }

        },
        messages: {

            amount: {
                required: "{{ __('validation.status_required') }}"
            },

        },
        submitHandler: function(form) {
            var $button = $(form).find('button[type="submit"]');
            var $spinner = $button.find('.spinner-border');

            // Show spinner
            $spinner.show();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = new FormData(document.getElementById("my-invoice"));
            $('#spinner').show();
            $('.btn-primary').attr('disabled', true);
            $('.hiden_icon').hide();
            $.ajax({
                url: '{{ route('admin.invoices.update') }}',
                type: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    // Hide spinner
                    $('#spinner').hide();
                    $('.btn-primary').attr('disabled', false);
                    $('.hiden_icon').show();
                    $('.data-table').DataTable().draw(true);
                    $('#invoiceModal').modal('hide')

                    if (response.status) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1000
                        });

                    }

                    $('.invoice_table').DataTable().ajax.reload();
                },
                error: function(response) {
                    // Hide spinner
                    $('#spinner').hide();
                    $('.btn-primary').attr('disabled', false);
                    $('.hiden_icon').show();
                    response.responseJSON;
                    var errors = response.responseJSON.errors;
                    if (errors) {
                        var errorText = "";
                        $.each(errors, function(key, value) {
                            errorText += value + "\n";
                            $('.' + key).text(value);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.responseJSON['message'],
                        });
                    }
                }
            });
        }
    });

    // Wallet edit form validation and AJAX submit
    $("form[name='editWalletForm']").validate({
        rules: {
            amount: {
                required: true,
                number: true,
                min: 0
            },
            status_cd_id: {
                required: true
            },
            attachment: {
                filesize: 5 * 1024 * 1024 // 5 MB in bytes
            }
        },
        messages: {
            amount: {
                required: "{{ __('validation.status_required') }}"
            }
        },
        submitHandler: function(form) {
            var $button = $(form).find('button[type="submit"]');
            var $spinner = $button.find('.spinner-border');
            $spinner.show();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = new FormData(document.getElementById("editWalletForm"));
            $('#spinner').show();
            $('.btn-primary').attr('disabled', true);
            $('.hiden_icon').hide();

            $.ajax({
                url: '{{ route('admin.users.wallet.update') }}',
                type: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    $('#spinner').hide();
                    $('.btn-primary').attr('disabled', false);
                    $('.hiden_icon').show();
                    $('.data-table').DataTable().draw(true);
                    $('#editWalletModal').modal('hide');
                    if (response.status) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                    $('.wallet-table').DataTable().ajax.reload();
                },
                error: function(response) {
                    $('#spinner').hide();
                    $('.btn-primary').attr('disabled', false);
                    $('.hiden_icon').show();
                    var errors = response.responseJSON.errors;
                    if (errors) {
                        $.each(errors, function(key, value) {
                            $('.' + key).text(value);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.responseJSON['message'],
                        });
                    }
                }
            });
        }
    });

    $("form[name='addWalletBalanceForm']").validate({
        rules: {
            amount: {
                required: true,
                number: true,
                min: 0
            },
            photo: {
                extension: "jpg|jpeg|png|pdf",
                filesize: 2 * 1024 * 1024 // 2 MB in bytes
        }
    },
    messages: {
        amount: {
            required: "{{ __('validation.status_required') }}"
        }
    },
    submitHandler: function(form) {
        var $button = $(form).find('button[type="submit"]');
        var $spinner = $button.find('.spinner-border');
        $spinner.show();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var data = new FormData(document.getElementById("addWalletBalanceForm"));
        $('#spinner').show();
        $('.btn-primary').attr('disabled', true);
        $('.hiden_icon').hide();

        $.ajax({
            url: '{{ route('admin.users.wallet.addBalance') }}',
            type: "POST",
            data: data,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                $('#spinner').hide();
                $('.btn-primary').attr('disabled', false);
                $('.hiden_icon').show();
                $('.data-table').DataTable().draw(true);
                $('#addWalletBalanceForm')[0].reset();

                $('#addWalletBalanceModal').modal('hide');

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1000
                    });

                $('.wallet-table').DataTable().ajax.reload();
            },
            error: function(response) {
                $('#spinner').hide();
                $('.btn-primary').attr('disabled', false);
                $('.hiden_icon').show();
                var errors = response.responseJSON.errors;
                if (errors) {
                    $.each(errors, function(key, value) {
                        $('.' + key).text(value);
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.responseJSON['message'],
                    });
                }
            }
        });
    }
    });






    $(document).on('click', '.delete', function(e) {
        e.preventDefault();

        $('#confirmModal').modal('show')
        var name_delete = $(this).attr('name_delete');
        var ids = $(this).attr('id');
        $('#Delete_id').val(ids);
        $('#Name_Delete').val(name_delete);

    });

    $(document).on('click', '.submit', function(e) {
        e.preventDefault();

        $('#confirmModal').modal('hide');

        var ids = $('#Delete_id').val();
        $.ajax({
            url: '{{ route('admin.invoices.delete') }}',
            method: 'POST',
            data: {
                "id": ids,
                "_token": "{{ csrf_token() }}",
            },
            success: function(data) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 3000
                });

                $('.data-table').DataTable().ajax.reload();




            },
            error: function(data) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 2000
                });
                $('.data-table').DataTable().ajax.reload();

            }


        });




    });
    $(document).on('click', '.edit_wallet', function(e) {
        e.preventDefault();

        // Get data attributes from the clicked element
        var walletId = $(this).data('wallet_id');
        var amount = $(this).data('amount');
        var attachment = $(this).data('attachment');
        var status = $(this).data('status');

        // Show the edit wallet modal
        $('#editWalletModal').modal('show');

        // Set the form fields with the wallet data
        $('#edit_wallet_id').val(walletId);
        $('#edit_wallet_amount').val(amount);

        // Set the status select
        $('#edit_wallet_status').val(status).trigger('change');

        // Show current attachment if exists
        if (attachment) {
            $('#edit_wallet_attachment_preview').html(
                `${attachment}`
            );
        } else {
            $('#edit_wallet_attachment_preview').html('');
        }
        // Clear file input
        $('#edit_wallet_attachment').val('');
    });
</script>
