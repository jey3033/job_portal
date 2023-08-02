<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Profile</title>

    @include('include/head')
    <style>
        .select2 {
            padding-right: unset;
            padding-left: unset;
        }
    </style>
</head>
<body>
    @include('include/navigation')
    
    @if (!Auth::user()->backend)
    <div class="card row mx-4" style="margin-top:74px">
        <div class="card-header fs-2">
            <h1 class="float-start">Biodata Anda</h1>
        </div>
        <div class="card-body">
            <form id="biodata-form" enctype="multipart/form-data">
                @csrf
                <div class="text-center">
                    {{-- {{$data}} --}}
                    <img src="{{ $data->profile_path }}" alt="Profile Photo" class="img-fluid mb-3 prof-photo d-block" id="prof-photo">
                    <div class="mb-3 row">
                        <label for="Image" class="form-label col-2 text-end align-self-center mb-0">Profile</label>
                        <input class="form-control col-8" name="profile_path" type="file" id="profile_path" onchange="preview()">
                        <button role="button" onclick="clearImage()" class="btn btn-danger col-1 align-self-center mb-0 ms-1"><i class="fa-solid fa-trash-can"></i> Delete</button>
                    </div>
                </div>
                <div class="text-center mb-3">
                    <img id="frame" src="" class="img-fluid mt-3 prev-image" />
                </div>
                <div class="mb-3 row">
                    <label for="user_short_desc" class="form-label col-2 text-end align-self-center mb-0">Deskripsi Singkat</label>
                    <textarea class="form-control col" placeholder="Jelaskan mengenai diri anda secara singkat" name="user_short_desc" id="user_short_desc" rows="3">
                        {{ $data->get_user_short_desc() }}
                    </textarea>
                </div>
                <div class="mb-3 row">
                  <label for="birthdate" class="form-label col-2 text-end align-self-center mb-0">Tanggal Lahir</label>
                  <input type="date" class="form-control col" name="birthdate" id="birthdate" placeholder="tanggal lahir" value="{{ $data->birthdate }}">
                </div>
                <div class="mb-3 row">
                    <label for="religion" class="form-label col-2 text-end align-self-center mb-0">Agama</label>
                    <select name="religion" id="religion" class="form-control select2 col" placeholder="Pilih Agama">
                        <option value=""></option>
                        <option value="Islam"
                        @if ($data->religion == 'Islam')
                            selected
                        @endif 
                        > Islam</option>
                        <option value="Kristen"
                        @if ($data->religion == 'Kristen')
                            selected
                        @endif 
                        > Kristen</option>
                        <option value="Katolik"
                        @if ($data->religion == 'Katolik')
                            selected
                        @endif
                        > Katolik</option>
                        <option value="Hindu"
                        @if ($data->religion == 'Hindu')
                            selected
                        @endif
                        > Hindu</option>
                        <option value="Buddha"
                        @if ($data->religion == 'Buddha')
                            selected
                        @endif
                        > Buddha</option>
                        <option value="Kong Hu Cu"
                        @if ($data->religion == 'Kong Hu Cu')
                            selected
                        @endif
                        > Kong Hu Cu</option>
                    </select>
                </div>
                <div class="mb-3 row">
                    <label for="marital_status" class="form-label col-2 text-end align-self-center mb-0">Status Pernikahan</label>
                    <select name="marital_status" id="marital_status" class="form-control select2  col-4" placeholder="Pilih Status Pernikahan">
                        <option value=""></option>
                        <option value="Lajang"
                        @if ($data->marital_status == 'Lajang')
                            selected
                        @endif 
                        > Lajang</option>
                        <option value="Menikah"
                        @if ($data->marital_status == 'Menikah')
                            selected
                        @endif 
                        > Menikah</option>
                        <option value="Duda"
                        @if ($data->marital_status == 'Duda')
                            selected
                        @endif
                        > Duda</option>
                        <option value="Janda"
                        @if ($data->marital_status == 'Janda')
                            selected
                        @endif
                        > Janda</option>
                    </select>
                    <label for="wedding_date" class="form-label col-2 text-end align-self-center mb-0">Tanggal Menikah</label>
                    <input type="date" class="form-control col" name="wedding_date" id="wedding_date" placeholder="tanggal lahir" value="{{ $data->wedding_date }}">
                </div>
                <div class="mb-3 row">
                    <label for="race" class="form-label col-2 text-end align-self-center mb-0">Suku</label>
                    <input type="text" class="form-control col" name="race" id="race" placeholder="Suku" value="{{ $data->race }}">
                </div>
                <div class="mb-3 row">
                    <label for="phone_number" class="form-label col-2 text-end align-self-center mb-0">No. HP</label>
                    <input type="number" class="col-4 form-control" name="phone_number" id="phone_number" placeholder="No. HP" value="{{ $data->phone_number }}">
                    <label for="residence_phone" class="form-label col-2 text-end align-self-center mb-0">No. Telp Rumah</label>
                    <input type="number" class="col-4 form-control" name="residence_phone" id="residence_phone" placeholder="No. Telp Rumah" value="{{ $data->residence_phone }}">
                </div>
                <div class="mb-3 row">
                    <label for="real_address" class="form-label col-2 text-end align-self-center mb-0">Alamat lengkap domisili</label>
                    <textarea class="form-control col" placeholder="Alamat lengkap domisili" name="real_address" id="real_address" rows="3">
                        {{ $data->real_address }}
                    </textarea>
                </div>
                <div class="mb-3 row">
                    <label for="address" class="form-label col-2 text-end align-self-center mb-0">Alamat lengkap sesuai ktp</label>
                    <textarea class="form-control col" placeholder="Alamat lengkap sesuai ktp" name="address" id="address" rows="3">
                        {{ $data->address }}
                    </textarea>
                </div>
                <div class="mb-3 row">
                    <label for="facebook" class="form-label col-2 text-end align-self-center mb-0">Facebook</label>
                    <input type="text" class="form-control col" name="facebook" id="facebook" placeholder="Alamat Facebook anda" value="{{ $data->facebook }}">
                </div>
                <div class="mb-3 row">
                    <label for="twitter" class="form-label col-2 text-end align-self-center mb-0">Twitter</label>
                    <input type="text" class="form-control col" name="twitter" id="twitter" placeholder="Alamat Twitter anda" value="{{ $data->twitter }}">
                </div>
                <div class="mb-3 row">
                    <label for="instagram" class="form-label col-2 text-end align-self-center mb-0">Instagram</label>
                    <input type="text" class="form-control col" name="instagram" id="instagram" placeholder="Alamat Instagram anda" value="{{ $data->instagram }}">
                </div>
                <div class="mb-3 row">
                    <label for="linkedin" class="form-label col-2 text-end align-self-center mb-0">Linkedin</label>
                    <input type="text" class="form-control col" name="linkedin" id="linkedin" placeholder="Alamat Linkedin Anda" value="{{ $data->linkedin }}">
                </div>
                <div class="mb-3 text-center">
                    <button type="button" class="btn btn-primary" id="save-btn">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    @include('include/footer')
    <script>
        function preview() {
            frame.src = URL.createObjectURL(event.target.files[0]);
            console.log($('#profile_path').val())
        }
        function clearImage() {
            document.getElementById('profile_path').value = null;
            frame.src = "";
        }
    </script>
    <script>
        $(document).ready(function () {
            if ($('#prof-photo').attr('src')) {
                $('#prof-photo').removeClass('d-block');
            }

            // initialize select2
            $('#religion').select2({
                allowClear: true,
                placeholder: "Pilih Agama"
            })
            $('#marital_status').select2({
                allowClear: true,
                minimumResultsForSearch: Infinity,
                placeholder: "Pilih Status Pernikahan"
            })

            $('#save-btn').click(function (e) { 
                e.preventDefault();
                var submitdata = new FormData(document.getElementById('biodata-form'));
                // console.log(submitdata);
                $(`input`).removeClass('is-invalid');
                $(`input`).removeClass('mb-0');
                $.ajax({
                    type: "post",
                    url: "/user/profile/store",
                    processData: false,
                    contentType: false,
                    cache: false,
                    enctype: "multipart/form-data",
                    data: submitdata,
                    success: function (response) {
                        console.log(response);
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown) { 
                        Swal.fire({
                            icon: 'error',
                            text: jqXHR.responseJSON.message
                        }).then((result) => {
                            $.each(jqXHR.responseJSON.errors, function (indexInArray, valueOfElement) { 
                                $(`#${indexInArray}`).addClass('is-invalid');
                                $(`#${indexInArray}`).addClass('mb-0');
                            });
                        })
                    }
                });
            });
        });
    </script>
</body>
</html>