<div class="job-block-four col-lg-3 col-md-3 col-sm-6">
    <div class="inner-box" style="background-color:#f3f5f7;">
        @if ($career->cvs->count() > 0)
        <a href="{{ asset($career->cvs->pluck('file_cv')->random()) }}">
            <img src="{{ $career->image }}" alt="">
            <span class="fw-bolder fs-5">{{$career->name}}</span>
        </a>
        @endif
    </div>
</div>