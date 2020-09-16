
<div class="item sorting-item show-item
            {{isset($itemDetails->YahooPrice) ? 'Yahoo':''}}
            {{isset($itemDetails->RakutenPrice) ? 'Rakuten':''}}
            {{isset($itemDetails->AmazonPrice) ? 'Amazon':''}}"
     data-amazon-price="{{$itemDetails->AmazonPrice}}"
     data-rakuten-price="{{$itemDetails->RakutenPrice}}"
     data-yahoo-price="{{$itemDetails->YahooPrice}}"
     data-min-price="{{$itemDetails->Price}}"
>

    <div class="job-img align-self-center" style="height: 200px; width: 200px; object-fit: contain">
        <img src="{{$itemDetails->ImgSRC ?? asset('/img/no-image.jpg')}}"
             onError="this.onerror=null;this.src='{{asset('/img/no-image.png')}}';"
             class="img-thumbnail" alt="{{$itemDetails->ItemName}}" style="height: 100%; width: 100%; object-fit: contain">
    </div>

    <div class="job-text">
        <h4>{{$itemDetails->ItemName}}</h4>
    </div>

    <div class="job-btn align-self-center">
        @if(isset($itemDetails->AmazonPrice))
        <div class="item show-item Amazon">
            <div class="img-container m-0 p-0 shadow-sm">
                {{$itemDetails->AmazonPrice}}円
                <a href="{{$itemDetails->AmazonLink}}"><img id="AmazonLogo" alt="Amazon" src="{{asset('/img/logos/logo-amazon.png')}}" class="img-logo"></a>
            </div>
        </div>
        @endif
        @if(isset($itemDetails->RakutenPrice))
        <div class="item show-item Rakuten">
            {{$itemDetails->RakutenPrice}}円
            <a href="{{$itemDetails->RakutenLink}}"><img id="RakutenLogo" alt="Rakuten" src="{{asset('/img/logos/logo-rakuten.png')}}" class="img-logo"></a>
        </div>
        @endif
        @if(isset($itemDetails->YahooPrice))
        <div class="item show-item Yahoo">
            <div class="img-container m-0 p-0 shadow-sm">
                {{$itemDetails->YahooPrice}}円
                <a href="{{$itemDetails->YahooLink}}"><img id="YahooLogo" alt="Yahoo" src="{{asset('/img/logos/logo-yahoo.png')}}" class="img-logo"></a>
            </div>
        </div>
        @endif
    </div>
</div>


