<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <title>Fill Form</title>
    </head>
    <body>
        <main class="app container-fluid mt-5 mb-5">
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto">
                    <div class="card">
                        <h5 class="card-header text-center">Please, fill out the form</h5>
                        <div class="card-body">
                            <form action="/" method="post" id="send_clients_data">
                                @csrf
                                <form-component></form-component>
                            </form>
                        </div>
                        <div class="card-footer container-fluid">
                            <add-row-component></add-row-component>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
    <script>
        window.AppConfiguration = {!! json_encode([
            'clients' => session('_old_input.clients') ? : [ ["name" => null, "phone" => null ] ],
            'errors' => $errors->getMessages()
        ]) !!}
        @if(session('success'))
            alert('The form has been submitted.');
        @endif
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
</html>