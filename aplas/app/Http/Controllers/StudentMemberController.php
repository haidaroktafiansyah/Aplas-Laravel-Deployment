<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Redirect;
use Session;

class StudentMemberController extends Controller
{
  public function index()
  {
      /*
      $entities=\App\StudentTeacher::where('student_teachers.teacher','=',Auth::user()->id)
        ->select('users.id', 'users.name', 'users.roleid', 'users.email','student_submits_count.count','student_submits_count.topicname')
          ->join('users','users.id','=','student_teachers.student')
          ->leftJoin('student_submits_count','users.id','=','student_submits_count.userid')
          ->orderBy('users.name','asc')
          ->get();
*/
          $entities=\App\User::where('users.uplink','=',Auth::user()->id)->where('users.status','=','active')
      ->select('users.id', 'users.name', 'users.roleid', 'users.email','student_submits_count.count','student_submits_count.topicname')
        ->leftJoin('student_submits_count','users.id','=','student_submits_count.userid')
        ->orderBy('users.name','asc')
        ->get();



      $data=['entities'=>$entities];

      return view('teacher/member/index')->with($data);
  }

  public function detail($id)
  {
    $entities=\App\User::where('users.id','=',$id)
    ->join('class_members','users.id', '=', 'class_members.student')
    ->join('classrooms','classrooms.id', '=', 'class_members.classid')
    ->select('users.id','users.name','users.email','users.status','classrooms.name as classname')
    ->orderBy('users.name','asc')->get();

    $classroom=\App\Classroom::where('owner','=',Auth::user()->id)
    ->pluck('name', 'id');

    $data=[ 'entity'=>$entities , 'classroom' => $classroom];
    // dd($data,$id);
    return view('teacher/editstudent/index')->with($data);
  }

  public function edit(Request $request)
  {
    $student = $request->get('invisible2');

    // dd($student);

    $classroom=\App\ClassMember::where('student','=', $request->get('invisible'))
    ->update([
        'classid' => $request->get('classroom')
    ]);

    // dd($classroom);
    return redirect('teacher/member')->with('message', 'class of '.$student.' has been updated');;
    }

  public function show()
  {
    $entities=\App\User::where('users.uplink','=',Auth::user()->id)->where('users.status','=','active')
      ->select('users.id', 'users.name', 'users.roleid', 'users.email','student_submits_count.count','student_submits_count.topicname')
        ->leftJoin('student_submits_count','users.id','=','student_submits_count.userid')
        ->orderBy('users.name','asc')
        ->get();

    $data=['entities'=>$entities];

    return view('teacher/member/index')->with($data);
  }

  public function destroy(Request $request, $id)
  {
      //
      //$entity = \App\StudentTeacher::where('student','=',$id);
      //$entity->delete();

      $entity = \App\User::find($id);
      $entity->status='deleted';
      $entity->save();
      //
      Session::flash('message','Student Member with Name='.$entity->name.' is deleted');
      return Redirect::to('/teacher/member');
  }
}
