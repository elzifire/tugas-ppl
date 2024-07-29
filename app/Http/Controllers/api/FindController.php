<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Find;

class FindController extends Controller
{

    // get data by user login and user_id = 1 and have limit in everyday
    public function index()
    {
        $find = Find::where('user_id', auth()->user()->id)->whereDate('created_at', now())->get();

       if ($find) {
        return response()->json([
            'message' => 'Success',
            'data' => $find
        ]);
       }else{
        return response()->json([
            'message' => 'Failed',
        ]);
       }
    }

    public function show($id)
    {
        $find = Find::find($id)->where('user_id', auth()->user()->id)->where('created_at', now())->get();

        if ($find) {
            return response()->json([
                'message' => 'Success',
                'data' => $find
            ]);
        }else{
            return response()->json([
                'message' => 'Failed',
            ]);
        }
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
        ]);

        $find = Find::create($request->all());

        if ($find) {
            return response()->json([
                'message' => 'Success',
                'data' => $find
            ], 200);
        }else{
            return response()->json([
                'message' => 'Failed',
            ], 500);
        }
    }
   
    
}
