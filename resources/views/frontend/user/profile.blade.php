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
    </style>
</head>

<body>
    <main class="signup-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Profile</div>
                        <div class="card-body">
                            <div id="loader" class="loader" style="display:none"></div>
                            <form id="profileForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6" style="text-align:right">

                                        @if($user->profile_image!='' && file_exists('uploads/users/profile_image/'.$user->profile_image))
                                        <img id="thumbnil" style="width:75px;height:75px;object-fit: cover; margin-top:10px;border-radius: 50%;" src="{{ asset('uploads/users/profile_image/'.$user->profile_image) }}" alt="image" />
                                        @else
                                        <img id="thumbnil" style="width:75px;height:75px;object-fit: cover; margin-top:10px;border-radius: 50%;" src="{{ asset('uploads/users/profile_image/default_user.png') }}" alt="imageww" />
                                        @endif
                                    </div>
                                    <div class="col-md-6" style="text-align:right">
                                        <a href="{{\URL::route('user.editprofile')}}" class="btn btn-default btn-flat red_button">
                                            <button type="button" class="btn btn-primary">
                                                Edit 
                                            </button>
                                        </a>
                                        @if($user->added_by==0)
                                        <a href="{{\URL::route('user.addUser')}}" class="btn btn-default btn-flat red_button">
                                            <button type="button" class="btn btn-primary">
                                                Add User 
                                            </button>
                                        </a>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right" style="font-weight:600">Name : </label>
                                    <div class="col-md-6" style="padding-top:7px">
                                        {{ $user->name }}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right" style="font-weight:600">E-Mail Address :</label>
                                    <div class="col-md-6" style="padding-top:7px">
                                        {{ $user->email }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="dob" class="col-md-4 col-form-label text-md-right" style="font-weight:600">Date of Birth :</label>
                                    <div class="col-md-6" style="padding-top:7px">
                                        {{ date('d/m/Y', strtotime($user->dob)) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-md-4 col-form-label text-md-right" style="font-weight:600">Phone Number</label>
                                    <div class="col-md-6" style="padding-top:7px">
                                        {{ $user->phone_number }}
                                    </div>
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