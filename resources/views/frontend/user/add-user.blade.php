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
                        <div class="card-header">Add User</div>
                        <div class="card-body">
                            <div id="loader" class="loader" style="display:none"></div>
                            <form id="userForm" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                    <div class="col-md-6">
                                        <input id="name" class="form-control required" name="name" type="text" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email" class="form-control required" name="email" autofocus value={{ old('email') }}>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="dob" class="col-md-4 col-form-label text-md-right">Date of Birth</label>
                                    <div class="col-md-6">
                                        <input type="date" id="dob" class="form-control required" name="dob" autofocus value="{{ old('dob') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-md-4 col-form-label text-md-right">Phone Number</label>
                                    <div class="col-md-6">
                                        <input type="text" id="phone_number" class="form-control required" name="phone_number" value={{ old('phone_number') }}>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control required" name="password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="confirm_password" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="confirm_password" class="form-control required" name="confirm_password" >

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="profile_image" class="col-md-4 col-form-label text-md-right">Profile image</label>
                                    <div class="col-md-6">
                                        <input type="file" name="profile_image" accept="image/*" onchange="profileImage(this)" />

                                        <img id="thumbnil" style="width:75px;height:75px;object-fit: cover; margin-top:10px;border-radius: 50%;" src="{{ asset('uploads/users/profile_image/default_user.png') }}" alt="imageww" />

                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
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

        $('#userForm').submit(function(e) {
            var token = $("input[name='_token']").val();
            $('#loader').show();
            e.preventDefault(); // Prevent the form from submitting normally
            //var formData = $(this).serialize(); // Serialize the form data
            var formData = new FormData(this);
            var email = $.trim($('#email').val());
            var password = $.trim($('#password').val());
            var confirm_password = $.trim($('#confirm_password').val());

            var FieldTab1elements = $("#userForm .required");
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
            if (emailCheck(email) == false) {
                $('#loader').hide();
                if ($("#email").parent().next(".errorMessage").length == 0) {
                    $("#email").next(".errorMessage").remove();
                    $("#email").addClass('errorClass');
                    $("#email").after("<div class='errorMessage'><?php echo "Please enter proper email address"; ?></div>");
                    $('#email').focus();
                }
                return false;
            }

            var phoneres = checkPhoneNumber($('#phone_number').val());
            var emailres = checkDuplicateEmail(email);
            var pwdres = checkpassword(password, confirm_password);
            if (phoneres == 0 && emailres == 0 && pwdres == 0) {

                $.ajax({
                    url: "{{ route('user.saveUser') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#loader').hide();
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true
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
                        userType : 'new_user',
                    },
                    success: function(data) {
                        if (data.success == true) {
                            $('#loader').hide();
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

        //==Check Duplicate Email===
        function checkDuplicateEmail(email) {
            var rtn = 0;
            var token = $("input[name='_token']").val();
            $.ajax({
                type: "post",
                async: false,
                dataType: "json",
                url: "{{\URL::route('user.checkUserEmail')}}",
                data: {
                    _token: token,
                    email: email
                },
                success: function(data) {
                    if (data.success == true) {
                        $('#loader').hide();
                        if ($("#email").parent().next(".errorMessage").length == 0) {
                            $("#email").next(".errorMessage").remove();
                            $("#email").addClass('errorClass');
                            $("#email").after("<div class='errorMessage'><?php echo "The specified Email address already exist"; ?></div>");
                            $('#email').focus();
                        }
                        //e.preventDefault(); // prevent form from POST to server  
                        rtn = 1;
                    }
                }
            });
            return rtn;
        }

        //Check Password
        function checkpassword(password, confirm_password) {
            var rtn = 0;
            if (password.length < 6) {
                rtn=1;
                $('#loader').hide();
                if ($("#password").parent().next(".errorMessage").length == 0) {
                    $("#password").next(".errorMessage").remove();
                    $("#password").addClass('errorClass');
                    $("#password").after("<div class='errorMessage'><?php echo "The password must be at least 6 characters."; ?></div>");
                    $('#password').focus();
                }
            }
            if (password!=confirm_password) {
                rtn=1;
                $('#loader').hide();
                if ($("#confirm_password").parent().next(".errorMessage").length == 0) {
                    $("#confirm_password").next(".errorMessage").remove();
                    $("#confirm_password").addClass('errorClass');
                    $("#confirm_password").after("<div class='errorMessage'><?php echo "The password confirmation does not match."; ?></div>");
                    $('#confirm_password').focus();
                }
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