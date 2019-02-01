@if(count($errors)>0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $e)
                <ul>{{$e}}</ul>
            @endforeach
        </ul>
    </div>
@endif