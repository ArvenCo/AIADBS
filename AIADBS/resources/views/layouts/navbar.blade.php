    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">Home</a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li> -->
        </ul>
        
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a  data-bs-toggle="modal" data-bs-target="#modalAccount" class="dropdown-item" href="#"  >
                            <i class="fas fa-key"></i>
                            {{ __('Change Password') }}
                        </a>
                            
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
            <!-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
            </a> -->
        </ul>
    </nav>
    <div >
        <div class="modal fade" id="modalAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content ">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password <i class="fas fa-key"></i></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="update-form">
                        
                        <div class="form-group row d-flex justify-content-center" >
                            <label for="email" class="col-form-label col-sm-4 text-end">Username</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}">
                                <span class="form-text text-muted" id="email-error"></span>
                            </div>
                        </div>
                        
                        <div class="form-group row d-flex justify-content-end">
                           
                            <div class="col-sm-4">
                                <div class="form-check ">
                                    <input type="checkbox" class="form-check-input" name="change-pass" id="change-pass">
                                    <label for="change-pass" class="form-check-label">Check to change password</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row d-flex justify-content-center">
                            <label for="password" class="col-sm-4 col-form-label text-end">New Password</label>
                            <div class="col-sm-7">
                                <div class="input-group">
                                    <input type="password" class="form-control"  name="password" id="password">
                                    <button class="input-group-text rounded-right text-dark bg-white lin" id="show-button">
                                        <i class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                                <span class="form-text text-muted" id="password-error"></span>
                            </div>
                        </div>

                        <div class="form-group row d-flex justify-content-center" >
                            <label for="password-confirmation" class="col-form-label col-sm-4 text-end">Confirm Password</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="password_confirmation" id="password-confirmation">
                                <span class="form-text text-muted" id="confirmation-error"></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-primary"  onclick="changepassword();">Update</button> 
                    
                </div>
                </div>
            </div>
        </div>
    </div>
    
    @section('layout-nav-script')
    @parent
        <script>

            function changepassword(){
                
                $.ajax({
                        type: "post",
                        url: "/update-account/{{ Auth::user()->id }}",
                        data: $('#update-form').serialize(),
                        dataType:"json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            console.log(data.key);
                            $.each(data, function (key, value) { 
                                Toast.fire({
                                    icon: key,
                                    title: value
                                });
                            });
                            
                            $('#password').val('');
                            $('input[name="password_confirmation"]').val('');
                           
                        }
                        
                    });
                    
            }

            function passwordValidate(password) {
                var errorMessage = "";
                if (password.length < 8) {
                    errorMessage = "Password must be at least 8 characters long.";
                } 
                // else if (!/[A-Z]/.test(password)) {
                //     errorMessage = "Password must contain at least one uppercase letter.";
                // } else if (!/[a-z]/.test(password)) {
                //     errorMessage = "Password must contain at least one lowercase letter.";
                // }
                
                if (errorMessage) { 
                    return errorMessage;
                }else{
                    return "";
                }


            }


            
            $(document).ready(function () {
            
                
                $('#show-button').on('mousedown', function () {
                    $('#password').attr('type', 'text');
                    $('.input-group-text>i').attr('class', 'fas fa-eye');
                }).on('mouseup mouseleave', function () {
                    $('#password').attr('type', 'password');
                    $('.input-group-text>i').attr('class', 'fas fa-eye-slash');
                });
                
                $('#password').on('input', function () {
                    $('#password-error').text(passwordValidate(this.value));
                });
                $('#password-confirmation, #password').on('input blur', function () {
                    
                    if ($('#password-confirmation').val() != $('#password').val()){
                        $('#confirmation-error').text('The password does not match.');
                    }else{
                        $('#confirmation-error').text('Password is match.');
                    }
                });
                
                
                $('#update-form').submit(function (e) { 
                    e.preventDefault();
                    
                });
                
                $('#password').prop('disabled', true);
                $('#password-confirmation').prop('disabled', true);
                
                $('#change-pass').on('change', function () {
                    var disable = this.checked;
                    if (disable){
                        $('#password').prop('disabled', false);
                        $('#password-confirmation').prop('disabled', false);

                    }else{
                        $('#password').prop('disabled', true);
                        $('#password-confirmation').prop('disabled', true);

                    }
                });
                
            });


        </script>
    @endsection