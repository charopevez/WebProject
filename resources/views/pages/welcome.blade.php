@extends('layouts.master')
    @section('content')

    <!-- Header -->
  <header class="masthead d-flex">
    <div class="container text-center my-auto sticky-top">
      <h1 class="mb-1">52</h1>
      <h1 class="mb-1">BANANA</h1>
      <h3 class="mb-5">
        <em>Search everything you want!</em>
      </h3>
      <br>
      
      <!-- Search Area Starts -->
      <!-- <div class="search-area">
        <div class="search-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{route('search')}}" method="post" class="d-md-flex justify-content-between">
                        @csrf
                            <input type="text" name="search" placeholder="Search Keyword" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'" required>
                            <button type="submit" class="btn btn-primary btn-xl js-scroll-trigger">Find Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Search Area End -->

    </div>
    <div class="overlay"></div>
  </header>

    @endsection
                
