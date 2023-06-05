<nav class="navbar navbar-expand-lg fixed-top bg-black">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">Job Portal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="/dashboard">Home</a>
                </li>
                @if (Auth::user()->backend)
                <li class="nav-item">
                    <a class="nav-link text-white" href="/job">Job Listing</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Report
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/report/job">Job Report</a></li>
                        <li><a class="dropdown-item" href="/report/applicant">Applicant Report</a></li>
                    </ul>
                </li>
                @else
                <li class="nav-item text-white">
                    <a class="nav-link text-white" href="/job/applied">Applied Job</a>
                </li>
                <li class="nav-item text-white">
                    <a class="nav-link text-white" href="/user/profile">Your Profile</a>
                </li>
                @endif
            </ul>
        </div>
        <div class="float-end me-4">
            <a href="/logout"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
        </div>
    </div>
</nav>