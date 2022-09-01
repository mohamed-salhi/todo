
@foreach($todo as $item)

    <tr id="id{{$item->id}}">

        <td >{{$loop->index+1}}</td>
        <td>{{$item->name}}</td>
        <td   id="idss{{$item->id}}">{{(!$item->status)?'In progress':'Completed'}}</td>
        <td>
            <div class="d-flex justify-content-between">
                   <button  id="deleteProduct"   onclick="deletetodo({{$item->id}})"  class="btn btn-danger">
                       Delete
                   </button>
                   <button id="editProduct"  onclick="edittodo({{$item->id}})"  class="btn btn-success">
                       Finished
                   </button>


           </div>
        </td>

    </tr>
@endforeach

