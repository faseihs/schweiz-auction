<h4>A new {{$auction->vehicle}} has been added</h4>
    <h4>We wish you a pleasant auction</h4>
<a href="http://auction.ambreenfatima.com/client/auction/{{$auction->id}}">
    <h4>Auction : {{$auction->title}}</h4>
<img src="{{$message->embed(asset($auction->getThumbnail()))}}" alt="Image">
</a>