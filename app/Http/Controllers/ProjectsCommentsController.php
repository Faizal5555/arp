<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectsComments;
use App\Models\BidRfq;
use Illuminate\Support\Facades\Validator;
use Auth;

class ProjectsCommentsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if($user->user_type=="admin"){
            $comment = ProjectsComments::paginate(5);
        }else{
            $comment = ProjectsComments::where('user_id',$user->id)->paginate(5);
        }
        
        // $bidrfq = Bidrfq::where('rfq_no',$comment->rfq_no)->first();
        // dd($bidrfq);
        return view('projectsComments.index', compact('comment'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function create()
    {
        $comment="";
        $bidrfq = BidRfq::get();
        // dd($bidrfq);
        return view('projectsComments.create',compact('comment','bidrfq'));
    }
    public function store(Request $req)
    {
        $v = $req->all();

        $validator = Validator::make(
            $v,
            []
        );

        if (!$validator->fails()) {
            $comments = new ProjectsComments();
            $comments->comments = $req->comments;
            $comments->rfq_no = $req->rfq_no;
            $comments->user_id = auth()->user()->id;

            if ($comments->save()) {
                $response_data = ["success" => 1, "message" => "Comments Created Successfully"];
            } else {
                $response_data = ["success" => 0, "message" => "Site Server Error"];
            }
        } else {
            $response_data = ["success" => 0, "message" => "Site Server Error", "error" => $validator->errors()];
        }

        return response()->json($response_data);
    }

}
