<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class EmailsController extends Controller
{
    public function email()
    {
        
    }
//::raw($request->input('content'),function ($message) use($request){
//     $message->subject($request->title);
//     $message->to($request->email);
// });

}
