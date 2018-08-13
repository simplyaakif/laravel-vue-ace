<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function store(Request $request)
    {
        if($request->input('sms_mobile')){
            $sms = array(
                "sms_mobile"=>str_replace("-","",$request->input('sms_mobile')),
                "sms_message"=>$request->input('sms_message'),
            );
            $response=$this->sms($sms);
            return response()->json([
                'smsresponse' => $response,
            ]);
        }
        if($request->input('sms_email')){
            $sms = array(
                "sms_title"=>  $request->input('sms_title'),
                "sms_email"=>  $request->input('sms_email'),
                "sms_message"=>$request->input('sms_message'),
            );
            $response=$this->email($sms);
            return response()->json([
                'emailresponse' => $response,
            ]);
        }
    }

    public function email($sms){
        $data = [
            'title'=>   'Title',
            'content'=> $sms['sms_message'] ,
            'email'=>   $sms['sms_email'],
            
        ];
    
        Mail::send('emails.test',$data, function($message) use ($sms){
            $message->to($sms['sms_email'],'ACE - American Institute of English')->subject('Contact Form Recieved');
        });
        return 0;
    }

    public function sms($sms){
        $username = 'aceinstitute';
        $password = 'ayesha420';
        $to = $sms['sms_mobile'];
        $from = 'ACE';
        $message = $sms['sms_message'];
        $url = "http://Lifetimesms.com/plain?username=".$username."&password=" .$password.
        "&to=" .$to. "&from=" .urlencode($from)."&message=" .urlencode($message)."";
        //Curl Start
        $ch = curl_init();
        $timeout = 30;
        curl_setopt ($ch,CURLOPT_URL, $url) ;
        curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
        $response = curl_exec($ch) ;
        curl_close($ch) ; 
        return $response;
    }

}
