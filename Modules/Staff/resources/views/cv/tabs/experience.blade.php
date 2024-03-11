@php
$showFormAdd = false;
if($errors->any()){
$showFormAdd = true;
}
@endphp
<div class="row">
    <div class="col-md-12">
        <div class="card">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            
            <div class="card-header">
                <div class="card-title">
                    <button class="btn btn-primary" type="button" data-toggle="collapse"
                    data-target="#collapseExperience-" aria-expanded="{{ $showFormAdd ? 'true' : 'false' }}"
                    aria-controls="collapseExperience-">
                    <i class="fas fa-plus"></i>
                    Thêm mới Kinh nghiệm
                </button>
            </div>
        </div>
        <div class="card-body collapse {{ $showFormAdd ? 'show' : '' }}" id="collapseExperience-">
              
                <form class="default-form" method="POST"
                    action="{{ route('staff.experience.store',['cv_id'=>$cv_id]) }}">
                    @csrf
                    @include('staff::cv.tabs.includes.form-experience-create',['experience' => null])
                </form>
            </div>
        </div>
        @if(count($userExperiences))
        @foreach($userExperiences as $userExperience)
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">
                    #{{ $userExperience->numerical }} - {{ $userExperience->position }}
                </h5>
            </div>
            <div class="card-body">
                <form class="default-form experience-form" method="POST"
                    action="{{ route('staff.experience.update',$userExperience->id) }}">
                    @csrf
                    @method('PUT')
                    @include('staff::cv.tabs.includes.form-experience-edit',['experience' => $userExperience])
                </form>
            </div>
            <div class="card-footer">
                <form action="{{route('staff.experience.destroy', $userExperience->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa ứng tuyển này không?')">
                        <span class="fas fa-trash"></span> Xóa
                    </button>
                </form>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>