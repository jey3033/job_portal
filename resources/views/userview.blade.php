<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data->name }} Profile</title>

    @include('include/head')
    <style>
        /* .select2 {
            padding-right: unset;
            padding-left: unset;
        } */
    </style>
</head>
<body>
    @include('include/navigation')
    
    @if (Auth::user()->backend)
    <div class="card row mx-4" style="margin-top:74px">
        <div class="card-header fs-2">
            <h1 class="float-start">Biodata {{ $data->name }}</h1>
        </div>
        <div class="card-body">
            <form id="biodata-form" enctype="multipart/form-data">
                @csrf
                <div class="text-center">
                    {{-- {{$data}} --}}
                    <div class="mb-3 row">
                        <label for="Image" class="form-label col-2 text-end align-self-center mb-0">Profile</label>
                    </div>
                    <img src="{{ $data->application()->profile_path }}" alt="Profile Photo" class="img-fluid mb-3 prof-photo" id="prof-photo">
                </div>
                <div class="mb-3 row">
                    <label for="name" class="form-label col-2 text-end align-self-center mb-0">Nama Lengkap</label>
                    {{ $data->name }}
                </div>
                <div class="mb-3 row">
                    <label for="email" class="form-label col-2 text-end align-self-center mb-0">Email</label>
                    {{ $data->email }}
                </div>
                <div class="mb-3 row">
                    <label for="user_short_desc" class="form-label col-2 text-end mb-0">Deskripsi Singkat</label>
                    <div class="col ps-0">{{ $data->application()->user_short_desc }}</div>
                </div>
                <div class="mb-3 row">
                  <label for="birthdate" class="form-label col-2 text-end align-self-center mb-0">Tanggal Lahir</label>
                  {{ $data->application()->birthdate }}
                </div>
                <div class="mb-3 row">
                    <label for="religion" class="form-label col-2 text-end align-self-center mb-0">Agama</label>
                    {{ $data->application()->religion }}
                </div>
                <div class="mb-3 row">
                    <label for="race" class="form-label col-2 text-end align-self-center mb-0">Suku</label>
                    {{ $data->application()->race }}
                </div>
                <div class="mb-3 row">
                    <label for="phone_number" class="form-label col-2 text-end align-self-center mb-0">No. Telp</label>
                    <a href="tel:{{ $data->application()->phone_number }}" class="col ps-0">{{ $data->application()->phone_number }}</a>
                </div>
                <div class="mb-3 row">
                    <label for="real_address" class="form-label col-2 text-end align-self-center mb-0">Alamat lengkap domisili</label>
                    {{ $data->application()->real_address }}
                </div>
                <div class="mb-3 row">
                    <label for="address" class="form-label col-2 text-end align-self-center mb-0">Alamat lengkap sesuai ktp</label>
                    {{ $data->application()->address }}
                </div>
                <div class="mb-3 row">
                    @if ($data->application()->facebook)
                        <label for="facebook" class="form-label col-2 text-end align-self-center mb-0"><a href="{{ $data->application()->facebook }}"><i class="fa-brands fa-facebook"></i> Facebook</a></label>
                    @endif
                    @if ($data->application()->twitter)
                        <label for="twitter" class="form-label col-2 text-end align-self-center mb-0"><a href="{{ $data->application()->twitter }}"><i class="fa-brands fa-twitter"></i> Twitter</a></label>
                    @endif
                    @if ($data->application()->linkedin)
                        <label for="instagram" class="form-label col-2 text-end align-self-center mb-0"><a href="{{ $data->application()->instagram }}"><i class="fa-brands fa-instagram"></i> Instagram</a></label>
                    @endif
                    @if ($data->application()->linkedin)
                        <label for="linkedin" class="form-label col-2 text-end align-self-center mb-0"> <a href="{{ $data->application()->linkedin }}" target="_blank"><i class="fa-brands fa-linkedin"></i> Linkedin</a></label>
                    @endif
                </div>
            </form>
        </div>
        <div class="card-footer text-muted row">
            <div class="mb-3">
                <button type="button" id="pick" class="btn btn-success">Select as Candidate</button>
            </div>
            <div class="mb-3">
                <button type="button" id="reject" class="btn btn-danger">Reject</button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#reject').click(function (e) { 
                e.preventDefault();
                swal.fire({
                    icon: 'question',
                    text: 'apakah anda yakin menolak kandidat ini ?',
                    showCancelButton: true,
                    confirmButtonText: "Ya",
                    cancelButtonText: "Tidak"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: `/application/reject/{{ $job->id }}/{{$data->id}}`,
                            dataType: "dataType",
                            success: function (response) {
                                
                            }
                        });
                    }
                })
            });
        });
    </script>
    @endif
</body>
</html>