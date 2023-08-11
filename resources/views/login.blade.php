<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Portal Login</title>

    @include('include/head')
</head>
<body>
    <div style="height: 100vh" class="container-fluid d-flex justify-content-center align-items-center bg-info bg-gradient">
        <div class="card w-25">
            <div class="card-body">
                <h4 class="card-title">Welcome to Planet Gadget Job</h4>
                <hr>
                <form method="post" id="login-form">
                    @csrf
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" class="form-control" name="email" id="email" placeholder="Email eg. johndoe@yopmail.com">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>

                    <div class="mt-4 text-center">
                        <button id="login-submit" type="button" class="btn btn-primary">Submit</button>
                        <div>
                            Don't have an account, <a href="/register">register here</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#login-submit').click(function (e) { 
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "/auth",
                data: $('#login-form').serializeArray(),
                statusCode: {
                    200: function (response) {
                        // console.log(response);
                        window.location = "/dashboard";
                    },
                    422: function (response) {
                        console.log(response);
                    }
                }
            });
        });
        
        $(function () {
            $('#email').keydown(function (e) { 
                if(e.which == 13) {
                    $('#password').val() ? $('#login-submit').click() : $('#password').focus();
                }
            });

            $('#password').keydown(function (e) { 
                if(e.which == 13) {
                    $('#email').val() ? $('#login-submit').click() : $('#email').focus();
                }
            });
        });
    </script>
    @include('include/footer')
</body>
</html>