@extends('job::layouts.master')
@section('title')
Hồ sơ công việc
@endsection
@section('content')
<style>
.page-title {
    margin-top: 100px;
}

span.flaticon-bookmark.active {
    color: red;
}
</style>
<!--Page Title-->
<section class="page-title">
    <div class="auto-container">
        <div class="title-outer">
            <h1>Tất cả hồ sơ mẫu</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home') }}">Trang chủ</a></li>
                <li><a href="{{ route('cvs.index') }}">Hồ sơ mẫu</a></li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->
<!-- Listing Section -->
<section class="ls-section">
    <div class="auto-container">
        <div class="filters-backdrop"></div>
        <div class="row">
            <!-- Content Column -->
            <div class="content-column col-lg-12 col-md-12 col-sm-12">
                <div class="default-tabs style-two tabs-box">
                    <!--Tabs Box-->
                    <ul class="tab-buttons clearfix">
                        <li class="tab-btn active-btn" data-tab="#tab4">Mẫu CV theo
                            style
                        </li>
                        <li class="tab-btn" data-tab="#tab5">Mẫu CV theo
                            ngành nghề</li>
                    </ul>

                    <div class="tabs-content">
                        <!--Tab-->
                        <div class="tab active-tab animated fadeIn" id="tab4" style="display: block;">
                            <div class="ls-outer">
                                <form action="" method="get">
                                    <div class="row">
                                        <div class="mb-3 col-4">
                                            <select name="language" class="chosen-select" onchange="this.form.submit()">
                                                <option value="" {{ old('language') == null ? 'selected' : '' }}>Tất cả
                                                    các ngôn ngữ</option>>
                                                <option value="TiengAnh"
                                                    {{ isset($_GET['language']) && $_GET['language'] ==  'TiengAnh' ? 'selected' : '' }}>
                                                    Tiếng Anh</option>
                                                <option value="TiengViet"
                                                    {{ isset($_GET['language']) && $_GET['language'] ==  'TiengViet' ? 'selected' : '' }}>
                                                    Tiếng Việt</option>
                                                <option value="TiengNhat"
                                                    {{ isset($_GET['language']) && $_GET['language'] ==  'TiengNhat' ? 'selected' : '' }}>
                                                    Tiếng Nhật</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-4">
                                            <select name="style" class="chosen-select" onchange="this.form.submit()">
                                                <option value="">Tất cả các thiết kế</option>
                                                @foreach($styles as $style)
                                                <option value="{{ $style->name }}"
                                                    {{ isset($_GET['style']) && $_GET['style'] ==  $style->name ? 'selected' : '' }}>
                                                    {{ $style->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    @foreach ($items as $item)
                                    @include('cvs::website.includes.cv-style-item', [
                                    'job' => $item,
                                    'job_info' => true,
                                    'job_other_info' => true,
                                    'bookmark' => true,
                                    ])
                                    @endforeach
                                    <!-- Listing Show More -->
                                    @include('cvs::website.includes.pagination')
                                </div>
                            </div>
                        </div>

                        <!--Tab-->
                        <div class="tab" id="tab5" style="display: none;">
                            <div class="ls-outer">
                                <form action="" method="get">
                                    <div class="row">
                                        <div class="mb-3 col-3">
                                            <select name="career" class="chosen-select" onchange="this.form.submit()">
                                                <option value="" {{ old('career') == null ? 'selected' : '' }}>Tất cả
                                                    các ngành nghề </option>
                                                @foreach($careers as $career)
                                                <option value="{{ $career->name }}"
                                                    {{ isset($_GET['career']) && $_GET['career'] ==  $career->name ? 'selected' : '' }}>
                                                    {{ $career->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    @if (request()->career)
                                    @foreach ($careers as $career)
                                    @if ($career->name === request()->career)
                                    @include('cvs::website.includes.cv-career-item', [
                                    'item' => $career,
                                    'item_info' => true,
                                    'item_other_info' => true,
                                    'bookmark' => true,
                                    ])
                                    @endif
                                    @endforeach
                                    @else
                                    @foreach ($careers as $career)
                                    @include('cvs::website.includes.cv-career-item', [
                                    'item' => $career,
                                    'item_info' => true,
                                    'item_other_info' => true,
                                    'bookmark' => true,
                                    ])
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Listing Page Section -->
@endsection