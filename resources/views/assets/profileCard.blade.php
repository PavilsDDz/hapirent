<div class="light_box side ">
	<div class="flex ">
		<div class="profile_img" style="background-image: url({{$user->image}});">
		</div>
	</div>
	<div class="user_info">
		<h3>{{$user->name}}</h3>
		<div>
			<span>posts:</span>
			<span>{{$posts}}</span>
		</div>
		@if($user->type == 1)
			<div class="flex">
			<span>{{trans('profile.reg_num')}}</span><span> {{$user->regNumber}}</span>
			</div>
		@endif
		<div class="user_menu">
			@if(isset($myProfile)&&$myProfile==true)
				<a href="{{url('/')}}/profile/edit" class="button3">{{trans('profile.edit_profile')}}</a>
			@else

			@endif
		</div>
	</div>
</div>
		
