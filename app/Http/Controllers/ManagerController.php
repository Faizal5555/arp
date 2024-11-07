<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Manager;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientExport;
use Auth;

class ManagerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if($user->user_type=="admin"){
            $manager = Manager::paginate(5);
        }else{
            $manager = Manager::where('user_id',$user->id)->paginate(5);
        }
        
        // dd($user);
        return view('manager.index', compact('manager'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manager="";
        $country = Country::get();
        return view('manager.create',compact('manager','country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        // dd($req->all());
        $v = $req->all();
        
        $validator = Validator::make(
            $v,
            []
        );

        if (!$validator->fails()) {
            $manager = new Manager();
            $manager->name = $req->name;
            $manager->address = $req->address;
            $manager->phone_no = $req->phone_no;
            $manager->whatsapp_no = $req->whatsapp_no;
            $manager->experiance = $req->experiance;
            $manager->others = $req->others;
            $manager->qualification = $req->qualification;
            $manager->country = $req->country;
            $manager->email = $req->email;
            $manager->photo = $req->photo;
            $manager->other_document = $req->other_document;
            $manager->user_id = auth()->user()->id;
            if ($req->hasFile('other_document'))
            {
                $file = $req->file('other_document');
                // $time =  Carbon::now()->timestamp;
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' .$extension;
                $file->move('global_assets/other_documents', $filename);
                $manager->other_document = 'global_assets/other_documents/' . $filename;
            }
            if ($req->has('photo'))
            {
                $file = $req->file('photo');
                // $time =  Carbon::now()->timestamp;
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' .$extension;
                $file->move('global_assets/photo', $filename);
                $manager->photo = 'global_assets/photo/' . $filename;
            }
            if ($manager->save()) {
                $response_data = ["success" => 1, "message" => "Manager Created Successfully"];
            } else {
                $response_data = ["success" => 0, "message" => "Site Server Error"];
            }
        } else {
            $response_data = ["success" => 0, "message" => "Site Server Error", "error" => $validator->errors()];
        }
        return response()->json($response_data);
    }

    public function edit($id)
    {
        $user = Auth::user();
        $manager = Manager::where('id', $id)->where('id',$user->id)->first();

        return view('manager.create', compact('manager'));
    }

    public function update(Request $req)
    {
        $v = $req->all();

        $validator = Validator::make(
            $v,
            []
        );

        if (!$validator->fails()) {
            $manager = Manager::where('id', $req->id)->first();
            $manager->name = $req->name;
            $manager->address = $req->address;
            $manager->phone_no = $req->phone_no;
            $manager->whatsapp_no = $req->whatsapp_no;
            $manager->experiance = $req->experiance;
            $manager->others = $req->others;
            $manager->qualification = $req->qualification;
            $manager->country = $req->country;
            $manager->email = $req->email;
            $manager->user_id = auth()->user()->id;
            if ($req->hasFile('other_document'))
            {
                $file = $req->file('other_document');
                // $time =  Carbon::now()->timestamp;
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' .$extension;
                $file->move('global_assets/other_documents', $filename);
                $manager->other_document = 'global_assets/other_documents/' . $filename;
            }
            if ($req->has('photo'))
            {
                $file = $req->file('photo');
                // $time =  Carbon::now()->timestamp;
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' .$extension;
                $file->move('global_assets/photo', $filename);
                $manager->photo = 'global_assets/photo/' . $filename;
            }
            if ($manager->save()) {
                $response_data = ["success" => 1, "message" => "Manager Updated Successfully"];
            } else {
                $response_data = ["success" => 0, "message" => "Site Server Error"];
            }
        } else {
            $response_data = ["success" => 0, "message" => "Site Server Error", "error" => $validator->errors()];
        }

        return response()->json($response_data);
    }

    public function delete(Request $req)
    {
        $id=$req->data;

        $school= Manager::where('id',$id)->delete();

        if($school)
        {
            $response_data = ["success" => 1, "message" => "Client Deleted Successfully"];

        }else{
            $response_data = ["success" => 0, "message" => "Site Server Error"];
        }

        return response()->json($response_data);
    }
    public function export() 
    {
        return Excel::download(new ClientExport, 'manager.xlsx');
    }
}

