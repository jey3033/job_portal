<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $job_data->title }}</title>

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

    <div id="all-job" class="card row g-2 mx-4 mb-3" style="margin-top:74px">
        <div class="card-header fs-2">
            <h1 class="float-start">{{ $job_data->title }}</h1>
            @if ($check)
            <span class="badge float-end bg-success">Applied</span>
            @endif
            @if (Auth::user()->backend)
                <a class="btn btn-primary me-1 float-end" href="/job/edit/{{ $job_data->job_path }}" role="button"><i class="fa-solid fa-pen-clip"></i></a>
                @if ($job_data->active == 0)
                    <button type="button" class="btn btn-success me-1 float-end" id="btn-done"><i class="fa-solid fa-check"></i></button>
                    <button type="button" class="btn btn-danger me-1 float-end" id="btn-close"><i class="fa-solid fa-door-closed"></i></button>
                @else
                    <button type="button" class="btn btn-success me-1 float-end" id="btn-open"><i class="fa-solid fa-door-open"></i></button>
                @endif
            @endif
        </div>
        <div class="card-body">
            {!! $job_data->description !!}
            <hr>
            {!! $job_data->qualification !!}
        </div>
        @if (!Auth::user()->backend && !$check)
        <div class="card-footer text-muted">
            <button type="button" class="btn btn-primary" id="btn-apply">Apply</button>
        </div>
        @elseif (!Auth::user()->backend && $check)
        <div class="card-footer text-muted">
            <button type="button" disabled class="btn btn-primary" id="btn-apply">You already applied for this job</button>
        </div>
        @endif
    </div>
    
    @if (Auth::user()->backend)
    <div class="card row mx-4">
        <div class="card-header fs-2">
            <h1 class="float-start">Pendaftar</h1>
        </div>
        <div class="card-body">
            @foreach ($job_data->applier() as $item)
                <div class="accordion" id="row-applier{{ $item->id }}">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="header{{ $item->id }}">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#biodata{{ $item->id }}" aria-expanded="false" aria-controls="biodata{{ $item->id }}">
                        <img src="{{ $item->application()->profile_path }}" class="small-icon me-2"> {{ $item->name }}
                      </button>
                    </h2>
                    <div id="biodata{{ $item->id }}" class="accordion-collapse collapse" aria-labelledby="header{{ $item->id }}" data-bs-parent="#row-applier{{ $item->id }}">
                      <div class="accordion-body">
                        {{ $item->application()->user_short_desc }}<br>
                        <a href="/user/{{ substr($item->email, 0, strpos($item->email, '@')) }}/job/{{ $job_data->id }}">See Profile</a>
                      </div>
                    </div>
                  </div>
                  
                </div>
            @endforeach
        </div>
    </div>
    @endif

    @include('include/footer')

    <script>
        $(document).ready(function () {
            $('#btn-done').click(function (e) { 
                e.preventDefault();
                $.ajax({
                    type: "get",
                    url: "/job/done/{{ $job_data->job_path }}",
                    success: function (response) {
                        location.reload();
                    }
                });
            });
            $('#btn-close').click(function (e) { 
                e.preventDefault();
                $.ajax({
                    type: "get",
                    url: "/job/deactivate/{{ $job_data->job_path }}",
                    success: function (response) {
                        location.reload();
                    }
                });
            });
            $('#btn-open').click(function (e) { 
                e.preventDefault();
                $.ajax({
                    type: "get",
                    url: "/job/activate/{{ $job_data->job_path }}",
                    success: function (response) {
                        location.reload();
                    }
                });
            });

            $('#btn-apply').click(function (e) { 
                e.preventDefault();
                $.ajax({
                    type: "get",
                    url: "/job/apply/{{ $job_data->job_path }}",
                    statusCode: {
                        200: function(response) {
                            Swal.fire({
                                icon: 'success',
                                text: 'job applied'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = '/dashboard';
                                }
                            });
                        },
                        412: function(response) {
                            Swal.fire({
                                icon: 'error',
                                text: response.responseText
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>