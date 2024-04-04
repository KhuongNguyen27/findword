<div class="job-search-form">
    <form method="get" action="{{ route($route) }}">
        <div class="row">
            @if (!isset($country) || true)
                <div class="form-group col">
                    <span class="icon flaticon-map-locator"></span>
                    <select name="province_id" class="form-select chosen-select">
                        <option value="">Tất cả địa điểm</option>
                        <option value="quoc_te">Quốc tế</option>
                        @foreach ($provinces as $province)
                            @php 
                            $province->name = str_replace('Tỉnh ','',$province->name);
                            $province->name = str_replace('Thành phố ','',$province->name);
                            @endphp 
                            <option @selected( $province->id == request()->province_id ) value="{{ $province->id }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                <div></div>
            @endif
            <!-- Form Group -->
            @if( isset($ranks) )
            <div class="form-group col location">
                <span class="icon flaticon-stocks-graphic-on-laptop-monitor"></span>
                <select name="rank_id" class="form-select chosen-select">
                    <option value="">Tất cả cấp bậc</option>
                    @foreach ($ranks as $rank)
                        <option @selected( $rank->id == request()->rank_id ) value="{{ $rank->id }}">{{ $rank->name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            @if( isset($wages) )
            <div class="form-group col location">
                <span class="icon flaticon-money"></span>
                <select name="wage_id" class="form-select chosen-select">
                    <option value="">Tất cả mức lương</option>
                    @foreach ($wages as $wage)
                        <option @selected( $wage->id == request()->wage_id )  value="{{ $wage->id }}">{{ $wage->name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            @if( isset($careers) )
            <div class="form-group col location">
                <span class="icon flaticon-target"></span>
                <select name="career_id" class="form-select chosen-select">
                    <option value="">Tất cả ngành nghề</option>
                    @foreach ($careers as $career)
                        <option @selected( $career->id == request()->career_id ) value="{{ $career->id }}">{{ $career->name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <!-- Form Group -->
            <div class="form-group col btn-box">
                <button type="submit" class="theme-btn btn-style-one"><span
                        class="btn-title">{{ __('search') }}</span></button>
            </div>
            <div class="form-group col-lg-1 btn-box">
                <button id="advanceSearchBtn" type="button" class="theme-btn btn-style-two btn-icon">
                    <i class="fas fa-solid fa-cog text-white"></i>
                </button>
            </div>
            <div id="advanceSearch" style="display:none" class="form-group col-lg-12">
                <div class="row">
                    @if( isset($degrees) )
                    <div class="form-group col location">
                        <span class="icon flaticon-stocks-graphic-on-laptop-monitor"></span>
                        <select name="degree_id" class="form-select chosen-select">
                            <option value="">Tất cả trình độ</option>
                            @foreach ($degrees as $degree)
                                <option @selected( $degree->id == request()->degree_id ) value="{{ $degree->id }}">{{ $degree->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    @if( isset($formworks) )
                    <div class="form-group col location">
                        <span class="icon flaticon-stocks-graphic-on-laptop-monitor"></span>
                        <select name="formwork_id" class="form-select chosen-select">
                            <option value="">Tất cả hình thức</option>
                            @foreach ($formworks as $formwork)
                                <option @selected( $formwork->id == request()->formwork_id ) value="{{ $formwork->id }}">{{ $formwork->name }}</option>
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
@if( isset($allowKeywords) )
<div class="popular-searches mb-2 mt-1">
    <span class="popular-title text-white">Từ khóa liên quan: </span>
    <a class="text-white" href="#">Designer</a>, 
    <a class="text-white" href="#">Developer</a>, 
    <a class="text-white" href="#">Web</a>, 
    <a class="text-white" href="#">IOS</a>, 
    <a class="text-white" href="#">PHP</a>, 
    <a class="text-white" href="#">Senior</a>, 
    <a class="text-white" href="#">Engineer</a>
</div>
@endif
@if( isset($allowSort) )
<div class="popular-searches mb-2 mt-1">
    <span class="popular-title text-white">Sắp xếp theo: </span>
    <a class="btn btn-sm btn-light" href="#">Mặc định</a>
    <a class="btn btn-sm btn-light" href="#">Lương (cao - thấp)</a>
    <a class="btn btn-sm btn-light" href="#">Ngày đăng (mới nhất)</a>
    <a class="btn btn-sm btn-light" href="#">Ngày đăng (cũ nhất)</a>
</div>
@endif


