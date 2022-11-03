<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function attendance(Request $request)
    {
        if($request->hasFile('photo')){
            $request->file('photo')->store('attendance_photo', 'public');
            return response()->json(['status' => 200, 'message' => 'ada foto']);
        }

        return response()->json(['status' => 200, 'message' => 'tidak ada foto' ]);
    }
}
