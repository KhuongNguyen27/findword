<div class="job-search-form">
    <form method="post" action="job-list-v10.html">
        <div class="row">
            <div class="form-group col">
                <span class="icon flaticon-map-locator"></span>
                <select name="province_id" class="form-select select2">
                    <option value="">Tất cả địa điểm</option>
                    @foreach($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->name }}</option>    
                    @endforeach
                </select>
            </div>
            <!-- Form Group -->
            <div class="form-group col location">
                <span class="icon flaticon-map-locator"></span>
                <select name="rank_id" class="form-select select2">
                    <option value="">Tất cả cấp bậc</option>
                    @foreach($ranks as $rank)
                    <option value="{{ $rank->id }}">{{ $rank->name }}</option>    
                    @endforeach
                </select>
            </div>
            <div class="form-group col location">
                <span class="icon flaticon-money"></span>
                <select name="wage_id" class="form-select select2">
                    <option value="">Tất cả mức lương</option>
                    @foreach($wages as $wage)
                    <option value="{{ $wage->id }}">{{ $wage->name }}</option>    
                    @endforeach
                </select>
            </div>
            <div class="form-group col location">
                <span class="icon flaticon-map-locator"></span>
                <select name="career_id" class="form-select select2">
                    <option value="">Tất cả ngành nghề</option>
                    @foreach($careers as $career)
                    <option value="{{ $career->id }}">{{ $career->name }}</option>    
                    @endforeach
                </select>
            </div>
            <!-- Form Group -->
            <div class="form-group col btn-box">
                <button type="submit" class="theme-btn btn-style-one"><span
                        class="btn-title">{{ __('search') }}</span></button>
            </div>
        </div>
    </form>
</div>