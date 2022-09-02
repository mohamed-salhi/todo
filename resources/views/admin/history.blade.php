@extends('admin.master')
@section('title','emailtodo')
@section('content')

    <div class="app-container ">
        <form method="get" action="#">
            <div class="row">
                <div class="col-10">
                    <input value="{{request()->sarech}}" name="sarech" placeholder="Sarech" type="date"  id="datepicker-action" data-date-format="yyyy-mm-dd" class="form-control" />
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary">
                        Sarech
                    </button>
                </div>
            </div>
        </form>
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>No.</th>
                <th>Todo item</th>
                <th>status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="dd">
            @if($count)

                @foreach($tasks as $item)


                    <tr id="deleterow{{$item->id}}">

                        <td >{{$loop->index+1}}</td>
                        <td >{{$item->name}}</td>
                        <td class="{{(!$item->status)?'alert-danger':'alert-success'}}"  id="idss{{$item->id}}">{{(!$item->status)?'In progress':'Completed'}}</td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <button  id="deleteProduct"   onclick="deletetodo({{$item->id}})"  class="btn btn-danger">
                                    Delete
                                </button>
                            </div>
                        </td>

                    </tr>

                @endforeach

            @else
                <tr id="e">
                    <td class="alert-danger" colspan="2">NO TASK FOUND</td>
                </tr>
            @endif
            </tbody>

        </table>
        <div class="d-flex justify-content-center">
            {{ $tasks->links() }}
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
    <script src="{{asset('assets/js/johndoe.js')}}"></script>



    <!-- row closed -->
@endsection
@section('script')


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
                    $('#deleterow'+id).remove()
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


@endsection

