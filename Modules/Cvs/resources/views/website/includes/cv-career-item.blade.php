<div class="job-block-four col-lg-3 col-md-3 col-sm-6">
    <div class="inner-box" style="background-color:#f3f5f7;">
        <a href="{{ $career->cvs->count() > 0 ? asset($career->cvs->pluck('file_cv')->random()) : '' }}">
            <img src="{{ $career->image }}" alt="">
            <span class="fw-bolder fs-5">{{$career->name}}</span>
        </a>
    </div>
</div>