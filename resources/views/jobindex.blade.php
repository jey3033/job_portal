<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Listing</title>

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
            <h1 class="float-start">All Jobs</h1>
            @if (Auth::user()->backend)
            <a class="btn btn-primary float-end" href="/job/create" role="button">Add New Job Listing</a>
            @endif
        </div>
        <div class="card-body">
            @foreach ($job_data as $item)
                <div class="card mx-2 my-2">
                    <div class="card-header"><a href="/job/{{ $item->job_path }}">{{ $item->title }}</a></div>
                    <div class="card-body">
                        {{-- <p class="card-text">{{ Str::words(strip_tags($item->description), 100, '...') }} <a href="/job/{{ $item->job_path }}">more</a></p> --}}
                        {!! Str::words($item->description, 50, '...') !!} <a href="/job/{{ $item->job_path }}">more</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            {!! $job_data->links() !!}
        </div>
    </div>
    
    @include('include/footer')
</body>
</html>