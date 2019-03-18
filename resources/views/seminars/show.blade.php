@extends('layouts.elisanda')
<?php $pgr = get_object_vars($program);$lng = Lang::locale(); ?>
@section('meta')
    <meta name="title" content='seminārs {{$pgr["title_".$lng]}} mācību centrā "Elisanda"'>
    <meta name="keywords" content="{{$pgr['title_'.$lng]}}, semināri, mācības, kursi, skola, apmācības, skaistumkopšana, labsajūta, veselība, čakras  ">
    <meta meta="description" content='Apmeklē semināru {{$pgr["title_".$lng]}} un pilnveido sevi mācību centrā "Elisanda"'>
@endsection


@section('content')
    <div class="container">
        <div class="info paddingH1">
            
            <div class="title">
                <h2>{{$pgr['title_'.$lng]}}</h2>
            </div>

                <span>{{$pgr['happening_at']}}</span>

            <div class="description">
                {!!$pgr['description_'.$lng]!!}
             </div>
              
        </div>
        <div class="gallery_container paddingH1">
            @if($gal)
                @include('galleries.gallery_include')
            @endif 
        </div>
        <div class="marginV1">
            <div class="block textc ">
                <h3>{{trans('lang.apply_for_seminar')}}</h3>
            </div>
            <form method="POST" action="{{url('/seminars/'.$pgr['id'])}}">
                @csrf
                <input type="hidden" value="{{$pgr['title_lv']}}" name="seminar">
                <input type="hidden" value="{{$pgr['happening_at']}}" name="date">
                <div class="flex sb paddingH1">
                    <div class=" column2 column flex">
                        <label>{{trans('lang.name')}}</label>
                        <input type="text" name="name">
                    </div>
                    <div class=" column2 column flex">
                        <label>{{trans('lang.surname')}}</label>
                        <input type="text" name="surname">
                    </div>
                </div>
                <div class="flex sb paddingH1">
                    <div class=" column2 column flex">
                        <label>{{trans('lang.email')}}</label>
                        <input type="text" name="email">
                    </div>
                    <div class=" column2 column flex">
                        <label>{{trans('lang.phone_numder')}}</label>
                        <input type="text" name="phone">
                    </div>
                </div>
                <div class="block input flex cc">
                <button type="submit" class="submit" value="send" name="submit">{{trans('lang.apply')}}</button>
            </div>
            </form>
        </div>
    </div>
    
    
@endsection
@section('scripts_top')
    <script type="text/javascript" src="{{url('/')}}/js/hammer.js"></script>
    <script type="text/javascript">
            in_page = 'seminars';
    </script>
@endsection
