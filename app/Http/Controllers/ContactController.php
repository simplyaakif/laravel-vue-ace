<?php

namespace App\Http\Controllers;
use App\Http\Resources\ContactResource;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::orderBy('id', 'desc')->paginate(30);
        return ContactResource::collection($contacts);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function sms(Contact $contact){

        $username = 'aceinstitute';
        $password = 'ayesha420';
        $to = $contact->contact_mobile;
        $from = 'ACE';
        $message = 'Thanks for submitting your query. Our staff will get back to you soon.';
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
        //Write out the response
        // echo $response ;
        return null;
    }

    public function email(Contact $contact){
        $data = [
            'title'=>'Online Contact Query Recieved',
            'content'=> 'Thank you for contacting us. Our staff is currently processing your request. We will get back to you soon. Your message was '.$contact->contact_message ,
            'email'=>$contact->contact_email,
            
        ];
    
        Mail::send('emails.test',$data, function($message) use ($contact){
            $message->to($contact->contact_email,'ACE - American Institute of English')->subject('Contact Form Recieved');
        });
        return null;
    }

    public function store(Request $request)
    {
        $contact = $request->isMethod('put') ? Contact::findOrFail($request->id) : new Contact;
        $contact->id = $request->input('id');
        $contact->contact_name = $request->input('contact_name');
        $contact->contact_mobile = str_replace("-","",$request->input('contact_mobile'));
        $contact->contact_email = $request->input('contact_email');
        if(!$request->input('id')){
            $contact->status = 'Pending';
        }
        else{
            $contact->status = $request->input('status');
        }
        $contact->contact_message = $request->input('contact_message');
        
        if($request->isMethod('post')){
            $this->sms($contact);
            $this->email($contact);
        }

        
        if($contact->save()){
            return new ContactResource($contact);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        $contact = Contact::findOrFail($contact->id);
        return new ContactResource($contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact = Contact::findOrFail($contact->id);
        if ($contact->delete()){
            return new ContactResource($contact);
        }
    }
}
