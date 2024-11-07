<?php

namespace App\Http\Controllers;
use App\Models\datacenternew;
use App\Models\doctorDocuments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Speciality;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Redirect;

class docterController extends Controller
{
  public function getdoctor(){
    //   dd("hi");
    // dd(Auth::user()->id);
      $doctor=datacenternew::where('user_id',Auth::user()->id)->first();
    //   dd($doctor);
      $country=Country::get();
      $speciality=Speciality::get();
      return view('DataCenter.DocterDashboard',compact('doctor','country','speciality'));
  }
  public function documents_view()
  {
    $doctor=datacenternew::where('user_id',Auth::user()->id)->first();
      return view('doctor.document_upload',compact('doctor'));
  }
  public function document_store(Request $req)
  {
    $v = $req->all();
    $response_data = [];
    $validator = Validator::make(
        $v,
        // ['document' => 'mimes:jpeg,png,bmp,tiff |max:4026',]
        ["document" => "required|mimes:pdf,jpeg,png,bmp|max:10000",]
    );
        if (!$validator->fails()) {
      $doctor_doc = new doctorDocuments();
      // $doctor_img=datacenternew::where('id',$req->docter_id)->first();
      $doctor_doc->doctor_id=$req->docter_id;
      if ($req->hasFile('document'))
                {
                    $file = $req->file('document');
                    $doctor_doc->document = $file->getClientOriginalName();
                    // dd($doctor_img);
                    $extension = $file->getClientOriginalExtension();
                    $doctor_doc->document_type=$extension;
                    $filename = time() . '.' .$extension;
                    $file->move('assets/docter_document', $filename);
                    $doctor_doc->document_path = 'assets/docter_document/' . $filename;
                }
                if($doctor_doc->save()){
                  $response_data = ["success" => 1, "message" => " Successfully"];
              }else{
                  $response_data = ["success" => 0, "message" => "Site Server Error"];
              }
              // ,"data" => $docterEdit

              return response()->json($response_data);
              }
              else{
                $response_data = ["success" => 2, "message" => "unsupport file"];
                return response()->json($response_data);
              }
            }
            public function document_index(Request $request){
    
            $doctor_doc=doctorDocuments::where('doctor_id',$request->doctor_id)->get();

                if ($request->ajax()) {
              return Datatables::of($doctor_doc)            
                      ->addIndexColumn()
        
                      ->addColumn('action', function($row){
        
                      })
                      ->rawColumns(['action'])
                    
                      ->make(true);
                      
              }
            
            
    
      }
      public function doctor_list_doc($id){
              $doctor=datacenternew::where('id',$id)->first();
             return view('doctor.doctor_list_doc',compact('doctor'));
            //   if($doctor->document!=""){
            //   return view('doctor.doctor_list_doc',compact('doctor'));
            //   }
            //   else{
            //       return Redirect::back()->withErrors(['msg', 'The Message']);
            //   }
              
              
            }
            
            public function doctor_document_list(Request $req){
                // dd($req->all());
               $doctor_doc=doctorDocuments::where('doctor_id',$req->document_id)->get();
                // dd($doctor_doc);
                if(count($doctor_doc) > 0 ){
                   $response_data =["success"=>1,"message"=>"doctor document get success","doctor_doc"=>$req->document_id];
                }
                else{
                   $response_data =["error"=>0, "message"=>"doctor document empty",];
                }
                return response()->json($response_data);
            }

}
