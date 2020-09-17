
<div class="
            item sorting-item show-item
            {{isset($itemDetails->YahooPrice) ? 'Yahoo':''}}
            {{isset($itemDetails->RakutenPrice) ? 'Rakuten':''}}
            {{isset($itemDetails->AmazonPrice) ? 'Amazon':''}}"
     data-amazon-price="{{$itemDetails->AmazonPrice}}"
     data-rakuten-price="{{$itemDetails->RakutenPrice}}"
     data-yahoo-price="{{$itemDetails->YahooPrice}}"
     data-min-price="{{$itemDetails->Price}}"
>

    <div class="product-img">
        <img src="{{$itemDetails->ImgSRC ?? asset('/img/no-image.jpg')}}"
             onError="this.onerror=null;this.src='{{asset('/img/no-image.png')}}';"
             alt="{{$itemDetails->ItemName}}">
    </div>

    <div class="product-name">
        <h4>{{$itemDetails->ItemName}}</h4>
    </div>

    <div class="product-shop">
        @if(isset($itemDetails->AmazonPrice))
        <div class="item show-item Amazon">
            <h4>{{$itemDetails->AmazonPrice}}円
                <a href="{{$itemDetails->AmazonLink}}" target="_blank"><img id="AmazonLogo" alt="Amazon" src="{{asset('/img/logos/logo-amazon.png')}}" class="img-logo"></a>
            </h4>
        </div>
        @endif
        @if(isset($itemDetails->RakutenPrice))
        <div class="item show-item Rakuten">
            <h4>{{$itemDetails->RakutenPrice}}円
            <a href="{{$itemDetails->RakutenLink}}" target="_blank"><img id="RakutenLogo" alt="Rakuten" src="{{asset('/img/logos/logo-rakuten.png')}}" class="img-logo"></a>
            </h4>
        </div>
        @endif
        @if(isset($itemDetails->YahooPrice))
        <div class="item show-item Yahoo">
            <h4>{{$itemDetails->YahooPrice}}円
                <a href="{{$itemDetails->YahooLink}}" target="_blank"><img id="YahooLogo" alt="Yahoo" src="{{asset('/img/logos/logo-yahoo.png')}}" class="img-logo"></a>
            </h4>
        </div>
        @endif
    </div>
</div>


