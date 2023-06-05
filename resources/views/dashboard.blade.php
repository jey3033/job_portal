<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Backend Dashboard</title>

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

    <div id="active-job" class="card row g-2 mx-4" style="margin-top:74px">
        <div class="card-header fs-2">Active Jobs</div>
        <section class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($active_job as $item)
                    <li class="splide__slide">
                        <div class="card mx-2">
                            <div class="card-header">{{ $item->title }}</div>
                            <div class="card-body">
                                <p class="card-text">{{ Str::words(strip_tags($item->description), 14, '...') }} <a href="/job/{{ $item->job_path }}">more</a></p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </section>
        <div class="row">
            {!! $active_job->links() !!}
        </div>
    </div>

    <div id="dashboard-job" class="card row g-2 mx-4 mt-1">
        <div class="card-header fs-2">Jobs Report</div>
        {!! $job_report->container() !!}
    </div>

    <script>
        new Splide('.splide', {
            perPage: 3
        }).mount();
    </script>
    {!! $job_report->script() !!}
    @include('include/footer')
</body>
</html>