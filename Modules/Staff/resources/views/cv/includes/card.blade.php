<style>
    li.nav-item.active {
        background-color: #1269DB;
    }

    li.nav-item.active a.nav-link {
        color: white;
    }
</style>
<div class="card card-body mb-4">
    <ul class="nav nav-pills nav-fill nav-cv-step">
        <li class="nav-item @if ($tab == 'personal-information') active @endif">
            <a class="nav-link" href="{{ route('staff.cv.edit', ['cv' => $cv_id, 'tab' => 'personal-information']) }}">
                <i class="icon-information"></i> 1. {{ __('personal_information') }}
            </a>
        </li>
        <li class="nav-item @if ($tab == 'job-information') active @endif">
            <a class="nav-link" href="{{ route('staff.cv.edit', ['cv' => $cv_id, 'tab' => 'job-information']) }}">
                <i class="icon-briefcase"></i> 2. {{ __('job_information') }}
            </a>
        </li>
        <li class="nav-item @if ($tab == 'experience') active @endif">
            <a class="nav-link" href="{{ route('staff.cv.edit', ['cv' => $cv_id, 'tab' => 'experience']) }}">
                <i class="icon-calendar"></i> 3. {{ __('work_experience') }}
            </a>
        </li>
        <li class="nav-item @if ($tab == 'education') active @endif">
            <a class="nav-link" href="{{ route('staff.cv.edit', ['cv' => $cv_id, 'tab' => 'education']) }}">
                <i class="icon-book-open"></i> 4. {{ __('education') }}
            </a>
        </li>
        <li class="nav-item @if ($tab == 'skill') active @endif">
            <a class="nav-link" href="{{ route('staff.cv.edit', ['cv' => $cv_id, 'tab' => 'skill']) }}">
                <i class="icon-layers"></i> 5. {{ __('professional_skills') }}
            </a>
        </li>
    </ul>
</div>
