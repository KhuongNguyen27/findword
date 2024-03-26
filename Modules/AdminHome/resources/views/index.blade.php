@extends('admintheme::layouts.master')
@section('content')
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-4 row-cols-xxl-4">
    <div class="col">
        <div class="card radius-10 border-0 border-start border-warning border-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="">
                        <p class="mb-1">NTD đăng ký mới hôm nay : </p>
                        <h4 class="mb-0 text-warning">214</h4>
                    </div>
                    <div class="ms-auto widget-icon bg-warning text-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                            <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
                        </svg>
                        {{-- <i class="bi bi-people-fill"></i> --}}
                    </div>
                </div>
                <div class="progress mt-3" style="height: 4.5px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 75%;" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 border-0 border-start border-primary border-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="">
                        <p class="mb-1">UV đăng ký mới hôm nay : </p>
                        <h4 class="mb-0 text-primary">248</h4>
                    </div>
                    <div class="ms-auto widget-icon bg-primary text-white">
                        {{-- <i class="bi bi-basket2-fill"></i> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-check" viewBox="0 0 16 16">
                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                        </svg>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 4.5px;">
                    <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 border-0 border-start border-success border-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="">
                        <p class="mb-1">Tổng số NTD : </p>
                        <h4 class="mb-0 text-success">$1,245</h4>
                    </div>
                    <div class="ms-auto widget-icon bg-success text-white">
                        {{-- <i class="bi bi-currency-dollar"></i> --}}
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 4.5px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 border-0 border-start border-danger border-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="">
                        <p class="mb-1">Tổng số UV : </p>
                        <h4 class="mb-0 text-danger">24.25%</h4>
                    </div>
                    <div class="ms-auto widget-icon bg-danger text-white">
                        {{-- <i class="bi bi-graph-down-arrow"></i> --}}
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 4.5px;">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 75%;" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-4 row-cols-xxl-4">
    <div class="col">
        <div class="card radius-10 border-0 border-start border-warning border-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="">
                        <p class="mb-1">NTD đăng ký mới hôm nay : </p>
                        <h4 class="mb-0 text-warning">214</h4>
                    </div>
                    <div class="ms-auto widget-icon bg-warning text-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                            <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
                        </svg>
                        {{-- <i class="bi bi-people-fill"></i> --}}
                    </div>
                </div>
                <div class="progress mt-3" style="height: 4.5px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 75%;" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 border-0 border-start border-primary border-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="">
                        <p class="mb-1">UV đăng ký mới hôm nay : </p>
                        <h4 class="mb-0 text-primary">248</h4>
                    </div>
                    <div class="ms-auto widget-icon bg-primary text-white">
                        {{-- <i class="bi bi-basket2-fill"></i> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-check" viewBox="0 0 16 16">
                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                        </svg>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 4.5px;">
                    <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 border-0 border-start border-success border-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="">
                        <p class="mb-1">Tổng số NTD : </p>
                        <h4 class="mb-0 text-success">$1,245</h4>
                    </div>
                    <div class="ms-auto widget-icon bg-success text-white">
                        {{-- <i class="bi bi-currency-dollar"></i> --}}
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 4.5px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 border-0 border-start border-danger border-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="">
                        <p class="mb-1">Tổng số UV : </p>
                        <h4 class="mb-0 text-danger">24.25%</h4>
                    </div>
                    <div class="ms-auto widget-icon bg-danger text-white">
                        {{-- <i class="bi bi-graph-down-arrow"></i> --}}
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 4.5px;">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 75%;" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-6 col-xl-4 d-flex">
        <div class="card w-100">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center">
                    <div class="">
                        <h6 class="mb-0 fw-bold">Team Members</h6>
                    </div>
                    <div class="dropdown ms-auto">
                        <button type="button" class="btn-option dropdown-toggle dropdown-toggle-nocaret cursor-pointer"
                            data-bs-toggle="dropdown"><i class="bi bi-three-dots fs-4"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:;">Action</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Another action</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="team-list">
                    <div class="d-flex align-items-center gap-3">
                        <div class="">
                            <img src="https://codervent.com/roksyn/demo/ltr/assets/images/avatars/01.png" alt="" width="50" height="50"
                                class="rounded-circle">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold">John Michael</h6>
                            <span
                                class="badge bg-success bg-success-subtle text-success border border-opacity-25 border-success">ONLINE</span>
                        </div>
                        <div class="">
                            <button class="btn btn-outline-primary rounded-5 btn-sm px-3">Add</button>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex align-items-center gap-3">
                        <div class="">
                            <img src="https://codervent.com/roksyn/demo/ltr/assets/images/avatars/02.png" alt="" width="50" height="50"
                                class="rounded-circle">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold">Samantha Ivy</h6>
                            <span class="badge bg-danger-subtle text-danger border border-opacity-25 border-danger">IN
                                MEETING</span>
                        </div>
                        <div class="">
                            <button class="btn btn-outline-primary rounded-5 btn-sm px-3">Add</button>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex align-items-center gap-3">
                        <div class="">
                            <img src="https://codervent.com/roksyn/demo/ltr/assets/images/avatars/03.png" alt="" width="50" height="50"
                                class="rounded-circle">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold">Alex Smith</h6>
                            <span
                                class="badge bg-warning-subtle text-warning border border-opacity-25 border-warning">OFFLINE</span>
                        </div>
                        <div class="">
                            <button class="btn btn-outline-primary rounded-5 btn-sm px-3">Add</button>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex align-items-center gap-3">
                        <div class="">
                            <img src="https://codervent.com/roksyn/demo/ltr/assets/images/avatars/04.png" alt="" width="50" height="50"
                                class="rounded-circle">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold">Alex Smith</h6>
                            <span
                                class="badge bg-danger-subtle text-danger border border-opacity-25 border-danger">OFFLINE</span>
                        </div>
                        <div class="">
                            <button class="btn btn-outline-primary rounded-5 btn-sm px-3">Add</button>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex align-items-center gap-3">
                        <div class="">
                            <img src="https://codervent.com/roksyn/demo/ltr/assets/images/avatars/02.png" alt="" width="50" height="50"
                                class="rounded-circle">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold">Samantha</h6>
                            <span
                                class="badge bg-success-subtle text-success border border-opacity-25 border-success">IN
                                MEETING</span>
                        </div>
                        <div class="">
                            <button class="btn btn-outline-primary rounded-5 btn-sm px-3">Add</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 col-xl-4 d-flex">
        <div class="card w-100">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center">
                    <div class="">
                        <h6 class="mb-0 fw-bold">To do list</h6>
                    </div>
                    <div class="dropdown ms-auto">
                        <button type="button" class="btn-option dropdown-toggle dropdown-toggle-nocaret cursor-pointer"
                            data-bs-toggle="dropdown"><i class="bi bi-three-dots fs-4"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:;">Action</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Another action</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="team-list">
                    <div
                        class="d-flex align-items-center gap-3 border-start border-success border-4 border-0 px-2 py-1">
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold">Meeeting with John</h6>
                            <span class="">10:56 PM</span>
                        </div>
                        <div class="form-check form-switch form-check-success border-0">
                            <input class="form-check-input border-1" type="checkbox" role="switch" checked="">
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex align-items-center gap-3 border-start border-danger border-4 border-0 px-2 py-1">
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold">Meeeting with John</h6>
                            <span class="">10:56 PM</span>
                        </div>
                        <div class="form-check form-switch form-check-danger border-0">
                            <input class="form-check-input border-1" type="checkbox" role="switch" checked="">
                        </div>
                    </div>
                    <hr>
                    <div
                        class="d-flex align-items-center gap-3 border-start border-primary border-4 border-0 px-2 py-1">
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold">Meeeting with John</h6>
                            <span class="">10:56 PM</span>
                        </div>
                        <div class="form-check form-switch form-check-primary border-0">
                            <input class="form-check-input border-1" type="checkbox" role="switch" checked="">
                        </div>
                    </div>
                    <hr>
                    <div
                        class="d-flex align-items-center gap-3 border-start border-warning border-4 border-0 px-2 py-1">
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold">Meeeting with John</h6>
                            <span class="">10:56 PM</span>
                        </div>
                        <div class="form-check form-switch form-check-warning border-0">
                            <input class="form-check-input border-1" type="checkbox" role="switch" checked="">
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex align-items-center gap-3 border-start border-info border-4 border-0 px-2 py-1">
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold">Meeeting with John</h6>
                            <span class="">10:56 PM</span>
                        </div>
                        <div class="form-check form-switch form-check-info border-0">
                            <input class="form-check-input border-1" type="checkbox" role="switch" checked="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-12 col-xl-4 d-flex">
        <div class="card w-100">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center">
                    <div class="">
                        <h6 class="mb-0 fw-bold">Projects</h6>
                    </div>
                    <div class="dropdown ms-auto">
                        <button type="button" class="btn-option dropdown-toggle dropdown-toggle-nocaret cursor-pointer"
                            data-bs-toggle="dropdown"><i class="bi bi-three-dots fs-4"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:;">Action</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Another action</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="team-list">
                    <div class="d-flex align-items-center gap-3">
                        <div class="widget-icon bg-transparent border rounded-3">
                            <img src="https://codervent.com/roksyn/demo/ltr/assets/images/icons/apple.png" alt="" width="30">
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-2 fw-bold">Angular 12 Dashboard</p>
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex align-items-center gap-3">
                        <div class="widget-icon bg-transparent border rounded-3">
                            <img src="https://codervent.com/roksyn/demo/ltr/assets/images/icons/bootstrap.png" alt="" width="30">
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-2 fw-bold">Angular 12 Dashboard</p>
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 70%;" aria-valuenow="75"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex align-items-center gap-3">
                        <div class="widget-icon bg-transparent border rounded-3">
                            <img src="https://codervent.com/roksyn/demo/ltr/assets/images/icons/google-2.png" alt="" width="30">
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-2 fw-bold">Angular 12 Dashboard</p>
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="75"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex align-items-center gap-3">
                        <div class="widget-icon bg-transparent border rounded-3">
                            <img src="https://codervent.com/roksyn/demo/ltr/assets/images/icons/spotify.png" alt="" width="30">
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-2 fw-bold">Angular 12 Dashboard</p>
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 55%;" aria-valuenow="75"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex align-items-center gap-3">
                        <div class="widget-icon bg-transparent border rounded-3">
                            <img src="https://codervent.com/roksyn/demo/ltr/assets/images/icons/outlook.png" alt="" width="30">
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-2 fw-bold">Angular 12 Dashboard</p>
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 45%;" aria-valuenow="75"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection