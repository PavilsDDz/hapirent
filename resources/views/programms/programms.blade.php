@extends('layouts.elisanda')
<?php 	
    	$lng = Lang::locale();
 ?>
@section('meta')
    <meta name="title" content='programmas mācību centrā "Elisanda"'>
    <meta name="keywords" content="semināri, mācības, kursi, skola, apmācības, skaistumkopšana, labsajūta, veselība, čakras ">
    <meta name="description" content='Apgūsti kādu no programmām un pilnveido sevi mācību centrā "Elisanda"'>
@endsection

@section('content')
    <div class="paddingH1 marginV1 programms">	
    @foreach($programms as $program)
    <?php 	
    	$prg = get_object_vars($program);
     ?>
    	<div class="program marginV1">
    		<div class="flex mob_col sb">	
    			<div class="text  flex" >
    				<a href="{{url('/')}}/programms/{{$program->id}}">
			    		<h3>
			    		{{$prg['title_'.$lng]}}
			    		</h3>
    				</a>

		    		<div class="description">
                        @if($prg['shortDisc_'.$lng]!=''&&$prg['shortDisc_'.$lng]!=null)
                            {!!$prg['shortDisc_'.$lng]!!}
                            
                        @else
                            {!!$prg['description_'.$lng]!!}
                        @endif
                    </div>
    				<div class="more">	
    						<a href="{{url('/')}}/programms/{{$program->id}}">{{trans('lang.view')}}</a>
    				</div>
    			</div>
		    		<!-- <img src="{{url('/')}}/uploads/imgs/{{$program->thumb}}"> -->
                <a href="{{url('/')}}/programms/{{$program->id}}">
                        <div class="thumb" style="background-image: url({{url('/')}}/uploads/imgs/{{$program->thumb}});">   </div>
                </a>
    		</div>
    	</div>
    @endforeach
   </div>
@endsection
@section('scripts_top')
	<script type="text/javascript">
            in_page = 'programs';
    </script>
@endsection