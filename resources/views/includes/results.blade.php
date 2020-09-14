
<div class="single-job mb-4 d-lg-flex justify-content-between">

    <div class="job-img align-self-center">
        <img src="{{$itemDetails->ImgSRC}}" class="img-thumbnail" alt="{{$itemDetails->ItemName}}" style="width:60%">
    </div>
    
    <div class="job-text">
        <h4>{{$itemDetails->ItemName}}</h4>
        <ul class="mt-4">
        
            <li><h5>Details : </h5></li>
        </ul>
    </div>
    
    <div class="job-btn align-self-center">
        @switch (request()->option)
                @case ('Amazon')
                    @if(!empty($itemDetails->AmazonPrice))
                        <h4>{{$itemDetails->AmazonPrice}}　円</h4> 
                        <a href="{{$itemDetails->AmazonLink}}" class="third-btn job-btn2">Link</a>   
                    @endif
                @break
                  
                @case ('Rakuten')
                    @if(!empty($itemDetails->RakutenPrice))
                        <h4>{{$itemDetails->RakutenPrice}}　円</h4>  
                        <a href="{{$itemDetails->RakutenLink}}" class="third-btn job-btn2">Link</a> 
                    @endif
                @break

                @case ('Yahoo')
                    @if(!empty($itemDetails->YahooPrice))
                        <h4>{{$itemDetails->YahooPrice}}　円</h4>
                        <a href="{{$itemDetails->YahooLink}}" class="third-btn job-btn2">Link</a>
                    @endif
                 @break

                 @default
                 <h4>{{$itemDetails->Price}}</h4>
                 <a href="{{$itemDetails->Link}}" class="third-btn job-btn2">Link</a>

        @endswitch
        <!-- <a href="#" class="third-btn">apply</a> -->
    </div>
</div>
      