n<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Job</title>

    @include('include/head')
    <style>
        .splide__pagination {
            display: none;
        }
        .chartjs-render-monitor {
            max-height: 500px;
        }
    </style>
</head>
<body>
    @include('include/navigation')

    <div id="all-job" class="card row g-2 mx-4" style="margin-top:74px">
        <div class="card-header fs-2">
            <h1 class="float-start">New Jobs</h1>
        </div>
        <div class="card-body">
            <form action="" id="new-job">
                @csrf
                <div class="mb-3">
                    <label for="job-name" class="form-label">Nama Pekerjaan</label>
                    <input type="text" class="form-control" name="jobname" id="job-name" placeholder="Nama Pekerjaan">
                </div>
                <div class="mb-3">
                    <label for="job-description" class="form-label">Deskripsi Pekerjaan</label>
                    <textarea class="form-control summernote" name="jobdesc" id="job-description" rows="3" placeholder="Jelaskan ruang lingkup pekerjaan ini">
                    </textarea>
                </div>
                <div class="mb-3">
                    <label for="job-qualification" class="form-label">Syarat Kualifikasi</label>
                    <textarea class="form-control summernote" name="jobqual" id="job-qualification" rows="3" placeholder="Sebutkan persyaratan yang diperlukan untuk pekerjaan ini">
                    </textarea>
                </div>
                <button type="button" class="btn btn-outline-primary" id="save-btn">Simpan</button>
            </form>
        </div>
    </div>
    @include('include/footer')
    <script>

        $('#save-btn').click(function (e) { 
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "/job/store",
                data: $('#new-job').serializeArray(),
                success: function (response) {
                    window.location = "/job";
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
    </script>
</body>
</html>