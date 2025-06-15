<script>
     var check_auth=$('.check_auth').val();
        // if(!check_auth){

 $('.unselected').on('click', function() {
        var productId = $(this).data('product-id');

        $.ajax({
            type: 'POST',
            url: '/wishlist/addToWishlistSession/' + productId,
            dataType: 'json',
            data: {
                _token: '{{ csrf_token() }}',

            },
            success: function(response) {
                if (response.success) {
                    // Handle success (maybe update UI)
                    alert('Product added to wishlist!');
                } else {
                    // Handle failure
                    alert('Failed to add product to wishlist.');
                }
            },
            error: function() {
                // Handle error
                alert('Error adding product to wishlist.');
            }
        });


    });

        $('.unselected_compare').on('click', function() {

        var productId = $(this).data('product-id');
var button=$(this);
        $.ajax({
            type: 'POST',
            url: '/compare/addToCompareSession/' + productId,
            dataType: 'json',
            data: {
                _token: '{{ csrf_token() }}',

            },
            success: function(response) {
                if (response.success) {
                    // Handle success (maybe update UI)

button.addClass('selected_compare');
button.removeClass('unselected_compare');
button.find('.fa-code-compare').css('color', 'blueviolet');
$('.count_compare').text(response.count_compare);                } else {
                    // Handle failure
                    alert('Failed to add product to compare.');
                }
            },
            error: function() {
                // Handle error
                alert('Error adding product to wishlist.');
            }
        });

    });

