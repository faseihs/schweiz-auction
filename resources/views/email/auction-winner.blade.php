<p>The winner for Auction <strong>{{$auction->id}}</strong> is <strong>{{$user->name}}</strong></p>
<p>Amount is ${{$bid->amount}}</p>
<a href="http://auction.ambreenfatima.com/client/auction/{{$auction->id}}">
    <h4>Auction : {{$auction->title}}</h4>
    <img src="{{$message->embed(asset($auction->getThumbnail()))}}" alt="Image">
</a>