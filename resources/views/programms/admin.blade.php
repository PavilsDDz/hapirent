@extends('layouts.elisanda')
@section('scripts_top')
    <script type="text/javascript">
            in_page = 'programs_admin';
    </script>
@endsection
<?php $lng = Lang::locale(); ?>

@section('content')
    <div class="admin paddingH1">
        <h2 class="sansserif">{{trans('lang.admin_panel_for')}} <b>{{trans('lang.programs')}}</b></h2>
        <div class="">
            <a class="add" href="{{url('/')}}/programms/create">{{trans('lang.new_post')}}</a>
        </div>
        <div class="marginV1">
            @foreach($programms as $program)
            <?php $pgr = get_object_vars($program); ?>
                    <div class="program">
                        <div class="title">
                            <h3>{{$pgr['title_'.$lng]}}</h3>
                          
                        </div>
                        <a class="link" href="{{url('/')}}/programms/{{$program->id}}">view</a>
                        <a class="link" href="{{url('/')}}/programms/{{$program->id}}/edit">edit</a>
                        <span>{{$program->order}}</span>
                        <div>
                            <form method="POST" action="{{url('/')}}/programms/{{$program->id}}">
                                @csrf
                                @method('put')

                                <button name="order" value="1">+</button>
                                <button name="order" value="0">-</button>
                                <input type="hidden" name="id" value="{{$program->id}}">
                            </form>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
@endsection