// }
        $(document).on('click', '.unselected_compare',function (event) {

event.preventDefault();
   var productId = $(this).data('product-id');

   $.ajax({
       type: 'POST',
       url: '/wishlist/addToWishlistSession/' + productId,
data: {
           _token: '{{ csrf_token() }}',
           product_id: productId
       },

       success: function(response) {
           if (response.success) {
               // Handle success (maybe update UI)
               // alert('Product added to wishlist!');
           } else {
               // Handle failure
               // alert('Failed to add product to wishlist.');
           }
       },
       error: function() {
           // Handle error
           // alert('Error adding product to wishlist.');
       }
   });

});
$(document).on('click', '.selected,.unselected,.selected_compare,.unselected_compare', function () {
        var check_auth=$('.check_auth').val();
        if(!check_auth){
            window.location.href="{{route('login')}}"
        }
    });


    $(document).on('click', '.selected', function () {
        var button = $(this);
        var productId = $(this).data('product-id');


        $.ajax({
            type: 'POST',
            url: '{{ route('wishlist.remove') }}',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId
            },
            success: function (response) {
                if(response.status==201) {

                    button.removeClass('selected');
                    button.addClass('unselected');
                    button.find('.fa-heart').css('color', 'black');


                    $('.count_wishlist').text(response.count_wishlist);
                }else{
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                }

            },
            error: function (response) {



                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });
    });







    $(document).on('click', '.unselected', function () {
        var button = $(this);

        var productId = $(this).data('product-id');

        $.ajax({
            type: 'POST',
            url: '{{ route('wishlist.add') }}',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId
            },
            success: function (response) {


                if (response.status == 201) {


                    button.addClass('selected');
                    button.removeClass('unselected');
                    button.find('.fa-heart').css('color', 'red');
                    $('.count_wishlist').text(response.count_wishlist);

                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                }

            },
            error: function (error) {
                console.log(error);
            }
        });
    });
    $(document).on('click', '.selected_compare', function () {
        var button = $(this);
        var productId = $(this).data('product-id');



        $.ajax({
            type: 'POST',
            url: '{{ route('compare.delete') }}',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId
            },
            success: function (response) {
                if(response.status==201) {
                    console.log(response);
                    button.removeClass('selected_compare');
                    button.addClass('unselected_compare');
                    button.find('.fa-code-compare').css('color', 'black');
                    $('.count_compare').text(response.count_compare);
                }else{


                }
            },
            error: function (error) {

                var check_auth = $('.check_auth').val();
                if (!check_auth) {
                    //   window.location.href="{{route('login')}}"
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'تسجيل الدخول مطلوب',
                        showConfirmButton: false,
                        timer: 2000
                    });
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            }
        });
    });

    $(document).on('click', '.unselected_compare', function () {
        var button = $(this);

        var productId = $(this).data('product-id');

        $.ajax({
            type: 'POST',
            url: '{{ route('compare.add') }}',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId
            },
            success: function (response){
                if(response.status==201) {
                    button.addClass('selected_compare');
                    button.removeClass('unselected_compare');
                    button.find('.fa-code-compare').css('color', 'blueviolet');
                    $('.count_compare').text(response.count_compare);
                }else{
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            },
            error: function (response) {
                var check_auth=$('.check_auth').val();
                if(!check_auth){
                    //   window.location.href="{{route('login')}}"
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'تسجيل الدخول مطلوب',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });
    });





    $(document).on('click', '.selected_compare,.unselected_compare', function () {
        var check_auth=$('.check_auth').val();
        if(!check_auth){
            window.location.href="{{route('login')}}"
        }
    });

    $(document).on('mouseover','.tag',function (){

        Swal.fire({
            title: 'شراء المنتج',
            text: 'شراء المنتج من خلال تطبيق الموبايل فقط',
            showCancelButton: true,
            confirmButtonText: 'تحميل تطبيق ايفون ',
            preConfirm: function() {
                // Button 1 action
                window.location.href = '{{$ios_url}}';
            },
            cancelButtonText:'تحميل تطبيق الاندرويد'
            ,          didOpen: function() {
                const cancelButton = Swal.getCancelButton();
                cancelButton.addEventListener('click', function() {
                    // Button 2 action
                    window.location.href = '{{$android_url}}';
                });
            }

        });

    });
    $(document).on('click','.floating-chat',function ()
    {
        var check_auth=$('.check_auth').val();
        if(!check_auth){
            window.location.href="{{route('login')}}"
        }

    });



    var element = $('.floating-chat');
    var myStorage = localStorage;

    if (!myStorage.getItem('chatID')) {
        myStorage.setItem('chatID', createUUID());
    }

    setTimeout(function() {
        element.addClass('enter');
    }, 1000);

    element.click(openElement);

    function openElement() {
        var messages = element.find('.messages');
        var textInput = element.find('.text-box');
        element.find('>i').hide();
        element.addClass('expand');
        element.find('.chat').addClass('enter');
        var strLength = textInput.val().length * 2;
        textInput.keydown(onMetaAndEnter).prop("disabled", false).focus();
        element.off('click', openElement);
        element.find('.header button').click(closeElement);
        element.find('#sendMessage').click(sendNewMessage);
        element.find('#sendMessage').click(sendNewMessage);

        messages.scrollTop(messages.prop("scrollHeight"));


    }
    document.addEventListener("DOMContentLoaded", function() {
        // var myInput = document.getElementsByClassName("text-box");
        var myInput = document.getElementById("myInput");
        var element = $('.floating-chat');

        myInput.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
// alert('asasas');
                sendNewMessage()
                // element.find('#sendMessage').click(sendNewMessage);
                console.log("Enter key pressed");
                // Perform desired action here
            }else{
                // alert('asasas');
            }
        });
    });

    function closeElement() {
        element.find('.chat').removeClass('enter').hide();
        element.find('>i').show();
        element.removeClass('expand');
        element.find('.header button').off('click', closeElement);
        element.find('#sendMessage').off('click', sendNewMessage);
        element.find('.text-box').off('keydown', onMetaAndEnter).prop("disabled", true).blur();
        setTimeout(function() {
            element.find('.chat').removeClass('enter').show()
            element.click(openElement);
        }, 500);
    }

    function createUUID() {
        // http://www.ietf.org/rfc/rfc4122.txt
        var s = [];
        var hexDigits = "0123456789abcdef";
        for (var i = 0; i < 36; i++) {
            s[i] = hexDigits.substr(Math.floor(Math.random() * 0x10), 1);
        }
        s[14] = "4"; // bits 12-15 of the time_hi_and_version field to 0010
        s[19] = hexDigits.substr((s[19] & 0x3) | 0x8, 1); // bits 6-7 of the clock_seq_hi_and_reserved to 01
        s[8] = s[13] = s[18] = s[23] = "-";

        var uuid = s.join("");
        return uuid;
    }

    function sendNewMessage() {
        var userInput = $('.text-box');
        var newMessage = userInput.html().replace(/\<div\>|\<br.*?\>/ig, '\n').replace(/\<\/div\>/g, '').trim().replace(/\n/g, '<br>');

        if (!newMessage) return;

        var messagesContainer = $('.messages');

        messagesContainer.append([
            '<li class="self">',
            newMessage,
            '</li>'
        ].join(''));

        // clean out old message
        userInput.html('');
        // focus on input
        userInput.focus();

        messagesContainer.finish().animate({
            scrollTop: messagesContainer.prop("scrollHeight")
        }, 250);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{route('front.chat.store')}}' ,
            type: "POST",
            data: {
                'message':newMessage,
                'token':"{{csrf_token()}}",
            },
            // dataType: 'JSON',
            // contentType: false,
            // cache: false,
            // processData: false,

            success: function( response ) {
                if (response.status==201){
                    // Swal.fire({
                    //     position: 'center',
                    //     icon: 'success',
                    //     title: response.message,
                    //     showConfirmButton: false,
                    //     timer: 1000
                    // });

                }else if (response.status==422){
                    jQuery.each(response.error, function(key, value){
                        $('.'+key+'_error').text(value);
                    });
                }else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response,
                    })
                }
            },
            error: function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response,
                })
            }
        });

    }

    function onMetaAndEnter(event) {
        if ((event.metaKey || event.ctrlKey) && event.keyCode == 13) {
            sendNewMessage();
        }
    }


    window.addEventListener("scroll", function() {
        var chatIcon = document.getElementById("floating-chat");

        if (window.pageYOffset > 100) {
            chatIcon.classList.add("active");
        } else {
            chatIcon.classList.remove("active");
        }
    });

    var url = "{{ route('changeLang') }}";

    $(".changeLang").change(function(){
        window.location.href = url + "?lang="+ $(this).val();
    });

</script>

<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/64fb5e0ca91e863a5c1272f5/1h9queojh';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();


</script>
