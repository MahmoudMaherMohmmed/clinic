

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Template</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <!--base css styles-->
        <link rel="stylesheet" href="{{url('assets/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/font-awesome/css/font-awesome.min.css')}}">

        <!--page specific css styles-->

        <!--flaty css styles-->
        <link rel="stylesheet" href="{{url('css/flaty.css')}}">
        <link rel="stylesheet" href="{{url('css/flaty-responsive.css')}}">

        <link rel="shortcut icon" href="img/favicon.png">
    </head>
    <body class="login-page">

        <!-- BEGIN Main Content -->
        <div class="login-wrapper">

            {{-- {{ dd(Session::has('success')) }} --}}
            <!-- BEGIN Login Form -->
                {!! Form::open(['url'=>'password/email']) !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <h3>Reset account password</h3>
                    @include('partial.flash')
                    @include('errors')
                    <hr/>
                    <div class="form-group">
                        <div class="controls">
                            {!! Form::email("email",old('email') ,['class'=>'form-control','placeholder'=>'Email']) !!}<br>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                            {!! Form::submit('Send reset link',['class'=>'btn btn-primary form-control']) !!}
                        </div>
                    </div>
                    <hr/>
                {!! Form::close() !!}
            <!-- END Login Form -->

        </div>
        <!-- END Main Content -->


        <!--basic scripts-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

        <script>window.jQuery || document.write('<script src="{{url('assets/jquery/jquery-2.1.4.min.js')}}"><\/script>')</script>
        <script src="{{url('assets/bootstrap/js/bootstrap.min.js')}}"></script>

        <script type="text/javascript">
            function goToForm(form)
            {
                $('.login-wrapper > form:visible').fadeOut(500, function(){
                    $('#form-' + form).fadeIn(500);
                });
            }
            $(function() {
                $('.goto-login').click(function(){
                    goToForm('login');
                });
                $('.goto-forgot').click(function(){
                    goToForm('forgot');
                });
                $('.goto-register').click(function(){
                    goToForm('register');
                });
            });
        </script>
    </body>
</html>
