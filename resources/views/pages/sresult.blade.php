@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mt-5">
                <span>“ </span>
                {{request()->search}}
                <span>“ の検索結果 </span>
            <!-- {{count($data)}}
                <span>件 </span> -->

            </div>
        </div>
    </div>

    <!-- Result Area Starts -->
    <section class="result-area section-padding">
        <!--test-->

        <div class="navbar-controller" id="filters">
            <span class="site-filter" data-filter="Amazon">Amazon</span>
            <span class="site-filter" data-filter="Rakuten">Rakuten</span>
            <span class="site-filter" data-filter="Yahoo">Yahoo</span>
            <span class="site-filter showAll" data-filter="all">All Projects</span>
            <button class="sortBy" data-column="amazon-price" data-order="asc">Amazon</button>
            <button class="sortBy" data-column="rakuten-price" data-order="asc">Rakuten</button>
            <button class="sortBy" data-column="yahoo-price" data-order="asc">Yahoo</button>
            <button class="sortBy" data-column="min-price" data-order="asc">一番安い</button>
        </div>
        <div class="sortable-items" id="searchResult">
            @foreach($data as $itemDetails)
                @include('includes.tresults')
            @endforeach
        </div>

        <!--test-->
        {{--<div class="container">
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
        </div>--}}
    </section>
    <!-- Jobs Area End -->
@endsection
