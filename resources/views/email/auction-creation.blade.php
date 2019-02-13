<h4>A new {{$auction->vehicle}} has been added</h4>
    <h4>We wish you a pleasant auction</h4>
<a href="{{env('APP_URL')}}/client/auction/{{$auction->id}}">
<img src="{{$message->embed(asset($auction->getThumbnail()))}}" alt="Image">
</a>