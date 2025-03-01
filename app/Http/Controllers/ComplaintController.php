<?php

namespace App\Http\Controllers;

use App\Models\ComplainRemark;
use App\Models\Complaint;
use App\Models\Contact;
use App\Models\District;
use App\Models\Tehsil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ComplaintController extends Controller
{

    public function home(Request $request)
    {

        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;

            if ($usertype == 'user') {
                return view('user.user_dashboard');
            } else if ($usertype == 'admin') {

                $districtComplaints = District::select('district_name', 'coordinates', \DB::raw('COUNT(*) as total'))
                    ->join('complaints', 'districts.district_name', '=', 'complaints.district')
                    ->groupBy('district_name', 'coordinates')
                    ->get();

                // Convert the collection to a standard PHP array
                $districtsData = $districtComplaints->toArray();

                // dd($districtsData);
                $districtCount = District::count();
                $tehsilCount = Tehsil::count();
                $totalComplains = Complaint::count();
                $ClosedComplains = Complaint::where('status', 'Closed')->count();
                $InProcessComplains = Complaint::where('status', 'In process')->count();
                $NotProcessComplains = Complaint::where('status', 'Not Process Yet')->count();

                // $totalCount = $districtCount + $tehsilCount;

                $districts = District::all();



                return view('admin.admin_dashboard', ['districtCount' => $districtCount, 'tehsilCount' => $tehsilCount, 'totalComplains' => $totalComplains, 'ClosedComplains' => $ClosedComplains, 'InProcessComplains' => $InProcessComplains, 'NotProcessComplains' => $NotProcessComplains, 'districts' => $districts,  'districtsData' => json_encode($districtsData)]);
            } else {
                return redirect()->back();
            }
        }
        // return view('dashboard');
    }
    public function homechart(Request $request)
    {
        $districtName = $request->input('districtName');

        $notProcessCount = Complaint::where('district', $districtName)->where('status', 'Not Process Yet')->count();
        $inProcessCount = Complaint::where('district', $districtName)->where('status', 'In process')->count();
        $closedCount = Complaint::where('district', $districtName)->where('status', 'Closed')->count();

        return response()->json([
            'districtName' => $districtName,
            'notProcessCount' => $notProcessCount,
            'inProcessCount' => $inProcessCount,
            'closedCount' => $closedCount,
        ]);
    }
    public function all_complaints()
    {
        if (Auth::id()) {
            // Retrieve all complaints sorted by ID in descending order
            $all_complaints = Complaint::orderBy('id', 'desc')->paginate(30);
            // dd($all_complaints);
            return view('admin.complaints.all_complaints', ['all_complaints' => $all_complaints]);
        } else {
            // User is not authenticated, return 401 unauthorized
            abort(401);
        }
    }

    public function not_process_complaints()
    {
        if (Auth::id()) {
            // Retrieve all complaints sorted by ID in descending order
            $not_process_complaints = Complaint::where('status', 'Not Process Yet')->orderBy('id', 'desc')->paginate(30);
            // dd($not_process_complaints);
            return view('admin.complaints.not_process_complaints', ['not_process_complaints' => $not_process_complaints]);
        } else {
            // User is not authenticated, return 401 unauthorized
            abort(401);
        }
    }

    public function in_process_complaints()
    {
        if (Auth::id()) {
            // Retrieve all complaints sorted by ID in descending order
            $In_process_complaints = Complaint::where('status', 'In process')->orderBy('id', 'desc')->paginate(30);
            // dd($not_process_complaints);
            return view('admin.complaints.in_process_complaints', ['In_process_complaints' => $In_process_complaints]);
        } else {
            // User is not authenticated, return 401 unauthorized
            abort(401);
        }
    }

    public function closed_complaints()
    {
        if (Auth::id()) {
            // Retrieve all complaints sorted by ID in descending order
            $Closed_complaints = Complaint::where('status', 'Closed')->orderBy('id', 'desc')->paginate(30);
            // dd($Closed_complaints);
            return view('admin.complaints.closed_complaints', ['Closed_complaints' => $Closed_complaints]);
        } else {
            // User is not authenticated, return 401 unauthorized
            abort(401);
        }
    }
    
    public function Incomplete_complaints()
    {
        if (Auth::id()) {
            // Retrieve all complaints sorted by ID in descending order
            $Incomplete_complaints = Complaint::where('status', 'Incomplete')->orderBy('id', 'desc')->paginate(30);
            // dd($Incomplete_complaints);
            return view('admin.complaints.Incomplete_complaints', ['Incomplete_complaints' => $Incomplete_complaints]);
        } else {
            // User is not authenticated, return 401 unauthorized
            abort(401);
        }
    }


    public function view_complaints($id, $cnic)
    {
        if (Auth::id()) {
            // Retrieve all complaints sorted by ID in descending order
            // $view_complaints = Complaint::FindOrFail($id);
            $view_complaints = Complaint::where('id', $id)
                ->where('cnic', $cnic)
                ->firstOrFail();
            // Retrieve the related complaint remarks
            $complaint_remarks = ComplainRemark::where('complain_id', $view_complaints->id)
                ->where('complain_cnic', $view_complaints->cnic)
                ->get();

            // dd($complaint_remarks);
            return view('admin.complaints.view_complaints', ['view_complaints' => $view_complaints, 'complaint_remarks' => $complaint_remarks]);
        } else {
            // User is not authenticated, return 401 unauthorized
            abort(401);
        }
    }

    public function all_District()
    {
        if (Auth::id()) {
            // Retrieve all complaints sorted by ID in descending order
            $all_districts = District::all();
            // dd($all_complaints);
            return view('admin.all_districts', ['all_districts' => $all_districts]);
        } else {
            // User is not authenticated, return 401 unauthorized
            abort(401);
        }
    }

    public function all_Talukas()
    {
        if (Auth::id()) {
            $Talukas = Tehsil::all();
            // dd($all_complaints);
            return view('admin.all_talukas', ['Talukas' => $Talukas]);
        } else {
            // User is not authenticated, return 401 unauthorized
            abort(401);
        }
    }


    public function Reporting_by_date()
    {
        return view('admin.reports.Reporting_by_date');
    }

    public function Reporting_by_filters()
    {
        $Districts = District::all();
        return view('admin.reports.Reporting_by_filters', ['Districts' => $Districts]);
    }

    public function Reporting_by_districts()
    {
        $Districts = District::all();
        return view('admin.reports.Reporting_by_districts', ['Districts' => $Districts]);
    }

    public function Reporting_by_search()
    {
        return view('admin.reports.Reporting_by_search');
    }
    public function get_talukas_report(Request $request)
    {
        $selectedDistrict = $request->input('district');
        // Perform logic to fetch talukas based on the selected district
        $talukas = Tehsil::where('district_id', $selectedDistrict)->pluck('tehsil_name')->toArray();
        return response()->json(['talukas' => $talukas]);
    }
    public function search_complaints_by_cnic(Request $request)
    {
        $cnic = $request->input('cnic');
        // Perform your query to search complaints by CNIC
        $complaints = Complaint::where('cnic', $cnic)->get();
        return response()->json(['complaints' => $complaints]);
    }

    public function search_complaints_by_date(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate') . ' 23:59:59'; // Add the end of the day
        $complaints = Complaint::whereBetween('created_at', [$startDate, $endDate])->paginate(30);
        return view('admin.reports.search_complaints_by_date', ['complaints' => $complaints]);
    }

    public function search_complaints_by_filters(Request $request)
    {
        $district = $request->input('district');
        $taluka = $request->input('taluka');
        // dd($district, $taluka);
        $complaints = Complaint::where('district', $district)->where('taluka', $taluka)->paginate(30);
        // dd($complaints);
        return view('admin.reports.search_complaints_by_filters', ['complaints' => $complaints]);
    }


    public function search_complaints_by_districts(Request $request)
    {
        $district = $request->input('district');
        
        $complaints = null;

        if ($district === 'All') {
            // Retrieve data for all districts
            $complaints = Complaint::paginate(30); // Assuming Complaint is your model name
        } else {
            // Retrieve data for the selected district
            $complaints = Complaint::where('district', $district)->paginate(30);; // Assuming 'district' is the field name in your Complaint model
        }

        return view('admin.reports.search_complaints_by_districts', ['complaints' => $complaints]);
    }

    
    public function Reporting_by_type()
    {
        return view('admin.reports.Reporting_by_type');
    }

    public function search_complaints_by_type(Request $request)
    {
        $nature_of_complaint = $request->input('nature_of_complaint');
        $complaints = Complaint::where('nature_of_complaint', $nature_of_complaint)->paginate(30);
        // dd($complaints);
        return view('admin.reports.search_complaints_by_type', ['complaints' => $complaints]);
    }
    
    public function form(Request $request)
    {
        return view('admin.form');
    }

    public function complain_form(Request $request)
    {
        return view('admin.complain_form');
    }

    public function get_districts(Request $request)
    {
        try {
            $districts = District::all()->pluck('district_name');

            return response()->json([
                'success' => true,
                'data' => $districts,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching districts',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getTalukas(Request $request)
    {
        try {
            $selectedDistrict = $request->input('district');

            // Perform logic to fetch talukas based on the selected district
            $talukas = Tehsil::where('district_id', $selectedDistrict)->pluck('tehsil_name');

            return response()->json([
                'success' => true,
                'data' => $talukas, // Replace with actual talukas data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching talukas',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function store_complain(Request $request)
    {
        try {
            // Check if a similar complaint already exists with the same CNIC and nature of complaint
            $existingComplaint = Complaint::where('cnic', $request->input('cnic'))
                ->where('nature_of_complaint', $request->input('nature_of_complaint'))
                ->first();
    
            if ($existingComplaint) {
                return response()->json([
                    'message' => 'Complaint is already registered',
                    'status' => 'Duplicate'
                ], 409);
            }
    
            // If no duplicate complaint, create a new one
            $complains = Complaint::create([
                'name' => $request->input('name'),
                'fathername' => $request->input('fathername'),
                'cnic' => $request->input('cnic'),
                'district' => $request->input('district'),
                'taluka' => $request->input('taluka'),
                'contact' => $request->input('contact'),
                'nature_of_complaint' => $request->input('nature_of_complaint'),
                'other_descrpition' => $request->input('other_descrpition'),
                'status' => 'Not Process Yet',
            ]);
    
            if ($complains) {
                return response()->json([
                    'message' => 'Your complaint has been successfully submitted.',
                    'status' => 'Success'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Try Again',
                    'status' => 'Failed'
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function store_contact(Request $request)
    {
        // Validate Input Fields
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Store Contact Data
        $contact = Contact::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Contact form submitted successfully!',
            'data'    => $contact
        ], 201);
    }

    public function contacts()
    {
        if (Auth::id()) {
            // Retrieve all complaints sorted by ID in descending order
            $Contacts = Contact::all();
            // dd($Contacts);
            return view('admin.contacts', ['Contacts' => $Contacts]);
        } else {
            // User is not authenticated, return 401 unauthorized
            abort(401);
        }
    }

}
