<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Ticket;
use Auth;

class RedemptionController extends Controller
{
    public function createTicket(Request $request) 
    {
        $rules = [
            'fname' => 'required|string|max:25',
            'lname' => 'required|string|max:25',
            'email' => 'required|email',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()]);
        }
        $ticket = Ticket::createTicket($request->fname, $request->lname, $request->email, Auth::User()->id);

        return response()->json(['status' => true, 'uuid' => $ticket->uuid]);
    }

    public function redeemTicket(Request $request) 
    {
        $rules = ['uuid' => 'required|uuid'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()]);
        }
        $result = Ticket::redeem($request->uuid);

        return response()->json($result);
    }
}
