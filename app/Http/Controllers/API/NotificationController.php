<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\Notify;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function sendNotification(Request $request)
    {
        $uid = $request->uid;
        error_log($uid);
        $title = $request->title;
        $body = $request->body;

        $msg = array
        (
            'body' => $body,
            'title' => $title,
//            'icon' => 'myicon',/*Default Icon*/
//            'sound' => 'mySound'/*Default sound*/
        );

        $d = array(
            'clickaction' => 'FLUTTERNOTIFICATIONCLICK',
            'id' => '1',
            'status' => 'done',
        );

        $fields = array
        (
            'to' => '/topics/' . $uid,
            'notification' => $msg,
            'data' => $d,
            'priority' => 'high',
        );


        $headers = array
        (
            'Authorization: key= AAAAuF_j3Z0:APA91bHA3HT60bRLgcYvh_spCAUERJavZpMVtpEirZ4fRstzArIq0aDeICqHRDZ_NFIT6VdfuCMD_kqWW1XQiuDo3EZDXc3K5nhILfdsCsfXPhHC6S67kDJrZbNCGxCiRlm1mmhIPA3P',
            'Content-Type: application/json'
        );

#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);

        error_log($result);

        return response()->json([], 200);
    }

    public function saveNotification(Request $request)
    {
        $user_id = $request->user_id;
        error_log($user_id);
        $title = $request->title;
        $body = $request->body;
        $notification_type_id = $request->notification_type_id;
        error_log($title);
        error_log($body);

        $notify = Notify::create([
            'title' => $title,
            'body' => $body,
            'user_id' => $user_id,
            'notification_type_id' => $notification_type_id,
        ]);
        $notify->save();
        return response()->json(['notify' => $notify], 200);
    }

    public function getNotification()
    {
        $user_id = auth()->user()->id;

        $notify = Notify::where('user_id', $user_id)->with('notifyType')->get();

        return response()->json(['notify' => $notify], 200);
    }
}
