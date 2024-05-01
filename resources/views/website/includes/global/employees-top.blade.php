<div class="top-companies mt-2">
    <div class="row">
        @foreach ($top_employees as $top_employee)
            <div class="candidate-block-four col-lg-12">
                @include('website.employees.includes.employ-item',['item' => $top_employee])
            </div>
        @endforeach
    </div>
</div>