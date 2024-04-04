<section class="ls-section pt-5 pb-5 list-feature-jobs" style="background:#f3f5f7!important;">
    <div class="auto-container">
        <div class="row">
            <div class="content-column col-lg-8">
            @include('website.homes.includes.job-items',[
                'sec_title' => 'Việc làm hấp dẫn',
                'item_class' => 'col-lg-6 col-md-12 col-sm-12',
                'chunk_jobs' => $hot_jobs,
                'sec_link' => route('jobs.vnjobs','hap-dan')
            ])
            </div>
            <div class="col-lg-4">
                <div class="mt-5">
                @include('website.includes.global.attractive-banner')
                </div>
            </div>
        </div>
    </div>
</section>