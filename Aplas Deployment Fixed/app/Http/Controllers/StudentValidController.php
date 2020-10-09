<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Redirect;
use Session;

class StudentValidController extends Controller
{
  private function getListStudent($teacher) {
    return \App\StudentTeacher::where('teacher','=',$teacher)
              ->select('users.id','users.name','users.email')
              ->join('users','users.id','=','student_teachers.student')
              ->orderBy('users.name','asc')
              ->get();
  }
  public function index(Request $request)
  {
      if (Auth::user()->roleid=='student') {
        $filter = Auth::user()->id;
      } else {
        $student = $this->getListStudent(Auth::user()->id);
        $filter = $request->input('stdList',($student->count()>0)?$student[0]['id']:'');
      }

      $entities=\App\StudentSubmit::where('student_submits.userid','=',$filter)
        ->select('topics.id', 'topics.name', 'task_results_group_student.passed',
                'task_results_group_student.failed', 'task_results_group_student.avg_duration',
                'task_results_group_student.tot_duration', 'student_submits.checkstat','student_submits.checkresult',
                'student_validations_pertopic.failed as vfailed', 'student_validations_pertopic.passed as vpassed')
        ->leftJoin('task_results_group_student', function($join)
              {
                $join->on('task_results_group_student.userid','=','student_submits.userid');
                $join->on('task_results_group_student.topic','=','student_submits.topic');
              }
            )
        ->leftJoin('student_validations_pertopic', function($join2)
              {
                $join2->on('student_validations_pertopic.userid','=','student_submits.userid');
                $join2->on('student_validations_pertopic.topic','=','student_submits.topic');
              }
            )
          ->join('topics','topics.id','=','student_submits.topic')
          ->orderBy('topics.name','asc')
          ->get();



      if (Auth::user()->roleid=='student') {
        $data=['entities'=>$entities];
        return view('student/valid/index')->with($data);
      } else {
        /*
        $student = \App\StudentTeacher::where('teacher','=',Auth::user()->id)
                  ->select('users.id','users.name','users.email')
                  ->join('users','users.id','=','student_teachers.student')
                  ->orderBy('users.name','asc')
                  ->get();
                  */
        $data=['entities'=>$entities, 'items'=>$student, 'filter'=>$filter];
        return view('teacher/studentres/index')->with($data);
      }
  }

  private function getDataShow($student, $id) {
    $entities=\App\StudentValidation::where('student_validations.userid','=',$student)
      ->select('tasks.taskno','tasks.desc', 'test_files.fileName', 'student_validations.status',
              'student_validations.report', 'student_validations.created_at', 'student_validations.duration')
      ->join('test_files', function($join)
            {
              $join->on('student_validations.testid','=','test_files.id');
            }
          )
      ->join('tasks', function($join)
            {
              $join->on('tasks.id','=','test_files.taskid');
            }
          )
        ->where('tasks.topic','=',$id)
        ->orderBy('tasks.taskno','asc')
        ->orderBy('test_files.fileName','asc')
        ->get();

    $topic =\App\Topic::find($id);
    $user = \App\User::find($student);
    $data=['entities'=>$entities, 'topic'=>$topic, 'student'=>$user];

    return $data;
  }

  public function show($id)
  {
      //
      /*
      $entities=\App\StudentValidation::where('student_validations.userid','=',Auth::user()->id)
        ->select('tasks.taskno','tasks.desc', 'test_files.fileName', 'student_validations.status',
                'student_validations.report', 'student_validations.created_at')
        ->join('test_files', function($join)
              {
                $join->on('student_validations.testid','=','test_files.id');
              }
            )
        ->join('tasks', function($join)
              {
                $join->on('tasks.id','=','test_files.taskid');
              }
            )
          ->where('tasks.topic','=',$id)
          ->orderBy('tasks.taskno','asc')
          ->orderBy('test_files.fileName','asc')
          ->get();

      $topic =\App\Topic::find($id);
      */
      $data=$this->getDataShow(Auth::user()->id,$id);

      return view('student/valid/show')->with($data);
  }

  public function showteacher($student,$id)
  {
      //
      $data=$this->getDataShow($student,$id);

      return view('teacher/studentres/show')->with($data);
  }
}