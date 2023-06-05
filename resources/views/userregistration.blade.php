<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Portal Registration</title>

    @include('include/head')
</head>
<body>
    <div style="height: 100vh" class="container-fluid d-flex justify-content-center align-items-center bg-info bg-gradient">
        <div class="card w-25">
            <div class="card-body">
                <h4 class="card-title">User Registration</h4>
                <hr>
                <form method="post" id="login-form">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Pencari Kerja">
                    </div>
                    <div class="form-group">
                        <label for="ktp">No KTP</label>
                        <input type="number" class="form-control" name="ktp" id="ktp" placeholder="No KTP">
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" class="form-control" name="email" id="email" placeholder="Email eg. johndoe@yopmail.com">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="confpassword">Ulangi Password</label>
                        <input type="password" class="form-control" id="confpassword" placeholder="Ulangi Password">
                    </div>
                    <div class="mt-4 text-center">
                        <button id="login-submit" type="button" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#login-submit').click(function (e) { 
            e.preventDefault();
            if ($('#password').val() == $('#confpassword').val()) {
                $.ajax({
                    type: "post",
                    url: "/user/store",
                    data: $('#login-form').serializeArray(),
                    statusCode: {
                        200: function (response) {
                            // console.log(response);
                            Swal.fire({
                                icon: 'success',
                                text: response,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = "/";
                                }
                            })
                        },
                        422: function (response) {
                            console.log(response);
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    text: 'Harap masukan password yang sama pada ulangi password untuk konfirmasi'
                });
            }
        });
    </script>
    @include('include/footer')
</body>
</html>