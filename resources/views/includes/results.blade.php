
<div class="single-job mb-4 d-lg-flex justify-content-between">

    <div class="job-img align-self-center" style="height: 200px; width: 200px; object-fit: contain">
        <img src="{{$itemDetails->ImgSRC}}" class="img-thumbnail" alt="{{$itemDetails->ItemName}}" style="height: 100%; width: 100%; object-fit: contain">
    </div>

    <div class="job-text">
        <h4>{{$itemDetails->ItemName}}</h4>
        <ul class="mt-4">

            <li><h5></h5></li>
        </ul>
    </div>

    <div class="job-btn align-self-center">
        @switch (request()->option)
                @case ('Amazon')
                    @if(!empty($itemDetails->AmazonPrice))
                        <h2>{{$itemDetails->AmazonPrice}}　円</h2>
                        <a href="{{$itemDetails->AmazonLink}}" class="third-btn job-btn2">Link</a>
                    @endif
                @break

                @case ('Rakuten')
                    @if(!empty($itemDetails->RakutenPrice))
                        <h2>{{$itemDetails->RakutenPrice}}　円</h2>
                        <a href="{{$itemDetails->RakutenLink}}" class="third-btn job-btn2">Link</a>
                    @endif
                @break

                @case ('Yahoo')
                    @if(!empty($itemDetails->YahooPrice))
                        <h2>{{$itemDetails->YahooPrice}}　円</h2>
                        <a href="{{$itemDetails->YahooLink}}" class="third-btn job-btn2">Link</a>
                    @endif
                 @break

                 @default
                 <h4>{{$itemDetails->Price}} 　円</h4>
                 <a href="{{$itemDetails->Link}}" class="third-btn job-btn2">Link</a>

        @endswitch
        <!-- <a href="#" class="third-btn">apply</a> -->
    </div>
</div>
