@extends('layouts.app')
@section('scripts_top')
    <script>
        var formNow = 0
         var setForm = function (form,that){
            if (formNow!=form) {
                $('.formToggler').removeClass('orange')
                that.addClass('orange')
                // $('.regForm').fadeOut(200,function(){
                //     $('#'+form+'_reg').delay(20).fadeIn(200)
                //     formNow=form
                // })
                console.log(document.getElementById(form+'_reg'))
                $('#'+formNow+'_reg').css('display','none')
                $('#'+form+'_reg').css('display','block')
                //document.getElementById(formNow+'_reg').style.dispaly = none
                //document.getElementById(form+'_reg').style.dispaly = block
                formNow=form



            }
//                                $('.regForm').fadeOut(400,function(){
                                //         $('#'+form+'_reg').fadeIn(400)
                                // })
        }
    </script>
    <link rel="stylesheet" type="text/css" href="{{url('/css/register.css')}}">
    <script type="text/javascript" src="{{url('/js/validator.js')}}"></script>

@endsection
@section('scripts_bottom')
    <script>
        comp_form = document.getElementById('company_reg')
        pers_form = document.getElementById('private_reg')
       
    </script>
    <style>
        #company_reg{
            dispaly: none;
        }
    </style>
    <script type="text/javascript">
        var rules = {
            name: {
              required: true,
              minlength: 2
            },
            email:{
                required: true,
                email: true,
            },
            password:{
                required:true,
                minlength: 8,
            },
            password_confirmation:{
                equalTo: '#private_reg .password_confirmation'
            }
        }

        var messages = {
            name: {
                required: "Please enter your name",
                minlength: jQuery.validator.format("At least {0} characters required!")
            },
            email:{
                required: "Please add your email",
                email: "Please write valid email",
            },
            password:{
                required: "Password is required",
                minlength: jQuery.validator.format("At least {0} characters required!")
            },
            password_again: {
              equalTo: "Pasword must match"
            }
        }

            $(function(){
                $("#private_reg").validate({
                    ignore: "",
                    rules: rules,
                    messages: messages,
                    
                    onfocusout: function(that){
                        $(that).valid()
                    },
                    onclick: function(that){
                        $(that).valid()
                    },

                    submitHandler: function() {},
                    wrapper: "div",
                    ignore: ".ignore",
                    

                })

                rules['regNumber']={
                    required:true,
                    digits:true,
                }
                rules['password_confirmation']={
                     equalTo: '#company_reg .password_confirmation'
                }
                messages['regNumber']={
                    required: 'Please enter registration number',
                    digits: "Registration number mus contain only digits"
                }

                $("#company_reg").validate({
                    ignore: "",
                    rules: rules,
                    messages: messages,
                    
                    onfocusout: function(that){
                        $(that).valid()
                    },
                    onclick: function(that){
                        $(that).valid()
                    },

                    submitHandler: function() {},
                    wrapper: "div",
                    ignore: ".ignore",
                    

                })
            })

            document.getElementById('company_submit').onclick = function(){
                console.log($('#company_reg').valid())
                if($('#company_reg').valid()){
                    document.getElementById('company_reg').submit()
                    // $('#post_add').submit()
                }
            }
            document.getElementById('private_submit').onclick = function(){
                console.log($('#private_reg').valid())
                if($('#private_reg').valid()){
                    document.getElementById('private_reg').submit()
                    // $('#post_add').submit()
                }
            }
            
    </script>

@endsection()
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body margin_v4">
                    <div class="flex">
                        <script type="text/javascript">
                            function setUserType(t){
                                
                            }
                        </script>
                        <div><div class="button formToggler" onclick="setForm('private',$(this))">Private person</div></div>
                        <div><div class="button formToggler" onclick="setForm('company',$(this))">Company</div></div>
                    </div>
                    <form method="POST" class="regForm" id="private_reg" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="type" value="pri" class="userType">
                        <div class="form-groupb row">
                            <label for="private_name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="private_name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="private_email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="private_email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>





                        <div class="form-group row">
                            <label for="private_password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="private_password" type="password"  class="password form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="private_password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="private_password-confirm" type="password" class="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="private_submit" class="button green marginV5">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <form method="POST" class="regForm" action="{{ route('register') }}" id="company_reg" >
                        @csrf
                        <input type="hidden" name="type" value="jur" class="userType">

                        <div class="form-groupb row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="regNumber" class="col-md-4 col-form-label text-md-right">registration number</label>

                            <div class="col-md-6">
                                <input id="regNumber" type="number" class="form-control" name="regNumber" value="{{ old('regNumber') }}" >


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" class="password" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="company_submit" class="button green marginV5">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
