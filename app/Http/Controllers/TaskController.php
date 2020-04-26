<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use DB;
use Response;

class TaskController extends Controller
{
    public function index(Request $request)
    {
       
        $query = Task::query();

if (!empty($request->input('status'))) {
    $query->where('status' ,$request->status);
}

if (!empty($request->input('priority'))) {
    $query->where('priority', $request->priority);
}
if (!empty($request->input('assigned_to'))) {
    $query->where('assigned_to', $request->assigned_to);
}

$from=$request->input('from');
$to=$request->input('to');
if (!empty($from) && !empty($to) ) {
    $query->whereBetween('date', [$from,$to]);
}

$tasks=$query->paginate(5);



$assigned=DB::select("select assigned_to from tasks group by assigned_to");
        return view('index',['tasks'=>$tasks,'assigned'=>$assigned]);
    }
    public function create()
    {
        //Return view to create task
        return view('create');
    }

    public function store(Request $request)
    {
        $task = new Task();
        $task->task_title = $request->input('task_title');
        $task->description = $request->input('description');
        $task->assigned_to = $request->input('assigned_to');
        $task->priority = $request->input('priority');
        $task->duration = $request->input('duration');
        $task->date = $request->input('date');
        $task->save(); 
        return redirect()->route('index')->with('info','Task Added Successfully');
    }

    public function changeStatus(Request $request)

    {

        $task = Task::find($request->id);

        $status = ($task->status==2) ? 1 : 2;
        $task->status = $status;

        $task->save();

  

        return response()->json(['status'=>$status,'success'=>'Status change successfully.']);

    }
    public function exportCSV()
    {
        $table = Task::select('tasks.*',DB::raw("if(status=1,'Pending','Complete') as done"))->get();
        $filename = "tasks.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Title', 'Description', 'Priority', 'Duration','Date','Status'));
    
        foreach($table as $row) {
            fputcsv($handle, array($row['task_title'], $row['description'], $row['priority'], $row['duration'], $row['date'],$row['done']));
        }
    
        fclose($handle);
    
        $headers = array(
            'Content-Type' => 'text/csv',
        );
    
        return Response::download($filename, 'tasks.csv', $headers);
    }
    
}
