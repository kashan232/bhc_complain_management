<?php

namespace App\Http\Controllers;

use App\Models\ComplainRemark;
use App\Models\Complaint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplainRemarkController extends Controller
{
    
    public function action_on_complaint(Request $request)
    {

        if (Auth::id()) {
            $complain_id = $request->input('complain_id');
            
            $complainRemark = ComplainRemark::create([
                'complain_id' => $request->input('complain_id'),
                'complain_cnic' => $request->input('complain_cnic'),
                'remark' => $request->input('remark'),
                'status' => $request->input('status'), // Corrected this line to use 'status'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        
            Complaint::where('id', $complain_id)->update([
                'status' => $request->input('status'),
                'updated_at' => Carbon::now()
            ]);
        
            if ($complainRemark) {
                return response()->json(['message' => 'Complaint remark saved successfully']);
            } else {
                return response()->json(['error' => 'Failed to save complaint remark'], 500);
            }
        } else {
            // User is not authenticated, return 401 unauthorized
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        

    }

}
