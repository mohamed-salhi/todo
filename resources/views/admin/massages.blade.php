@extends('admin.master')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/vendors/themify-icons/css/themify-icons.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/johndoe.css')}}">
@endsection
@section('title','emailtodo')

@section('content')
<div class="section contact" id="contact">
    <div id="map" class="map"></div>
    <div class="container">

            <div id="alreat"  >

            </div>

        <div class="row">
            <h4 class="contact-title">Do you have any comments about the site?</h4>
            <div class="col-lg-8">
                <div class="contact-form-card">
                    <h4 class="contact-title">Send a message</h4>
                    <form id="comment-form" >

                        <div class="form-group">
                            <input id="one" value="{{ old('Name')}}" class="form-control @error('Name') is-invalid @enderror" type="text" name="Name" placeholder="Your name">
                            @error('Name')
                            <small class="invalid-feedback">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="two" value="{{ old('Email')}}" class="form-control @error('Email') is-invalid @enderror" type="text" name="Email" placeholder="Your Email">
                            @error('Email')
                            <small class="invalid-feedback">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea id="three" class="form-control"  name="Message" placeholder="Message *" rows="7" required></textarea>
                        </div>
                        <div class="form-group ">
                            <button type="submit" class="form-control btn btn-primary" >Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-info-card">
                    <h4 class="contact-title">Get in touch</h4>
                    <div class="row mb-2">
                        <div class="col-1 pt-1 mr-1">
                            <i class="ti-mobile icon-md"></i>
                        </div>
                        <div class="col-10 ">


                            <h6 class="d-inline">{{ trans('Salhi.Phone') }} : <br> <span class="text-muted">+ 0595457329</span></h6>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-1 pt-1 mr-1">
                            <i class="ti-map-alt icon-md"></i>
                        </div>
                        <div class="col-10">
                            <h6 class="d-inline">{{ trans('Salhi.Address') }} :<br> <span class="text-muted"> Palestine/Gaza.</span></h6>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-1 pt-1 mr-1">
                            <i class="ti-envelope icon-md"></i>
                        </div>
                        <div class="col-10">
                            <h6 class="d-inline">{{ trans('Salhi.Email') }} :<br> <span class="text-muted">mohamed2562289mbn@gmail.com</span></h6>
                        </div>
                    </div>
                    <ul class="social-icons pt-4">
                        <li class="social-item"><a class="social-link text-dark" href="https://www.facebook.com/profile.php?id=100011958223073"><i class="ti-facebook" aria-hidden="true"></i></a></li>
                        <li class="social-item"><a class="social-link text-dark" href="https://twitter.com/mohsalhy"><i class="ti-twitter" aria-hidden="true"></i></a></li>
                        <li class="social-item"><a class="social-link text-dark" href="https://www.instagram.com/mohamed_salhy1/?fbclid=IwAR0bWOD6D5rD6v-HBc3tibGX4P4EehIwJvdhLjcU3PxqhW_jlTeZUjrTzvg"><i class="ti-instagram" aria-hidden="true"></i></a></li>

                        <li class="social-item"><a class="social-link text-dark" href="https://github.com/mohamed-salhi"><i class="ti-github" aria-hidden="true"></i></a></li>


                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@stop
@section('script')
    <script>


        $('#comment-form').submit(function(e){
            e.preventDefault();

            $.ajax({
                type : 'post',
                url  : '{{route("massges")}}',
                data : {
                    _token:'{{csrf_token()}}',
                    Name :$('#one').val(),
                    Email : $('#two').val(),
                    Message : $('#three').val(),
                },
                success: function(res) {
                    $('#alreat').text('sent succesfully').addClass('alert alert-success');
                    $('#one').val('');
                        $('#two').val('');
                        $('#three').val('');

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            }

        )}
        )
    </script>
@stop

