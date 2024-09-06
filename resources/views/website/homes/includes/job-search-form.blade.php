<div class="job-search-form">
    @if (isset($job_type))
        <form method="get" action="{{ isset($route_index) ? $route_index : route($route,$job_type) }}">
    @else
        <form method="get" action="{{ isset($route_index) ? $route_index : route($route) }}">
    @endif
        <div class="row custom-display-mobile">
            @if (!isset($name))
                <div class="form-group col">
                    <input name="name" placeholder="{{ __('banner.vi_tri_ung_tuyen') }}" value="{{ request()->name }}">
                </div>
            @endif
            @if (!isset($country) || true )
                <div class="form-group col">
                    <span class="icon flaticon-map-locator"></span>
                    <select name="province_id" class="form-select chosen-select">
                        <option value="">{{ __('banner.tat_ca_dia_diem') }}</option>
                        @if(request()->route()->getname() != 'jobs.vnjobs')
                        <option value="quoc_te">{{ __('banner.quoc_te') }}</option>
                        @endif
                     
                        @if (request()->route()->getName() == 'jobs.nnjobs' )
                            @foreach ($countries as $country)
                                <option {{ $country->id == request()->province_id ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        @elseif (request()->route()->getName() != 'jobs.nnjobs')
                            @foreach ($provinces as $province)
                                @php
                                    $province->name = str_replace('Tỉnh ', '', $province->name);
                                    $province->name = str_replace('Thành phố ', '', $province->name);
                                @endphp
                                <option @selected($province->id == request()->province_id) value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    
                </div>
            @else
                <div></div>
            @endif
            <!-- Form Group -->
            @if (isset($ranks))
                <div class="form-group col location">
                    <span class="icon flaticon-stocks-graphic-on-laptop-monitor"></span>
                    <select name="rank_id" class="form-select chosen-select">
                        <option value="">{{ __('banner.tat_ca_cap_bac') }}</option>
                        @foreach ($ranks as $rank)
                            <option @selected($rank->id == request()->rank_id) value="{{ $rank->id }}">{{ $rank->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
            @if (isset($wages))
                <div class="form-group col location">
                    <span class="icon flaticon-money"></span>
                    {{-- <form class="custom-form-salary" id="custom-form-salary">
                        <div class="box-field">
                            <input type="number" name="salaryMin" id="" placeholder="{{ __('from') }}"
                                max="9999">
                            <span>-</span>
                            <input type="number" name="salaryMax" id="" placeholder="{{ __('to') }}"
                                max="9999">
                            <span>triệu</span>
                            <button type="button" disabled class=""> {{ __('apply') }} </button>
                        </div>
                    </form> --}}
                    <select name="wage_id" class="form-select chosen-select">
                        <option value="">{{ __('banner.tat_ca_muc_luong') }}</option>
                        @foreach ($wages as $key => $wage)
                            <option {{ $key == request()->wage_id ? 'selected' : '' }} value="{{ $key }}">
                                {{ $wage }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <!-- Form Group -->
            <div class="form-group col btn-box">
                <button type="submit" class="theme-btn btn-style-one"><span
                        class="btn-title">{{ __('banner.search') }}</span></button>
            </div>
            <div class="form-group col-lg-1 btn-box">
                <button id="advanceSearchBtn" type="button" class="theme-btn btn-style-two btn-icon">
                    <i class="fas fa-solid fa-cog text-white"></i>
                </button>
            </div>
            <div id="advanceSearch" style="display:none" class="form-group col-lg-12">
                <div class="row custom-display-mobile">
                    <div class="form-group col location">
                        <span class="icon flaticon-target"></span>
                        <select name="jobpackage_id" class="form-select chosen-select" >
                            <option class="custom-job-package-mobile" value="">{{ __('banner.tat_ca_loai_tin') }}</option>
                            @foreach ($job_packages as $job_package)
                                <option @selected($job_package->id == request()->jobpackage_id) value="{{ $job_package->id }}">
                                    {{ $job_package->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if (isset($careers))
                        <div class="form-group col location">
                            <span class="icon flaticon-target"></span>
                            <select name="career_id" class="form-select chosen-select">
                                <option value="">{{ __('banner.tat_ca_nganh_nghe') }}</option>
                                @foreach ($careers as $career)
                                    <option @selected($career->id == request()->career_id) value="{{ $career->id }}">
                                        {{ $career->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if (isset($degrees))
                        <div class="form-group col location">
                            <span class="icon flaticon-stocks-graphic-on-laptop-monitor"></span>
                            <select name="degree_id" class="form-select chosen-select">
                                <option value="">{{ __('banner.tat_ca_linh_vuc') }}</option>
                                @foreach ($degrees as $degree)
                                    <option @selected($degree->id == request()->degree_id) value="{{ $degree->id }}">
                                        {{ $degree->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if (isset($formworks))
                        <div class="form-group col location">
                            <span class="icon flaticon-stocks-graphic-on-laptop-monitor"></span>
                            <select name="formwork_id" class="form-select chosen-select">
                                <option value="">{{ __('banner.tat_ca_hinh_thuc') }}</option>
                                @foreach ($formworks as $formwork)
                                    <option @selected($formwork->id == request()->formwork_id) value="{{ $formwork->id }}">
                                        {{ $formwork->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        <div class="row">

        </div>
    </form>
</div>
<!-- Popular Search -->
@if (isset($allowKeywords) && count($job_tags))
    <div class="popular-searches mb-2 mt-1">
        <span class="popular-title text-white">{{ __('banner.tu_khoa_lien_quan') }}</span>
        @foreach ($job_tags as $job_tag)
            <a class="text-white" href="#">{{ $job_tag->name }}</a>
        @endforeach
    </div>
@endif
@if (isset($allowKeywords) && isset($job_tags) && count($job_tags))
    <div class="popular-searches mb-2 mt-1">
        <span class="popular-title text-white">{{ __('banner.tu_khoa_lien_quan') }}</span>
        @foreach ($job_tags as $job_tag)
            <a class="text-white" href="#">{{ $job_tag->name }}</a>
        @endforeach
    </div>
@endif
@if (isset($allowSort))
    @php
        $inactiveClass = 'btn btn-sm btn-light';
        $activeClass = $inactiveClass . ' bg-info text-white';
        $sort = request()->sort;
    @endphp
    <div class="popular-searches mb-2 mt-1">
        <span class="popular-title text-white">{{ __('banner.sap_xep_theo') }}: </span>
        <a href="{{ url()->current() }}?sort=default"
            class="{{ $sort == 'default' ? $activeClass : $inactiveClass }}">{{ __('banner.mac_dinh') }}</a>
        <a href="{{ url()->current() }}?sort=salary-desc"
            class="{{ $sort == 'salary-desc' ? $activeClass : $inactiveClass }}">Lương (cao - thấp)</a>
        <a href="{{ url()->current() }}?sort=date-desc"
            class="{{ $sort == 'date-desc' ? $activeClass : $inactiveClass }}">Ngày đăng (mới nhất)</a>
        <a href="{{ url()->current() }}?sort=date-asc"
            class="{{ $sort == 'date-asc' ? $activeClass : $inactiveClass }}">Ngày đăng (cũ nhất)</a>
    </div>
@endif
