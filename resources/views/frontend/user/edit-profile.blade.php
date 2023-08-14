<!DOCTYPE html>
<html>

<head>
    <title>Masterstroke</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/toastr.css')}}">    
    <style type="text/css">
        .signup-form {
            padding-top: 5.5rem;
        }

        .errorMessage {
            color: red;
        }

        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 2s linear infinite;
            margin: 20px auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <main class="signup-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edit Profile</div>
                        <div class="card-body">                            
                            <div id="loader" class="loader" style="display:none"></div>
                            <form id="profileForm" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                    <div class="col-md-6">
                                        <input id="name" class="form-control required" name="name" type="text" value="{{ $user->name }}">
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email" class="form-control required" name="email" autofocus value={{ $user->email }} readonly>
                                    </div>
                                </div>     
                                <div class="form-group row">
                                    <label for="dob" class="col-md-4 col-form-label text-md-right">Date of Birth</label>
                                    <div class="col-md-6">
                                        <input type="date" id="dob" class="form-control required" name="dob" autofocus value='{{ $user->dob }}' >
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="phone" class="col-md-4 col-form-label text-md-right">Phone Number</label>
                                    <div class="col-md-6">
                                        <input type="text" id="phone_number" class="form-control required" name="phone_number" value={{ $user->phone_number }}>
                                        @if ($errors->has('phone_number'))
                                        <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="profile_image" class="col-md-4 col-form-label text-md-right">Profile image</label>
                                    <div class="col-md-6">
                                        <input type="file" name="profile_image" accept="image/*" onchange="profileImage(this)" />
                                        @if($user->profile_image!='' && file_exists('uploads/users/profile_image/'.$user->profile_image))
                                        <img id="thumbnil" style="width:75px;height:75px;object-fit: cover; margin-top:10px;border-radius: 50%;" src="{{ asset('uploads/users/profile_image/'.$user->profile_image) }}" alt="image" />
                                        @else
                                        <img id="thumbnil" style="width:75px;height:75px;object-fit: cover; margin-top:10px;border-radius: 50%;" src="{{ asset('uploads/users/profile_image/default_user.png') }}" alt="imageww" />
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
   
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/common.js')}}"></script>
<script src="{{asset('js/toastr.min.js')}}"></script>
<script>
    $(document).ready(function() {
       
        $('#profileForm').submit(function(e) {
            var token = $("input[name='_token']").val();
            $('#loader').show();
            e.preventDefault(); // Prevent the form from submitting normally
            //var formData = $(this).serialize(); // Serialize the form data
            var formData = new FormData(this);
            var FieldTab1elements = $("#profileForm .required");
            for (i = 0; i < FieldTab1elements.length; i++) {
                var fieldId = $(FieldTab1elements[i]).attr('id');
                if ($.trim($('#' + fieldId).val()) == "") {
                    $('#loader').hide();
                    $('#' + fieldId).next('.errorMessage').remove();
                    $('#' + fieldId).addClass('errorClass');
                    $('#' + fieldId).after('<div class="errorMessage"><?php echo "Please fill the field"; ?></div>');
                    $('#' + fieldId).focus();
                    return false;
                } else {
                    $('#' + fieldId).next('.errorMessage').remove();
                    $('#' + fieldId).removeClass('errorClass');
                }
            }

            var phoneres = checkPhoneNumber($('#phone_number').val());
            if (phoneres == 0) {               

                $.ajax({
                    url: "{{ route('user.updateProfile') }}",
                    type: "POST",
                    data:  formData,
                    processData: false,
                    contentType: false,   
                    success: function(response) {
                        $('#loader').hide();
                        toastr.options= 
                        {
                            "closeButton":true,
                            "progressBar":true
                        }
                        toastr.success(response.message);
                        //$('#success-message').text(response.message);
                        console.log(response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });

        function checkPhoneNumber(phone) {
            var rtn = 0;
            var token = $("input[name='_token']").val();
            var phoneNumberPattern = /^(\+91[\-\s]?)?[0]?(91)?[789]\d{9}$/;
            // var phoneNumberPattern = /^\d{10}$/;
            if (!phoneNumberPattern.test(phone)) {
                $('#loader').hide();
                if ($("#phone_number").parent().next(".errorMessage").length == 0) {
                    $("#phone_number").next(".errorMessage").remove();
                    $("#phone_number").addClass('errorClass');
                    $("#phone_number").after("<div class='errorMessage'><?php echo "Please Enter Valid Phone number"; ?></div>");
                    $('#phone_number').focus();
                }
                rtn = 1;
            } else {
                $.ajax({
                    type: "post",
                    async: false,
                    dataType: "json",
                    url: "{{\URL::route('user.checkPhoneNumber')}}",
                    data: {
                        _token: token,
                        phone: phone,
                        userType : 'main_user',

                    },
                    success: function(data) {
                        $('#loader').hide();
                        if (data.success == true) {
                            if ($("#phone_number").parent().next(".errorMessage").length == 0) {
                                $("#phone_number").next(".errorMessage").remove();
                                $("#phone_number").addClass('errorClass');
                                $("#phone_number").after("<div class='errorMessage'><?php echo "The specified phone number already exist"; ?></div>");
                                $('#phone_number').focus();
                            }
                            //e.preventDefault(); // prevent form from POST to server  
                            rtn = 1;

                        }
                    }
                });
            }
            return rtn;
        }       

    });

    //==Display User Profile Image====
    function profileImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var imageType = /image.*/;
            if (!file.type.match(imageType)) {
                continue;
            }
            var img = document.getElementById("thumbnil");
            img.file = file;
            var reader = new FileReader();
            reader.onload = (function(aImg) {
                return function(e) {
                    aImg.src = e.target.result;
                };
            })(img);
            reader.readAsDataURL(file);
        }
    }

   
</script>