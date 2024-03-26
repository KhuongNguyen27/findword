<div class="company-cover mt-4">
        <div class="auto-container">
            <div class="company-cover-inner">
                <div class="cover-wrapper">
                    <img draggable="false" src="{{ $userEmployee->background_fm}}" alt=""
                        class="img-responsive cover-img" width="100%">
                </div>
                <div class="company-logo">
                    <div class="company-image-logo">
                        <img draggable="false"
                            src="{{ $userEmployee->image_fm}}"
                            alt="{{ $userEmployee->name}}" class="img-responsive">
                    </div>
                </div>
                <div class="company-detail-overview">
                    <div class="box-detail">
                        <h1 data-toggle="tooltip" title="" class="company-detail-name text-highlight"
                            data-original-title="{{ $userEmployee->name}}">{{ $userEmployee->name}}</h1>
                        <div class="company-subdetail">
                            <div class="company-subdetail-label">
                                <label class="v1000">v1000</label>
                            </div>
                            <div class="company-subdetail-info">
                                <span class="company-subdetail-info-icon">
                                    <i class="fa fa-solid fa-globe"></i>
                                </span>
                                <a class="company-subdetail-info-text" href="{{ $userEmployee->website }}"
                                    target="_blank">{{ $userEmployee->website ?? '-' }}</a>
                            </div>
                            <div class="company-subdetail-info">
                                <span class="company-subdetail-info-icon">
                                    <i class="fa fa-solid fa-phone"></i>
                                </span>
                                <span class="company-subdetail-info-text">{{ $userEmployee->phone ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="box-follow">
                        <a href="#" class="btn btn-follow">
                            <span><i class="fa fa-regular fa-plus"></i></span>
                            Theo dõi công ty
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>