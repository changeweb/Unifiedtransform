<?php

namespace App\Http\Controllers;

use App\Notification as Notification;
use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
      $msg = Notification::with('teacher.department')->where('student_id',$id)->orderBy('id','desc')->paginate(10);
      $msgs = [];
      foreach($msg as $m){
        $msgs[] = [
            'id' => $m->id,
            'active' => 0,
            'updated_at' => date('Y-m-d H:i:s'),
          ];
      }
      \Batch::update('notifications',(array) $msgs,'id');
      return view('message.all',['messages'=>$msg]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'section_id' => 'required|numeric',
        'teacher_id' => 'required|numeric',
        'recipients' => 'required|array',
        'msg' => 'required|string',
      ]);
      //DB::transaction(function () {
      for($i=0; $i < count($request->recipients); $i++){
        $tb = new Notification;
        $tb->sent_status = 1;
        $tb->active = 1;
        $tb->message = $request->msg;
        $tb->student_id = $request->recipients[$i];
        $tb->user_id = $request->teacher_id;
        $tb->created_at = date('Y-m-d H:i:s');
        $tb->updated_at = date('Y-m-d H:i:s');
        $n[] = $tb->attributesToArray();
      }
      Notification::insert($n);
      //});
      return back()->with('status',__('Message Sent'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new NotificationResource(Notification::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $tb = Notification::find($id);
      $tb->student_id = $request->student_id;
      $tb->message = $request->message;
      return ($tb->save())?response()->json([
        'status' => 'success'
      ]):response()->json([
        'status' => 'error'
      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      return (Notification::destroy($id))?response()->json([
        'status' => 'success'
      ]):response()->json([
        'status' => 'error'
      ]);
    }
}
