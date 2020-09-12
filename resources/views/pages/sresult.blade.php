@extends('layouts.master')
    @section('content')
    <div class="container">
      <div class="row">
          <div class="col-lg-12 text-center mt-5">
             <span>“ </span>
              {{request()->search}}
              <span>“ の検索結果 </span>
              {{count($data)}}
              <span>”</span>
          </div>
      </div>
 </div>

<!-- Result Area Starts -->
<section class="result-area section-padding">
  <div class="container">
      <div class="row">
          <div class="col-lg-12">
          @foreach($data as $itemDetails)
            @switch (request()->option)
                  @case ('Amazon')
                  @if(!empty($itemDetails->AmazonPrice))
                  @include('includes.results')
                  @endif
                  @break
                <!-- Rakuten -->
                  @case ('Rakuten')
                  @if(!empty($itemDetails->RakutenPrice))
                  @include('includes.results')
                  @endif
                  @break
                <!-- Yahoo -->
                  @case ('Yahoo')
                  @if(!empty($itemDetails->YahooPrice))
                  @include('includes.results')
                  @endif
                  @break

                  @default
                    @include('includes.results')

            @endswitch

          @endforeach
          </div>

        </div>
      <!-- <div class="more-job-btn mt-5 text-center">
          <a href="#" class="template-btn">more</a>
      </div> -->
  </div>
</section>
<!-- Jobs Area End -->
    @endsection
