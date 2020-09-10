
<div class="single-job mb-4 d-lg-flex justify-content-between">

    <div class="job-img align-self-center">
        <img src="{{$itemDetails->ImgSRC}}" class="img-thumbnail" alt="{{$itemDetails->ItemName}}">
    </div>
    
    <div class="job-text">
        <h4>{{$itemDetails->ItemName}}</h4>
        <ul class="mt-4">
        
            <li><h5>Details : </h5></li>
        </ul>
    </div>
    
    <div class="job-btn align-self-center">
        <h4>{{$itemDetails->CategoryId}}</h4>
        <a href="{{$itemDetails->Maker}}" class="third-btn job-btn2">More Detail</a>
        <!-- <a href="#" class="third-btn">apply</a> -->
    </div>
</div>
      