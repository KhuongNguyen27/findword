<div class="job-block-four col-lg-3 col-md-3 col-sm-6">
    <div class="inner-box" style="background-color:#f3f5f7;">
        <!-- <ul class="job-other-info">
            <li class="time">Full Time</li>
            <li class="privacy">Private</li>
            <li class="required">Urgent</li>
        </ul>
        <span class="company-logo"><img src="images/resource/company-logo/3-1.png" alt=""></span>
        <span class="company-name">Catalyst</span> -->
        <img src="{{ asset($item->image) }}" class="mb-4">
        @if($item->styles->count())
        @foreach($item->styles->take(2) as $style)
        <span class="btn-sm fw-bolder" style="background:#f2f4f5!important;color:#7f878f">{{$style->name}}</span>
        @endforeach
        <span class="btn-sm fw-bolder"
            style="background:#f2f4f5!important;color:#7f878f">+{{$item->styles->count() - 2}}</span>
        @endif
        <h4 class="mt-4 fw-bolder"><a href="{{ $item->file_cv }}">{{ $item->name }}</a></h4>
        <div class="">
            <a href="{{ $item->file_cv }}" class="btn btn-success w-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-cloud-download" viewBox="0 0 16 16">
                    <path
                        d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383" />
                    <path
                        d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708z" />
                </svg>
                Tải Xuống</a>
        </div>
    </div>
</div>