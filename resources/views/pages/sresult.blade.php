@extends('layouts.master')
    @section('content')
    <div class="container">
      <div class="row">
          <div class="col-lg-12 text-center mt-5">
              <span>49 Results found for “</span>
              {{ Request()->searchg }}
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
            @include('includes.results')
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
