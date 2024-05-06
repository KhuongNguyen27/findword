<div class="top-companies mt-2">
    <div class="row">
        <div class="candidate-block-four col-lg-12">
            @include('website.employees.includes.employ-item',[
            'item' => $special_employee_jobs['employee']
            ])
        </div>
    </div>
    <div class="row">
        @foreach ($special_employee_jobs['jobs'] as $job)
        <!-- Job Block -->
        <div class="col-lg-12 col-md-12 col-sm-12">
            @include('job::includes.components.job-item', [
            'job' => $job,
            'job_info' => true,
            'job_other_info' => false,
            'bookmark' => false,
            'simple' => false,
            'company_name' => true,
            ])
        </div>
        <!-- Job Block -->
        @endforeach
    </div>
</div>