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
                        <div class="card-header">Forgot Password</div>
                        <div class="card-body">
                            <div class="flash-message">
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if (Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} </p>
                                @endif
                                @endforeach
                            </div>

                            {!! Form::open(array('route' => ['admin.forgotPassword'],'id' => 'forgotPassword')) !!}

                            <div class="form-group">
                                {{ Form::text('email',null, array('class' => 'form-control required','id' => 'email','placeholder' => 'Email','maxlength' => 100)) }}
                            </div>

                            <!-- /.box-body -->
                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="button" id="forgotPassword-form" class="btn btn-primary btn-block btn-flat login_btn">Submit</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                            <a href="{{\URL::route('admin.login')}}">Login</a>

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
        $("#forgotPassword-form").click(function(e) {

            var token = $("input[name='_token']").val();

            var FieldTab1elements = $("#forgotPassword .required");
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

            var email = $.trim($('#email').val());
            if (emailCheck(email) == false) {
                if ($("#email").parent().next(".errorMessage").length == 0) {
                    $("#email").next(".errorMessage").remove();
                    $("#email").addClass('errorClass');
                    $("#email").after("<div class='errorMessage'><?php echo "Please enter proper email address"; ?></div>");
                    $('#email').focus();
                }
                return false;
            }
            $.ajax({
                type: "post",
                url: "{{\URL::route('admin.checkEmail')}}",
                data: {
                    _token: token,
                    email: email
                },
                success: function(data) {
                    if (data.success == false) {
                        if ($("#email").parent().next(".errorMessage").length == 0) {
                            $("#email").next(".errorMessage").remove();
                            $("#email").addClass('errorClass');
                            $("#email").after("<div class='errorMessage'><?php echo "The specified email id deos not exist"; ?></div>");
                            $('#email').focus();
                        }
                        e.preventDefault(); // prevent form from POST to server                 
                    } else {
                        $("#forgotPassword").submit();
                    }
                }
            });
        });
    </script>
</body>

</html>