<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Country;
  
class CountryController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $countries = Country::all();
        return view('country',compact('countries'));
    }
}