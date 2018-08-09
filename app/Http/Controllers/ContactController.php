<?php

namespace App\Http\Controllers;
use App\Http\Resources\ContactResource;
use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::orderBy('id', 'desc')->paginate(5);
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
        $message = 'Test SMS from Lifetimesms.com';
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
        echo $response ;

        return null;
    }

    public function store(Request $request)
    {
        $contact = $request->isMethod('put') ? Contact::findOrFail($request->id) : new Contact;
        $contact->id = $request->input('id');
        $contact->contact_name = $request->input('contact_name');
        $contact->contact_mobile = $request->input('contact_mobile');
        $contact->contact_message = $request->input('contact_message');
        
        // $this->sms($contact);

        
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
