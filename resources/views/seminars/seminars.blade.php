@extends('layouts.elisanda')
<?php $lng = Lang::locale();?>
@section('meta')
    <meta name="title" content='semināri mācību centrā "Elisanda"'>
    <meta name="keywords" content="semināri, mācības, kursi, skola, apmācības, skaistumkopšana, labsajūta, veselība, čakras ">
    <meta name="description" content='Apmeklē kādu no semināriem un pilnveido sevi mācību centrā "Elisanda"'>
@endsection

@section('content')
    <div class="paddingH1 marginV1 programms">	
    @forelse($seminars as $program)
    <?php 	
    	$prg = get_object_vars($program);
     ?>
    	<div class="seminar flex block">
    		
    			
    				<a href="{{url('/')}}/seminars/{{$program->id}}" class="title">
			    		<h3>
			    		{{$prg['title_'.$lng]}}
			    		</h3>
    				</a>
                    <span>{{$prg['happening_at']}}</span>
		    		<!-- <div class="description">{!!$prg['description_'.$lng]!!}</div> -->
    				<div class="more">	
    						<a href="{{url('/')}}/seminars/{{$program->id}}">{{trans('lang.view')}}</a>
    				</div>
    			
		    		<!-- <img src="{{url('/')}}/uploads/imgs/{{$program->thumb}}"> -->
                
    		
    	</div>
    @empty
        <div class="empty flex">
           <!-- <h1 class="textc">Diemžēl patreiz nav ieplānots nevies seminārs.</h1> -->
            
        </div>
    @endforelse
   </div>
@endsection
@section('scripts_top')
	<script type="text/javascript">
            in_page = 'seminars';
    </script>
@endsection