@extends('layouts.master')

@section('content')

<div class="content-wrapper">
<div class="page-header">
    <h3 class="page-title">
      <span class="mr-2 text-white page-title-icon bg-gradient-primary">
        <i class="mdi mdi-home"></i>
      </span> Business Research Manager
    </h3>
    <nav aria-label="breadcrumb">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>Overview <i class="align-middle mdi mdi-alert-circle-outline icon-sm text-primary"></i>
        </li>
      </ul>
    </nav>
</div>

  <div class="col-md-6">
    <div class="form-group row">
        <div class="col-lg-9">
            <select class="form-control" name="industry">
                <option class="" value="" disabled selected>Select
                    Industry
                </option>
                <option value="Manufacturing Industry">Manufacturing Industry</option>
                <option value="Production Industry">Production Industry</option>
                <option value="Food Industry">Food Industry</option>
                <option value="Agricultural Industry">Agricultural Industry</option>
                <option value="Technology Industry">Technology Industry</option>
                <option value="Construction Industry">Construction Industry</option>
                <option value="Factory Industry">Factory Industry</option>
                <option value="Mining Industry">Mining Industry</option>
                <option value="Finance Industry">Finance Industry</option>
                <option value="Retail Industry">Retail Industry</option>
                <option value="Engineering Industry">Engineering Industry</option>
                <option value="Marketing Industry">Marketing Industry</option>
                <option value="Education Industry">Education Industry</option>
                <option value="Transport Industry">Transport Industry</option>
                <option value="Chemical Industry">Chemical Industry</option>
                <option value="Healthcare Industry">Healthcare Industry</option>
                <option value="Hospitality Industry">Hospitality Industry</option>
                <option value="Energy Industry">Energy Industry</option>
                <option value="Science Industry">Science Industry</option>
                <option value="Waste Industry">Waste Industry</option>
                <option value="Chemistry Industry">Chemistry Industry</option>
                <option value="Teritiary Sector Industry">Teritiary Sector Industry</option>
                <option value="Real Estate Industry">Real Estate Industry</option>
                <option value="Financial Services Industry">Financial Services Industry
                </option>
                <option value="Telecommunications Industry">Telecommunications Industry
                </option>
                <option value="Distribution Industry">Distribution Industry</option>
                <option value="Medical Device Industry">Medical Device Industry</option>
                <option value="Biotechnology Industry">Biotechnology Industry</option>
                <option value="Aviation Industry">Aviation Industry</option>
                <option value="Insurance Industry">Insurance Industry</option>
                <option value="Trade Industry">Trade Industry</option>
                <option value="Stock Market Industry">Stock Market Industry</option>
                <option value="Electronics Industry">Electronics Industry</option>
                <option value="Textile Industry">Textile Industry</option>
                <option value="Computers and Information Technology Industry">Computers and
                    Information Technology Industry</option>
                <option value="Market Research Industry">Market Research Industry</option>
                <option value="Machine Industry">Machine Industry</option>
                <option value="Recycling Industry">Recycling Industry</option>
                <option value="Information and Communication Technology Industry">
                    Information and Communication Technology Industry</option>
                <option value="E- Commerce Industry">E- Commerce Industry</option>
                <option value="Research Industry">Research Industry</option>
                <option value="Rail Transport Industry">Rail Transport Industry</option>
                <option value="Food Processing Industry">Food Processing Industry</option>
                <option value="Small Business Industry">Small Business Industry</option>
                <option value="Wholesale Industry">Wholesale Industry</option>
                <option value="Pulp and Paper Industry">Pulp and Paper Industry</option>
                <option value="Vehicle Industry">Vehicle Industry</option>
                <option value="Steel Industry">Steel Industry</option>
                <option value="Renewable Energy Industry">Renewable Energy Industry</option>
            </select>
        </div>
    </div>
    
</div>


</div>
@endsection