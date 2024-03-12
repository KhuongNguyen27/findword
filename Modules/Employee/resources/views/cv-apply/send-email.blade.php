@extends('employee::layouts.master')
@section('content')
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>Nhập thông tin</h3>
                <div>
                    <textarea class="form-control" rows="4" name="sendemail" id="description"></textarea>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endsection
