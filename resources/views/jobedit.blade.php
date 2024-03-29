<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editing {{ $job_data->title }}</title>

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
            <h1 class="float-start">Edit Jobs</h1>
        </div>
        <div class="card-body">
            <form action="" id="new-job">
                @csrf
                <div class="mb-3">
                    <label for="job-name" class="form-label">Nama Pekerjaan</label>
                    <input type="text" class="form-control" name="jobname" id="job-name" placeholder="Nama Pekerjaan" value="{{ $job_data->title }}">
                </div>
                <div class="mb-3">
                    <label for="job-description" class="form-label">Deskripsi Pekerjaan</label>
                    <textarea class="form-control summernote" name="jobdesc" id="job-description" rows="3" placeholder="Jelaskan ruang lingkup pekerjaan ini">
                        {{ $job_data->description }}
                    </textarea>
                </div>
                <div class="mb-3">
                    <label for="job-qualification" class="form-label">Syarat Kualifikasi</label>
                    <textarea class="form-control summernote" name="jobqual" id="job-qualification" rows="3" placeholder="Sebutkan persyaratan yang diperlukan untuk pekerjaan ini">
                        {{ $job_data->qualification }}
                    </textarea>
                </div>
                <button type="button" class="btn btn-outline-primary" id="save-btn">Simpan</button>
            </form>
        </div>
    </div>
    @include('include/footer')
    <script>
        $('.summernote').summernote({
            inheritPlaceholder: true,
            tooltip: false
        })
        if ($('.note-btn').attr('data-toggle')) {
            $('.note-btn').attr('data-bs-toggle', $('.note-btn').attr('data-toggle'));                    
        }

        $('#save-btn').click(function (e) { 
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "/job/update/{{ $job_data->job_path }}",
                data: $('#new-job').serializeArray(),
                success: function (response) {
                    window.location = "/job";
                }
            });
        });
    </script>
</body>
</html>