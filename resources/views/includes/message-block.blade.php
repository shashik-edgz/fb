@if(count($errors)>0)
    <div class="row">
        <div class="col-md-4 col-md-offset-4 alert alert-danger alert-dismissible">
            <ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>

        </div>

    </div>
@endif
@if(Session::has('message'))

    <div class="row">
        <div class="col-md-4 col-md-offset-4 alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           {{Session::get('message')}}
        </div>

    </div>
@endif