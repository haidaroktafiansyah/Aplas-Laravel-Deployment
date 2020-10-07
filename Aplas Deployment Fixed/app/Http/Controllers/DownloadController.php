<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DownloadController extends Controller
{
  public function downLearning($file_name, $topic_name, $doctype) {
    $dirname = str_replace('\\',DIRECTORY_SEPARATOR,'app\public\learning\\');
    $file_path = storage_path($dirname.$file_name);
    $ext = pathinfo($file_path, PATHINFO_EXTENSION);
    $headers = array('Content-Type' => 'application/zip','Content-Type' => 'application/rar');
    return response()->download($file_path, $topic_name.'-'.$doctype.'.'.$ext, $headers);
  }

  public function downGuide($file_name, $topic_name) {
    return $this->downLearning($file_name,$topic_name,'GuideDocuments');
  }

  public function downTest($file_name, $topic_name) {
    return $this->downLearning($file_name,$topic_name,'TestFiles');
  }

  public function downSupplement($file_name, $topic_name) {
    return $this->downLearning($file_name,$topic_name,'SupplementFiles');
  }

  public function downOther($file_name, $topic_name) {
    return $this->downLearning($file_name,$topic_name,'OtherFiles');
  }

  /*
  public function download(Request $request){
        //PDF file is stored under project/public/download/info.pdf
        $file="./".$request->get('fileid');
        return Response::download($file);
    }
    */
    /*
    public function download($file_name) {
      $file_path = public_path('files/'.$file_name);
      return response()->download($file_path);
    }
    */
}
