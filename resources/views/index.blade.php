
@extends('layouts.master')
    @section('title','Task Index')
    @section('content')

    <form  action="{{route('index')}}">
            <div class="row mt-5">
            <div class="col-lg-4"> 
            <div class="form-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Status</span>
                                <div class="form-check form-check-inline ml-2" id="inline-radios">
                                    <input class="form-check-input" type="radio" name="status"  value="1">
                                    <label class="form-check-label" for="inlineRadio1">Pending</label>
                                </div>
                                <div class="form-check form-check-inline ml-2">
                                    <input class="form-check-input" type="radio" name="status"  value="2">
                                    <label class="form-check-label" for="inlineRadio2">Complete</label>
                                </div>
                            </div>
                        </div>
    </div>
          <div class="col-lg-4"> 
          <div class="input-group mb-3">
             <div class="input-group-prepend">
               <label class="input-group-text" >Priority</label>
             </div>
             <select class="custom-select" name="priority">
               <option selected value="">Choose </option>
               <option value="LOW">LOW</option>
               <option value="HIGH">HIGH</option>
               <option value="MEDIUM">MEDIUM</option>
             </select>
            </div>
            </div>
            <div class="col-lg-4"> 
            <div class="input-group mb-3">
             <div class="input-group-prepend">
               <label class="input-group-text" >Assigned to</label>
             </div>
             <select class="custom-select" name="assigned_to">
               <option selected value="">Choose</option>
               @foreach($assigned as $assign)
               <option value="{{$assign->assigned_to}}">{{$assign->assigned_to}}</option>
               @endforeach
             </select>
            </div>
            </div>
            <div class="col-lg-4"> 
            <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">From Date</span>
                                </div>
                                <input type="date" name="from"  class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text"  ><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="col-lg-4"> 
            <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">To Date</span>
                                </div>
                                <input type="date" name="to"  class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text"  ><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        </div>
          <div class="col-lg-2"><button type="submit" class="btn btn-warning srch">Search</button></div></div>
          </form>

      <div class="row mt-3">
        <div class="col-sm-12">
        <table class="table">
            <thead class="text-center"> 
              <th>#</th>
              <th>Task Title</th>
              <th>Task Description</th>
              <th>Assigned to</th>
              <th>Priority</th>
              <th>Duration</th>
              <th>Task Date</th>
              <th>Status</th>
            </thead>
            @foreach($tasks as $key => $task)
              <tr class = "text-center">
                <td>{{ $tasks->perPage() * ($tasks->currentPage() - 1)}}</td>
                <td>{{ $task->task_title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->assigned_to }}</td>
                <td>{{ $task->priority }}</td>
                <td>{{ $task->duration }}</td>
                <td>{{ $task->date }}</td>
                <td>  <a href="javascript:;" onClick="changestatus({{$task->id}},{{$task->status}})"><span class="badge <?php echo (($task->status==1) ? 'badge-danger':'badge-success'); ?>" id="statusid{{$task->id}}">{{($task->status==1) ? 'Pending' : 'Complete'}}</span></a>
</td>
              </tr>
            @endforeach
          </table>
          {{ $tasks->links() }}
        </div>
      </div>
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      
      <script>
         function changestatus(id,status){
            $.ajax({
               type:'GET',
               url:'/changestatus',
               data:{status:status,id:id},
               success:function(data) {
                  if(data.status==2){
					$("#statusid"+id).text('Complete'); 
					$("#statusid"+id).removeClass('badge-danger');
					$("#statusid"+id).addClass('badge-success');
				  }else if(data.status==1){
					$("#statusid"+id).text('Pending'); 
					$("#statusid"+id).removeClass('badge-success');
					$("#statusid"+id).addClass('badge-danger');
				  }
				  else{
					$("#statusid"+id).text('Complete'); 
					$("#statusid"+id).removeClass('badge-danger');
					$("#statusid"+id).addClass('badge-success');
					}
               }
            });
         }
      </script>
    @endsection
    