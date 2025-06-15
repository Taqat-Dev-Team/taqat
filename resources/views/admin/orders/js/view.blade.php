<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

<script>


    $(document).on('click','.add_experience',function (e){

        $('#JobContractModal').modal('show');


        $('#exampleModalLabel').text('اضافة عقد عمل')
        $('#my-form').prop('action', '{{route('admin.jobConstrancts.store')}}');


    });
    $(document).on('click','.edit_experience',function (e){

        $('#JobContractModal').modal('show');
        var sallary=$(this).data('sallary');
        var company_name=$(this).data('company_name');
        var date=$(this).data('date');
        var note=$(this).data('note');
        var duration=$(this).data('duration');
        var job_type=$(this).data('job_type');
        var job_construct_id=$(this).data('id');

        $('#my-form').prop('action', '{{route('admin.jobConstrancts.update')}}');

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
            url: "{{route('admin.projects.getIndex')}}",
            type: 'get',
            "data":function(d){
                d.user_id=$('#user_id').val();
            }

        },

        columns: [
            {data:'photo',name:'photo'},
            {data: 'title', name: 'title',searchable: true},
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
            url: "{{route('admin.scientificCerificates.getIndex')}}",
            type: 'get',
            "data":function(d){
                d.user_id=$('#user_id').val();
            },

        },

        columns: [
            {data: 'title', name: 'title',searchable: true},
            {data: 'specialization', name: 'specialization',searchable: true},
            {data: 'country', name: 'country',searchable: true},
            {data: 'graduation_year', name: 'graduation_year',searchable: true},
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
            url: "{{route('admin.trainingCourses.getIndex')}}",
            type: 'get',
            "data":function(d){
                d.user_id=$('#user_id').val();
            }


        },

        columns: [
            {data: 'title', name: 'title',searchable: true},
            {data: 'specialty', name: 'specialty',searchable: true},
            {data: 'location', name: 'location',searchable: true},
            {data: 'start_date', name: 'start_date',searchable: true},
            {data: 'end_date', name: 'end_date',searchable: true},
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
            url: "{{route('admin.workExperiences.getIndex')}}",
            type: 'get',
            "data":function(d){
                d.user_id=$('#user_id').val();
            }

        },

        columns: [
            {data: 'company_name', name: 'company_name',searchable: true},
            {data: 'location', name: 'location',searchable: true},
            {data: 'start_date', name: 'start_date',searchable: true},
            {data: 'end_date', name: 'end_date',searchable: true},
        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
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


             var url=   $('#my-form').attr('action');
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
    </script>
