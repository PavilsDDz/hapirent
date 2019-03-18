@extends('layouts.elisanda')
@section('scripts_top')
    <script type="text/javascript">
            in_page = 'seminars_admin';
    </script>
@endsection
<?php $lng = Lang::locale(); ?>

@section('content')
    <div class="admin paddingH1">
        <h2 class="sansserif">{{trans('lang.admin_panel_for')}} <b>{{trans('lang.seminars')}}</b></h2>
        <div class="">
            <a class="add" href="{{url('/')}}/seminars/create">{{trans('lang.new_post')}}</a>
        </div>
        <div class="marginV1">
            @foreach($seminars as $program)
            <?php $pgr = get_object_vars($program); ?>
                    <div class="program">
                        <div class="title">
                            <h3>{{$pgr['title_'.$lng]}}</h3>
                          
                        </div>
                        <div class="flex">   
                            <div class="happening_at">
                                <span> {{$program->happening_at}}</span>       
                            </div>
                            <a class="link" href="{{url('/')}}/seminars/{{$program->id}}">view</a>
                            <a class="link" href="{{url('/')}}/seminars/{{$program->id}}/edit">edit</a>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
@endsection