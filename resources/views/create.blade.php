
@extends('layouts.master')
    @section('title','Create Task')
    @section('content')
      <div class="row mt-5">
        <div class="col-sm-8 offset-sm-2">
          <form action="{{route('store')}}" method = "post">
            @csrf
            <div class="form-group">
              <label >Task title:</label>
              <input type="text" name = "task_title" id = "task_title" class="form-control" required>
            </div>
            <div class="form-group">
              <label >Task Description:</label>
              <input type="text" name = "description" id = "description" class="form-control" required>
            </div>
            <div class="form-group">
              <label >Task Assigned to:</label>
              <input type="text" name = "assigned_to" id = "assigned_to" class="form-control" required>
            </div>
            <div class="form-group">
              <label >Task Priority:</label>
              <div class="form-check form-check-inline ml-2" id="inline-radios">
                                    <input class="form-check-input" type="radio" name="priority"  value="LOW">
                                    <label class="form-check-label" for="inlineRadio1">LOW</label>
                                </div>
                                <div class="form-check form-check-inline ml-2">
                                    <input class="form-check-input" type="radio" name="priority"  value="MEDIUM">
                                    <label class="form-check-label" for="inlineRadio2">MEDIUM</label>
                                </div>
                                <div class="form-check form-check-inline ml-2">
                                    <input class="form-check-input" type="radio" name="priority"  value="HIGH">
                                    <label class="form-check-label" for="inlineRadio2">HIGH</label>
                                </div>
            </div>
            
            <div class="form-group">
              <label >Duration(in hrs):</label>
              <input type="number" name = "duration" id = "duration" class="form-control" required>
            </div>
            <div class="form-group">
              <label > Assign Date:</label>
              <input type="date" name = "date" id="datetimepicker" class=" date form-control" required>
            </div>
            <button type = "submit" class = "btn btn-success">Submit</button>
          </form>
        </div>
      </div>
    @endsection