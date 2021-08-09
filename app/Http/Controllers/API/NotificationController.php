<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function send(Request $request)
    {
        return $this->sendNotification($request->device_token, array(
            "title" => "Sample Message",
            "body" => "This is Test message body"
        ));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function sendNotificatio($device_token, $message)
    {
        $SERVER_API_KEY = 'AAAAuF_j3Z0:APA91bHA3HT60bRLgcYvh_spCAUERJavZpMVtpEirZ4fRstzArIq0aDeICqHRDZ_NFIT6VdfuCMD_kqWW1XQiuDo3EZDXc3K5nhILfdsCsfXPhHC6S67kDJrZbNCGxCiRlm1mmhIPA3P';

        // payload data, it will vary according to requirement
        $data = [
            "to" => $device_token, // for single device id
            "data" => $message
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }

    public function sendNotifica($tokens, $message, $n)
    {
//        $url = 'https://fcm.googleapis.com/fcm/send';
////        $FcmToken = User::whereNotNull('device_key')->pluck('device_key')->all();
//        $FcmToken = ['5d1398f2cac616da'];
//
//        $serverKey = 'AAAAuF_j3Z0:APA91bHA3HT60bRLgcYvh_spCAUERJavZpMVtpEirZ4fRstzArIq0aDeICqHRDZ_NFIT6VdfuCMD_kqWW1XQiuDo3EZDXc3K5nhILfdsCsfXPhHC6S67kDJrZbNCGxCiRlm1mmhIPA3P';
//
//        $data = [
//            "registration_ids" => $FcmToken,
//            "notification" => [
//                "title" => $request->title,
//                "body" => $request->body,
//            ]
//        ];
//        $encodedData = json_encode($data);
//
//        $headers = [
//            'Authorization:key=' . $serverKey,
//            'Content-Type: application/json',
//        ];
//
//        $ch = curl_init();
//
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_POST, true);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
//        // Disabling SSL Certificate support temporarly
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
//
//        // Execute post
//        $result = curl_exec($ch);
//
//        if ($result === FALSE) {
//            die('Curl failed: ' . curl_error($ch));
//        }
//
//        // Close connection
//        curl_close($ch);
//
//        // FCM response
//        error_log($result);

        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'registration_ids' => $tokens,
            'priority' => "high",
            'notification' => $n,
            'data' => $message
        );

        //var_dump($fields);

        $headers = array(
            'Authorization:key = AAAAuF_j3Z0:APA91bHA3HT60bRLgcYvh_spCAUERJavZpMVtpEirZ4fRstzArIq0aDeICqHRDZ_NFIT6VdfuCMD_kqWW1XQiuDo3EZDXc3K5nhILfdsCsfXPhHC6S67kDJrZbNCGxCiRlm1mmhIPA3P',
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        error_log($result);
        return $result;
    }

    public function sendNotification(Request $request)
    {
        $uid = $request->uid;
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
    }
}
