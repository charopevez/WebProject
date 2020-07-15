@extends('layouts.master')
    @section('content')

            <div class="content">
                <div class="title m-b-md">
                    {{$value['price']}} at {{$value['url']}}
                </div>
            </div>
    @endsection
