<h4>{{$user->name}} has won the auction {{$auction->title}}</h4>

<a href="http://schweiz-auction/client/auction/{{$auction->id}}">
    <h4>Auction : {{$auction->title}}</h4>
    <img src="{{$message->embed(asset($auction->getThumbnail()))}}" alt="Image">
</a>