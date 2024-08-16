<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 10 Create Multi Language Website Tutorial</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"></head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card w-75 m-auto">
                    <div class="card-header text-center bg-primary text-white">
                        <h4 style="font-size: 17px;">Laravel 10 Create Multi Language Website Tutorial</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Select Language: </strong>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select changeLang">.change(function(event){})
                                    <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>
                                        English
                                    </option>
                                    <option value="fr" {{ session()->get('locale') == 'fr' ? 'selected' : '' }}>
                                        French
                                    </option>
                                    <option value="ar" {{ session()->get('locale') == 'ar' ? 'selected' : '' }}>
                                        Arabic
                                    </option>
                                    <option value="hi" {{ session()->get('locale') == 'hi' ? 'selected' : '' }}>
                                        Hindi
                                    </option>
                                </select>
                            </div>
                        </div>

                            <h3>{{ GoogleTranslate::trans('Welcome to Online Web Tutor', app()->getLocale()) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
       var url = "{{ route('changeLang')}}";
       $('.changeLang').change(function(event){
        window.location.href = url+"?lang="+$(this).val();
       });
    </script>
    </body>

</html>