@extends('admin.master')
@section('title','todo')
@section('content')

<div class="app-container   ">


        <div class="justify-content-center ">

        <h3>Todo App</h3>
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <form id="comment-form">
                    <div class="d-flex align-items-center mb-3">

                        <div class="form-group mr-3 mb-0">

                            <input

                                type="text"
                                name="todo"
                                class="form-control"
                                id="formGroupExampleInput"
                                placeholder="Enter a task here"
                            />
                        </div>

                        <button class="btn btn-primary mr-3">save</button>


                    </div>
                </form>
            </div>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                tasks yesterday
            </button>

        </div>


        <div class="table-wrapper">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Todo item</th>
                    <th>status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="comment-list">
                {{--            @dump($todo->count())--}}
                @if($count)

                    @include('admin.home',['massage' => $todo ])

                @else
                    <tr id="e">
                        <td class="alert-danger" colspan="4">NO TASK FOUND</td>
                    </tr>
                @endif
                </tbody>

            </table>
            <div class="d-flex justify-content-center">
                {{ $todo->links() }}
            </div>

        </div>
    </div>

</div>





<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Added tasks
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center ">

                    <h6>The tasks you didn't do yesterday</h6>
                    <div class="table-wrapper">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Todo item</th>
                            </tr>
                            </thead>
                            <tbody id="dd">
                            {{--            @dump($todo->count())--}}
                            @if($countyesterday)

                                @foreach($yesterday as $item)


                                    <tr id="deleterow">

                                        <td >{{$loop->index+1}}</td>
                                        <td>{{$item->name}}</td>

                                    </tr>

                                @endforeach

                            @else
                                <tr id="e">
                                    <td class="alert-danger" colspan="2">NO TASK FOUND</td>
                                </tr>
                            @endif
                            </tbody>

                        </table>
                        <h6>Do you want to add them to today's tasks?</h6>

                        <button  onclick="addtaskyes()" id="addtaskyes"   class="btn btn-primary">
                            ADDED
                        </button>


                    </div>
                </div>
            </div>

        </div>
    </div>
</div>








<footer class="footer py-3 mt-100 " >

    Created With <i class="ti-heart text-danger"></i> By <a href="http://mohammedsalhi.herokuapp.com/en" target="_blank"><span class="text-danger" title="Bootstrap 4 Themes and Dashboards">MohamedSalhi</span></a>

</footer>

<!-- core  -->
<script src="{{asset('assets/vendors/jquery/jquery-3.4.1.js')}}"></script>
<script src="{{asset('assets/vendors/bootstrap/bootstrap.bundle.js')}}"></script>

<!-- bootstrap 3 affix -->
<script src="{{asset('assets/vendors/bootstrap/bootstrap.affix.js')}}"></script>

<!-- Isotope  -->
<script src="{{asset('assets/vendors/isotope/isotope.pkgd.js')}}"></script>

<!-- Google mpas -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtme10pzgKSPeJVJrG1O3tjR6lk98o4w8&callback=initMap"></script>

<!-- JohnDoe js -->




<!-- row closed -->
@endsection
@section('script')
    <script>
        $('#comment-form').submit(function(e){
            e.preventDefault();

            $.ajax({
                type : 'post',
                url  : '{{route("todo")}}',
                data : {
                    _token:'{{csrf_token()}}',
                    name : $('#comment-form input').val()
                },
                success: function(res) {
                    $('#comment-form input').val('');
                    $('.comment-list').html(res);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            })

        })
    </script>



    <script>
        function addtaskyes(){

            $.ajax({
                type : 'post',
                url  : '{{route("addyestardat")}}',
                data : {
                    _token:'{{csrf_token()}}',
                },
                success: function(res) {
                    $('#comment-form input').val('');
                    $('.comment-list').html(res);
                    $("#exampleModal").modal('hide');
                    $('#dd').empty();


                },
                error: function (data) {
                    console.log('Error:', data);
                }
            })
        }

    </script>

    <script>
function deletetodo(id){

alert('are you sure')
    $.ajax({
        type : 'delete',
        url  : '{{route("destroy")}}',
        data : {
            _token:'{{csrf_token()}}',
            id : id
        },
        success: function(res) {
       $('#id'+id).remove()
            // if (res.success==0){
            //
            // }
            // $('e').append('<td class="alert-danger" colspan="4">'+ >NO TASK FOUND+'</td>')
            // // $('e').addClass('alert-danger')
        },
        error: function (data) {
            console.log('Error:', data);
        }
    })
        }

    </script>

    <script>


        function edittodo(id){

            $.ajax({
                type : 'post',
                url  : '{{route("update")}}',
                data : {
                    _token:'{{csrf_token()}}',
                    id : id
                },
                success: function(res) {

                    if(res.success=="Completed") {
                        $('#idss'+ id).text(res.success).removeClass('alert-danger').addClass('alert-success');
                    }else{

                        $('#idss'+ id).text(res.success).removeClass('alert-success').addClass('alert-danger');
                    }

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            })

        }



    </script>

@endsection

