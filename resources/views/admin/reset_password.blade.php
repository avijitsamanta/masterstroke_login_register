<!DOCTYPE html>
<html>

<head>
    <title>Masterstroke</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style type="text/css">
        .login-form {
            padding-top: 5.5rem;
        }
    </style>
</head>

<body>
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Reset Password</div>
                        <div class="card-body">
                            <div class="flash-message">
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if (Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} </p>
                                @endif
                                @endforeach
                            </div>

                            @if($flag == 'N')
                            <div class="input-wrapper">
                                <p> This link is expired.<a href="{!! \URL::route('admin.forgotPassword') !!}">Click here</a> to try again.</p>
                            </div>
                            @else
                            {!! Form::open(array('route' => ['admin.updatePassword'],'id' => 'reset-password')) !!}
                            {{ Form::hidden('id', $id, array('id' => 'id')) }}
                            {{ Form::hidden('user_id', $user_id, array('id' => 'user_id')) }}

                            <div class="form-group">
                                {{ Form::text('email',$email, array('class' => 'form-control required','id' => 'email','placeholder' => 'Email','readonly')) }}
                            </div>
                            <div class="form-group">
                                {!! Form::input('password', 'password', '', array('id' => 'password', 'placeholder' => 'Password', 'class' => 'form-control required')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::input('password', 'confirm_password', '', array('id' => 'confirm_password', 'placeholder' => 'Confirm Password', 'class' => 'form-control required')) !!}
                            </div>

                            <!-- /.box-body -->
                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="button" id="resetPassword-form" class="btn btn-primary btn-block btn-flat login_btn">Submit</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/common.js')}}"></script>

    <script type="text/javascript">
        var base_url = '{{url(' ')}}';
        $("#resetPassword-form").click(function(e) {

            var FieldTab1elements = $("#reset-password .required");
            for (i = 0; i < FieldTab1elements.length; i++) {
                var fieldId = $(FieldTab1elements[i]).attr('id');
                if ($.trim($('#' + fieldId).val()) == "") {
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
            var password = $.trim($('#password').val());
            var confirmPassword = $.trim($('#confirm_password').val());
            
            $("#password").next(".errorMessage").remove();
            if (password != confirmPassword) {              
                if ($("#confirm_password").parent().next(".errorMessage").length == 0) {
                    $("#confirm_password").next(".errorMessage").remove();
                    $("#confirm_password").addClass('errorClass');
                    $("#confirm_password").after("<div class='errorMessage'><?php echo "Confirm password must be equal to password"; ?></div>");
                    $('#confirm_password').focus();
                    e.preventDefault(); // prevent form from POST to server  
                }
            }else if(password.length < 6){
                $("#confirm_password").next(".errorMessage").remove();
                $("#confirm_password").addClass('errorClass');
                $("#confirm_password").after("<div class='errorMessage'><?php echo "The password must be at least 6 characters."; ?></div>");
                $('#confirm_password').focus();
                e.preventDefault(); // prevent form from POST to server  
            }
             else {
                $("#confirm_password").next(".errorMessage").remove();
                $("#reset-password").submit();
            }
        });

    </script>
</body>

</html>