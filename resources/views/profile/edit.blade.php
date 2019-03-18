@extends('layouts.app')
@section('scripts_top')
    <link rel="stylesheet" href="{{url('/')}}/css/profile.css">
    <script>
      
    </script>

@endsection

@section('content')
    <div class="container row" id="edit_profile">
        <form method="POST" action="/profile/edit" enctype="multipart/form-data">
            {{method_field('PUT')}}
            {{csrf_field()}}
            <div class="block">
                
            <h3>Basic Info</h3>
                <div class="flex column">
                    <div class="input">
                        <div class="label">{{trans('profile.profile_image')}}</div>
                            <label for="image_input" >
                            <div class="profile_img" style="background-image: url({{$user->image}});">
                                <!-- <img src="{{$user->image}}" id="profile_img" alt=""> -->
                            </label>
                            <input type="file" id="image_input" onchange="show_img(this)" name="image">    
                    </div>
                    <div class="input">
                        <div class="label" for="name">{{trans('profile.name')}}</div>
                        <input type="text" id="name" name="name" value="{{$user->name}}">
                    </div>
                    <div class="input">
                        <div class="label" for="regNumber">{{trans('profile.reg_num')}}</div>
                        <input type="text" name="regNumber" value="{{$user->regNumber}}">
                    </div>
                    <div class="input">
                        <div class="label" for="email">{{trans('profile.email')}}</div>
                        <input type="text" id="email" name="email" value="{{$user->email}}">
                    </div>
                </div>
            </div>
            <div class="block">
                <h3>change password</h3>
                <div class="input">
                    <div class="label" for="passwordOld">password old</div>
                    <input type="password" id="passwordOld" name="passwordOld" value="">
                </div>
                <div class="input">
                    <div class="label" for="passwordNew1">password new</div>
                    <input type="password" id="passwordNew1" name="passwordNew1" value="">
                </div>
                <div class="input">
                    <div class="label" for="passwordNew2">password new repeat</div>
                    <input type="password" id="passwordNew2" name="passwordNew2" value="">
                </div>
            </div>

            <div>
                <div class="input tc">
                    <button class="button green" type="submit">Save</button>
                </div>
                <div class="input tc">
                    <a href="/profile" class="" >cancel</a>
                </div>
                
            </div>
        </form>
    </div>








@endsection


@section('scripts_bottom')
        <script>
              function show_img(that){ //DISPALYS UPLOADED IMAGE

            img = document.getElementById('profile_img');
            img.src = URL.createObjectURL(that.files[0]);
            //console.log(img)
        }
        </script>
@endsection
