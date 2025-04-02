<script>
     $(document).ready(function() {
            $(document).on('keyup', '#costingTable td input', function() {
                let index = $(this).closest("td").index();
                let table = $(this).closest('table');
                let row = table.find("tr");
                let rowLength = row.length;
                var sum = 0;
                let sample = 1;
                row.each(function(key){
                    if(key == 5)
                    {
                        let val = parseInt($(this).children('td').eq(index).find('input').val());
                        if(!isNaN(val))
                        {
                        sample = val;
                        }
                    }
                    if(key > 5 && key < (rowLength - 1))
                    {
                        let val = parseInt($(this).children('td').eq(index).find('input').val());
                        if(!isNaN(val))
                        {
                            sum = sum + val;
                        }
                    }
                    if(key == (rowLength - 1))
                    {
                        $(this).children('td').eq(index).find('input').val(sum * sample)
                    }
                    
                });
            });


       //Multiple Country

            $(document).on('keyup', '#MultipleCountry td input', function() {
                let totalValues = [];
                let total_length = $('#MultipleCountry tbody td:has(input[attr="total"])').length;
                let overall_total_length = $('#MultipleCountry tbody td:has(input[name="multiple_total_cost[]"])').length;
                $('#MultipleCountry tbody td:has(input[attr="total"])').each(function(){
                    let cpi = parseFloat($(this).prev().find('input').val());
                    let sample = parseFloat ($(this).prev().prev().find('input').val());
                    if(!isNaN(cpi) && !isNaN(sample))
                    {
                        let total = (cpi * sample).toFixed(2); // Ensure two decimal places
                        $(this).find('input').val((cpi*sample).toFixed(2));
                        totalValues.push(cpi*sample);
                    }else{
                        $(this).find('input').val("");
                        totalValues.push(0);
                    }
                })
                let colIndex = 3;
                $('#MultipleCountry tbody td:has(input[name="multiple_total_cost[]"])').each(function() {
                    let sum = 0;
                    $("#MultipleCountry tbody tr").each(function () {
                        let inputValue = parseFloat($(this).find("td").eq(colIndex).find("input[attr='total']").val()) || 0;
                        sum += inputValue;
                    });
                    colIndex+=3;
                    $(this).find('input').val(sum.toFixed(2)); 
                })
            });

            // interview in depth calculation
            $(document).on('keyup', '#InterviewDepth td input', function() {
                let totalValues = [];
                let total_length = $('#InterviewDepth tbody td:has(input[attr="total"])').length;
                let overall_total_length = $('#InterviewDepth tbody td:has(input[name="interview_depth_total_cost_1[]"])').length;
                $('#InterviewDepth tbody td:has(input[attr="total"])').each(function(){
                    let cpi = parseFloat($(this).prev().find('input').val());
                    let sample = parseFloat ($(this).prev().prev().find('input').val());
                    if(!isNaN(cpi) && !isNaN(sample))
                    {
                        let total = (cpi * sample).toFixed(2); // Ensure two decimal places
                        $(this).find('input').val((cpi*sample).toFixed(2));
                        totalValues.push(cpi*sample);
                    }else{
                        $(this).find('input').val("");
                        totalValues.push(0);
                    }
                })
                let colIndex = 3;
                $('#InterviewDepth tbody td:has(input[attr="total1"])').each(function() {
                    let sum = 0;
                    $("#InterviewDepth tbody tr").each(function () {
                        let inputValue = parseFloat($(this).find("td").eq(colIndex).find("input[attr='total']").val()) || 0;
                        sum += inputValue;
                    });
                    colIndex+=3;
                    $(this).find('input').val(sum.toFixed(2)); 
                })
                // let index = 1;
                $('#InterviewDepth tbody td:has(input[attr="total2"])').each(function(index) {
                    let total = 0;
                    // $("#InterviewDepth tbody tr").each(function () {
                    //     console.log(index)
                        let multiple = parseFloat($("input[name='interview_depth_fgd[]']").eq(index).val()) || 0;
                        console.log(multiple);
                        let inputValue = parseFloat($("input[attr='total1']").eq(index).val()) || 0;
                        total = inputValue * multiple;
                    // });
                    // index++;
                    $(this).find('input').val(total);
                })
            });

            // online community

            $(document).on('keyup', '#OnlineCommunity td input', function() {
                console.log("hello");
                let totalValues = [];
                let total_length = $('#OnlineCommunity tbody td:has(input[attr="total"])').length;
                let overall_total_length = $('#OnlineCommunity tbody td:has(input[name="online_community_total_cost[]"])').length;
                $('#OnlineCommunity tbody td:has(input[attr="total"])').each(function(){
                    let cpi = parseFloat($(this).prev().find('input').val());
                    let sample = parseFloat ($(this).prev().prev().find('input').val());
                    if(!isNaN(cpi) && !isNaN(sample))
                    {
                        let total = (cpi * sample).toFixed(2); // Ensure two decimal places
                        $(this).find('input').val((cpi*sample).toFixed(2));
                        console.log(cpi*sample)
                        totalValues.push(cpi*sample);
                    }else{
                        $(this).find('input').val("");
                        totalValues.push(0);
                    }
                })
                let colIndex = 3;
                $('#OnlineCommunity tbody td:has(input[name="online_community_total_cost[]"])').each(function() {
                    let sum = 0;
                    $("#OnlineCommunity tbody tr").each(function () {
                        let inputValue = parseFloat($(this).find("td").eq(colIndex).find("input[attr='total']").val()) || 0;
                        sum += inputValue;
                    });
                    colIndex+=3;
                    $(this).find('input').val(sum.toFixed(2)); 
                })
            });
        });

</script>


<input type="hidden" name="id" value="{{ $newrfq && $newrfq->id ? $newrfq->id : '' }}">
<input id="bidrfqCount" type="hidden" value="1" name="bidrfqCount">
<input type="hidden" name="single_form"   value="{{isset($newrfq) && isset($newrfq->single) ? 1 : 0}}" id="single_form">
<input type="hidden" name="multiple_form"   value="{{isset($newrfq) && isset($newrfq->multiple) ? 1 : 0}}" id="multiple_form">
<input type="hidden" name="interview_form"  value="{{isset($newrfq) && isset($newrfq->interview) ? 1 : 0}}"id="interview_form">
<input type="hidden" name="online_form"  value="{{isset($newrfq) && isset($newrfq->online) ? 1 : 0}}" id="online_form">
<div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-lg-3 col-form-label font-weight-semibold">RFQ No <span
                        class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <input name="rfq_no" value="{{ $newrfq->rfq_no }}" readonly="readonly"
                        type="text" class="form-control" placeholder="{{ $newrfq->rfq_no }}">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-lg-3 col-form-label font-weight-semibold">Date<span
                        class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <input name="date"
                        value="{{ $newrfq && $newrfq->date ? $newrfq->date : '' }}" type="date"
                        class="form-control" placeholder="Date">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-lg-3 col-form-label font-weight-semibold">Industry<span
                        class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <!-- <input name="industry" value="{{ $newrfq && $newrfq->industry ? $newrfq->industry : '' }}"
                            type="text" class="form-control" placeholder="Industry"> -->
                    <select class="form-control label-gray-3" name="industry"
                        placeholder="Select Industry">
                        <option value="Manufacturing Industry"
                            {{ $newrfq && $newrfq->industry == 'Manufacturing Industry' ? 'selected' : '' }}>
                            Manufacturing Industry</option>
                        <option value="Production Industry"
                            {{ $newrfq && $newrfq->industry == 'Production Industry' ? 'selected' : '' }}>
                            Production Industry</option>
                        <option value="Food Industry"
                            {{ $newrfq && $newrfq->industry == 'Food Industry' ? 'selected' : '' }}>
                            Food Industry</option>
                        <option value="Agricultural Industry"
                            {{ $newrfq && $newrfq->industry == 'Agricultural Industry' ? 'selected' : '' }}>
                            Agricultural Industry</option>
                        <option value="Technology Industry"
                            {{ $newrfq && $newrfq->industry == 'Technology Industry' ? 'selected' : '' }}>
                            Technology Industry</option>
                        <option value="Construction Industry"
                            {{ $newrfq && $newrfq->industry == 'Construction Industry' ? 'selected' : '' }}>
                            Construction Industry</option>
                        <option value="Factory Industry"
                            {{ $newrfq && $newrfq->industry == 'Factory Industry' ? 'selected' : '' }}>
                            Factory Industry</option>
                        <option value="Mining Industry"
                            {{ $newrfq && $newrfq->industry == 'Mining Industry' ? 'selected' : '' }}>
                            Mining Industry</option>
                        <option value="Finance Industry"
                            {{ $newrfq && $newrfq->industry == 'Finance Industry' ? 'selected' : '' }}>
                            Finance Industry</option>
                        <option value="Retail Industry"
                            {{ $newrfq && $newrfq->industry == 'Retail Industry' ? 'selected' : '' }}>
                            Retail Industry</option>
                        <option value="Engineering Industry"
                            {{ $newrfq && $newrfq->industry == 'Engineering Industry' ? 'selected' : '' }}>
                            Engineering Industry</option>
                        <option value="Marketing Industry"
                            {{ $newrfq && $newrfq->industry == 'Marketing Industry' ? 'selected' : '' }}>
                            Marketing Industry</option>
                        <option value="Education Industry"
                            {{ $newrfq && $newrfq->industry == 'Education Industry' ? 'selected' : '' }}>
                            Education Industry</option>
                        <option value="Transport Industry"
                            {{ $newrfq && $newrfq->industry == 'Transport Industry' ? 'selected' : '' }}>
                            Transport Industry</option>
                        <option value="Chemical Industry"
                            {{ $newrfq && $newrfq->industry == 'Chemical Industry' ? 'selected' : '' }}>
                            Chemical Industry</option>
                        <option value="Healthcare Industry"
                            {{ $newrfq && $newrfq->industry == 'Healthcare Industry' ? 'selected' : '' }}>
                            Healthcare Industry</option>
                        <option value="Hospitality Industry"
                            {{ $newrfq && $newrfq->industry == 'Hospitality Industry' ? 'selected' : '' }}>
                            Hospitality Industry</option>
                        <option value="Energy Industry"
                            {{ $newrfq && $newrfq->industry == 'Energy Industry' ? 'selected' : '' }}>
                            Energy Industry</option>
                        <option value="Science Industry"
                            {{ $newrfq && $newrfq->industry == 'Science Industry' ? 'selected' : '' }}>
                            Science Industry</option>
                        <option value="Waste Industry"
                            {{ $newrfq && $newrfq->industry == 'Waste Industry' ? 'selected' : '' }}>
                            Waste Industry</option>
                        <option value="Chemistry Industry"
                            {{ $newrfq && $newrfq->industry == 'Chemistry Industry' ? 'selected' : '' }}>
                            Chemistry Industry</option>
                        <option value="Teritiary Sector Industry"
                            {{ $newrfq && $newrfq->industry == 'Teritiary Sector Industry' ? 'selected' : '' }}>
                            Teritiary Sector Industry</option>
                        <option value="Real Estate Industry"
                            {{ $newrfq && $newrfq->industry == 'Real Estate Industry' ? 'selected' : '' }}>
                            Real Estate Industry</option>
                        <option
                            value="Financial Services Industry"{{ $newrfq && $newrfq->industry == 'Financial Services Industry' ? 'selected' : '' }}>
                            Financial Services Industry</option>
                        <option value="Telecommunications Industry"
                            {{ $newrfq && $newrfq->industry == 'Telecommunications Industry' ? 'selected' : '' }}>
                            Telecommunications Industry</option>
                        <option value="Distribution Industry"
                            {{ $newrfq && $newrfq->industry == 'Distribution Industry' ? 'selected' : '' }}>
                            Distribution Industry</option>
                        <option value="Medical Device Industry"
                            {{ $newrfq && $newrfq->industry == 'Medical Device Industry' ? 'selected' : '' }}>
                            Medical Device Industry</option>
                        <option value="Biotechnology Industry"
                            {{ $newrfq && $newrfq->industry == 'Biotechnology Industry' ? 'selected' : '' }}>
                            Biotechnology Industry</option>
                        <option value="Aviation Industry"
                            {{ $newrfq && $newrfq->industry == 'Aviation Industry' ? 'selected' : '' }}>
                            Aviation Industry</option>
                        <option value="Insurance Industry"
                            {{ $newrfq && $newrfq->industry == 'Insurance Industry' ? 'selected' : '' }}>
                            Insurance Industry</option>
                        <option value="Trade Industry"
                            {{ $newrfq && $newrfq->industry == 'Trade Industry' ? 'selected' : '' }}>
                            Trade Industry</option>
                        <option value="Stock Market Industry"
                            {{ $newrfq && $newrfq->industry == 'Stock Market Industry' ? 'selected' : '' }}>
                            Stock Market Industry</option>
                        <option value="Electronics Industry"
                            {{ $newrfq && $newrfq->industry == 'Electronics Industry' ? 'selected' : '' }}>
                            Electronics Industry</option>
                        <option value="Textile Industry"
                            {{ $newrfq && $newrfq->industry == 'Textile Industry' ? 'selected' : '' }}>
                            Textile Industry</option>
                        <option value="Computers and Information Technology Industry"
                            {{ $newrfq && $newrfq->industry == 'Computers and Information Technology Industry' ? 'selected' : '' }}>
                            Computers and Information Technology Industry</option>
                        <option value="Market Research Industry"
                            {{ $newrfq && $newrfq->industry == 'Market Research Industry' ? 'selected' : '' }}>
                            Market Research Industry</option>
                        <option value="Machine Industry"
                            {{ $newrfq && $newrfq->industry == 'Machine Industry' ? 'selected' : '' }}>
                            Machine Industry</option>
                        <option value="Recycling Industry"
                            {{ $newrfq && $newrfq->industry == 'Recycling Industry' ? 'selected' : '' }}>
                            Recycling Industry</option>
                        <option value="Information and Communication Technology Industry"
                            {{ $newrfq && $newrfq->industry == 'Information and Communication Technology Industry' ? 'selected' : '' }}>
                            Information and Communication Technology Industry</option>
                        <option value="E- Commerce Industry"
                            {{ $newrfq && $newrfq->industry == 'E- Commerce Industry' ? 'selected' : '' }}>
                            E- Commerce Industry</option>
                        <option value="Research Industry"
                            {{ $newrfq && $newrfq->industry == 'Research Industry' ? 'selected' : '' }}>
                            Research Industry</option>
                        <option value="Rail Transport Industry"
                            {{ $newrfq && $newrfq->industry == 'Rail Transport Industry' ? 'selected' : '' }}>
                            Rail Transport Industry</option>
                        <option value="Food Processing Industry"
                            {{ $newrfq && $newrfq->industry == 'Food Processing Industry' ? 'selected' : '' }}>
                            Food Processing Industry</option>
                        <option value="Small Business Industry"
                            {{ $newrfq && $newrfq->industry == 'Small Business Industry' ? 'selected' : '' }}>
                            Small Business Industry</option>
                        <option value="Wholesale Industry"
                            {{ $newrfq && $newrfq->industry == 'Wholesale Industry' ? 'selected' : '' }}>
                            Wholesale Industry</option>
                        <option value="Pulp and Paper Industry"
                            {{ $newrfq && $newrfq->industry == 'Pulp and Paper Industry' ? 'selected' : '' }}>
                            Pulp and Paper Industry</option>
                        <option value="Vehicle Industry"
                            {{ $newrfq && $newrfq->industry == 'Vehicle Industry' ? 'selected' : '' }}>
                            Vehicle Industry</option>
                        <option value="Steel Industry"
                            {{ $newrfq && $newrfq->industry == 'Steel Industry' ? 'selected' : '' }}>
                            Steel Industry</option>
                        <option value="Renewable Energy Industry"
                            {{ $newrfq && $newrfq->industry == 'Renewable Energy Industry' ? 'selected' : '' }}>
                            Renewable Energy Industry</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-lg-3 col-form-label font-weight-semibold">Follow Up Date<span
                        class="text-danger">*</span></label>
                <div class="col-lg-9">

                    <input name="follow_up_date"
                        value="{{ $newrfq && $newrfq->follow_up_date ? $newrfq->follow_up_date : '' }}"
                        type="date" class="form-control" placeholder="Follow Up date">
                </div>
            </div>
        </div>
        {{-- <div class="col-md-6">
            <div class="form-group row">
                <label class="col-lg-3 col-form-label font-weight-semibold">Choose Currency<span
                        class="text-danger">*</span></label>
                <div class="col-lg-9">

                    <select class="form-control label-gray-3" id="currency" name="currency">
                        <option
                            value="₹"{{ $bidrfq && $bidrfq->currency == '₹' ? 'selected' : '' }}>
                            INR</option>
                        <option value="$"
                            {{ $bidrfq && $bidrfq->currency == '$' ? 'selected' : '' }}>USD
                        </option>
                        <option
                            value="€"{{ $bidrfq && $bidrfq->currency == '€' ? 'selected' : '' }}>
                            Euro</option>
                        <option value="£"
                            {{ $bidrfq && $bidrfq->currency == '£' ? 'selected' : '' }}>Pound
                        </option>
                    </select>
                </div>
            </div>
        </div> --}}
    
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-lg-3 col-form-label font-weight-semibold">Choose Company
                    Name<span class="text-danger">*</span></label>
                <div class="col-lg-9">

                    <select class="form-control label-gray-3" id="company_name"
                        name="company_name">
                        <option
                            value="Asia Research Partners"{{ $newrfq && $newrfq->company_name == 'Asia Research Partners' ? 'selected' : '' }}>
                            Asia Research Partners</option>
                        <option value="Universal Research Panels"
                            {{ $newrfq && $newrfq->company_name == 'Universal Research Panels' ? 'selected' : '' }}>
                            Universal Research Panels</option>
                        <option
                            value="Healthcare Panels India"{{ $newrfq && $newrfq->company_name == 'Healthcare Panels India' ? 'selected' : '' }}>
                            Healthcare Panels India</option>

                    </select>
                </div>
            </div>
        </div>
    </div>

<div class="w-100">
    <div class="container mt-5">
        <div class="tab-container">
            @if(isset($newrfq) && isset($newrfq->single))
                <button class="tab-button active" type="button" data-target="#single-country">
                    CATI / CAPI / Online Research Single Country
                </button>
            @endif
        
            @if(isset($newrfq) && isset($newrfq->multiple))
                <button class="tab-button active" type="button" data-target="#mulitple-country">
                    CATI / CAPI / Online Research Multiple Countries
                </button>
            @endif
        
            @if(isset($newrfq) && isset($newrfq->interview))
                <button class="tab-button active" type="button" data-target="#interview-depth">
                    In-Depth Interviews / Focus Groups
                </button>
            @endif
        
            @if(isset($newrfq) && isset($newrfq->online))
                <button class="tab-button active" type="button" data-target="#online-community">
                    Online Community - Costing Sheet
                </button>
            @endif
        </div>
        <div class="{{ isset($newrfq) && isset($newrfq->single) ? '' : 'd-none' }}" id="single-country">
            <?php
            if(isset($newrfq) && isset($newrfq->single)){
                $single_methodology = json_decode($newrfq->single->single_methodology);
                $single_currency = json_decode($newrfq->single->single_currency);
                $single_loi = json_decode($newrfq->single->single_loi);
                $single_country = json_decode($newrfq->single->single_country);
                $single_client = json_decode($newrfq->single->single_client);
                $single_sample = json_decode($newrfq->single->single_sample);
                $single_fieldwork = json_decode($newrfq->single->single_fieldwork);
                $single_other = json_decode($newrfq->single->single_other);
                $single_total_cost = json_decode($newrfq->single->single_total_cost);
            }   
            ?>
            <h5>CATI / CAPI / Online Research Single Country</h5>
            @if(isset($newrfq) && isset($newrfq->single))
            <div class="table-container mt-2">
                <table class="" id="costingTable">
                    <tbody>
                        <tr>
                            <td class="static-field">Methodology</td>
                            @if(count($single_methodology) > 0)
                            @foreach($single_methodology as $key => $methodology)
                                <td>
                                <input type="text" class="form-control" name="single_methodology[]" value="{{$methodology}}">
                                </td>
                            @endforeach
                            @endif
                        </tr>
                        <tr>
                            <td class="static-field remove-other_{{$key - 1}}">Currency</td>
                            @if(count($single_currency) > 0)
                            @foreach($single_currency as $currency)
                                <td><input type="text" class="form-control" name="single_currency[]"value="{{$currency}}" ></td>
                            @endforeach
                            @endif
                        </tr>
                        <tr>
                            <td class="static-field remove-other_{{$key - 1}}">LOI</td>
                            @if(count($single_loi) > 0)
                            @foreach($single_loi as $loi)
                                <td><input type="text" class="form-control" name="single_loi[]" value="{{$loi}}"></td>
                            @endforeach
                            @endif
                        </tr>
                        
                        <tr>
                            <td class="static-field remove-other_{{$key - 1}}">Country</td>
                            @if(count($single_country) > 0)
                            @foreach($single_country as $country)
                                <td><input type="text" class="form-control" name="single_country[]" value="{{$country}}"></td>
                            @endforeach
                            @endif
                        </tr>
                        
                        <tr>
                        <td class="static-field remove-other_{{$key - 1}}">Client</td>
                        @if(count($single_client) > 0)
                        @foreach($single_client as $value)
                            <td>
                                <select class="form-control"
                                    name="single_client[]">
                                    <option class=""
                                        value="">Client</option>
                                    @if (count($client) > 0)
                                        @foreach ($client as $v)
                                            <option
                                                value="{{ $v->client_name }}" {{$v->client_name == $value ? 'selected' : ''}}>
                                                {{ $v->client_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
                        @endforeach
                        @endif
                        </tr>
                        
                        <tr>
                        <td class="static-field remove-other_{{$key - 1}}">Sample</td>
                        @if(count($single_sample) > 0)
                        @foreach($single_sample as $sample)
                            <td><input type="text" class="form-control" name="single_sample[]" value="{{$sample}}"></td>
                        @endforeach
                        @endif
                        </tr>
                        <tr>
                            <td class="static-field remove-other_{{$key - 1}}">Fieldwork CPI</td>
                            @if(count($single_fieldwork) > 0)
                            @foreach($single_fieldwork as $fieldwork)
                                <td><input type="text" class="form-control" name="single_fieldwork[]" value="{{$fieldwork}}">
                            @endforeach
                            @endif
                            </td>
                        </tr>
                        
                        @if(count($single_other) > 0)
                        @foreach($single_other as $k => $value)
                        <tr id="otherFields">
                        @if(count($value) > 0)
                        @foreach($value as $key => $other)
                            @if($key % 3 === 0)
                            <td class="d-flex">
                                
                                <button type="button" class="d-none btn btn-sm  {{$k == 0 ? 'add-other btn-light' : 'remove-other btn-danger'}}">{{$k == 0 ? '+' : 'x'}}</button> 
                                <input type="text" class="form-control" placeholder="Others" name="single_other[{{$k}}][]" value="{{$other}}">
                            </td>
                            @else
                            <td><input type="text" class="form-control" name="single_other[{{$k}}][]" value="{{$other}}"></td>
                            @endif
                        @endforeach
                        @endif
                        </tr>
                        @endforeach
                        @endif
                        <tr>
                            <td>Total Cost</td>
                            @if(count($single_total_cost) > 0)
                            @foreach($single_total_cost as $total_cost)
                                <td><input type="text" class="form-control" name="single_total_cost[]" value="{{$total_cost}}"></td>
                            @endforeach
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>


    <div class="container">

        <div class="{{ isset($newrfq) && isset($newrfq->multiple) ? '' : 'd-none' }}" id="mulitple-country">
            <h5>CATI / CAPI / Online Research Multiple Country</h5>
            <?php
            if(isset($newrfq) && isset($newrfq->multiple)){
                $multiple_methodology = json_decode($newrfq->multiple->multiple_methodology);
                $multiple_currency = json_decode($newrfq->multiple->multiple_currency);
                $multiple_loi = json_decode($newrfq->multiple->multiple_loi);
                $multiple_client = json_decode($newrfq->multiple->multiple_client);
                $multiple_countries = json_decode($newrfq->multiple->multiple_countries);
                $multiple_other = json_decode($newrfq->multiple->multiple_other);
                $multiple_total_cost = json_decode($newrfq->multiple->multiple_total_cost);
            }   
            ?>
           
                @if(isset($newrfq) && isset($newrfq->multiple))
            <div class="table-container mt-2">
                <table class="" id="MultipleCountry">
                    <tbody>
                        <tr>
                            <td class="static-field">Methodology</td>
                            @if(count($multiple_methodology) > 0)
                                @foreach($multiple_methodology as $key => $methodology)
                                    <td  colspan="3">
                                    <label class="mb-0 label">
                                    <input type="text" class="form-control" name="multiple_methodology[]" value="{{$methodology}}" placeholder="Online">
                                    </label>
                                @endforeach
                            @endif
                            </td>
                        </tr>
                        <tr>
                        <td class="static-field relative ">Currency</td>
                            @if(count($multiple_currency) > 0)
                                @foreach($multiple_currency as $key => $currency)
                                <td class="editable-field removeMultipleCountry_{{$key - 1}}"  colspan="3">
                                <label class="mb-0 label">
                                <input type="text" class="form-control" name="multiple_currency[]" value="{{$currency}}" placeholder="currency">
                                </label>
                                @endforeach
                            @endif
                            </td>
                        </tr>
                        <tr>
                        <td class="static-field relative ">LOI</td>
                            @if(count($multiple_loi) > 0)
                            @foreach($multiple_loi as $key => $loi)
                            <td class="editable-field removeMultipleCountry_{{$key - 1}}"  colspan="3">
                                <label class="mb-0 label">
                                <input type="text" class="form-control" name="multiple_loi[]" value="{{$loi}}" placeholder="mins">
                                </label>
                            @endforeach
                            @endif
                            </td>
                        </tr>
                        <tr>
                        <td class="static-field relative ">Client</td>
                        @if(count($multiple_client) > 0)
                            @foreach($multiple_client as $key => $value)
                            <td class="editable-field removeMultipleCountry_{{$key - 1}}"  colspan="3">
                                <label class="mb-0 label"> 
                                <select class="form-control label-gray-3" name="multiple_client[]">
                                    <option class="label-gray-3" value="">Client</option>
                                    @foreach ($client as $v)
                                        <option value="{{ $v->client_name }}" {{$v->client_name == $value ? 'selected' : ''}}> 
                                        {{ $v->client_name }}
                                        </option>
                                    @endforeach
                                </select>
                                </label>
                            </td>
                            @endforeach
                        @endif
                        </tr>
                        <tr>
                            <td class="static-field relative ">Countries</td>
                            @if(count($multiple_countries) > 0)
                            @foreach($multiple_countries as $key => $multiple)
                            <td class="static-field removeMultipleCountry_{{$key - 1}}">Sample</td>
                            <td class="static-field removeMultipleCountry_{{$key - 1}}">CPI</td>
                            <td class="static-field removeMultipleCountry_{{$key - 1}}">Total</td>
                            @endforeach
                            @endif
                        </tr>
                        @if(count($multiple_countries) > 0)
                        @foreach ($multiple_countries as $k => $countries)
                            <tr>
                            <?php 
                                $i = "";
                            ?>
                            @if(count($countries) > 0)
                            @foreach ($countries as $key => $country)
                                <?php 
                                if($key == 4)
                                {
                                    $i = 0;
                                }
                                ?>
                                <td class="removeMultipleCountry_{{$i}}"><input type="text" class="form-control" name="multiple_countries[{{$k}}][]" value="{{$country}}" attr="{{($key) % 3 === 0 && $key > 0 ? 'total' : ''}}"></td>
                                <?php
                                if($key % 3 === 0 && $key > 3)
                                {
                                    $i++;
                                }
                                ?>
                            @endforeach
                            @endif
                            </tr>
                        @endforeach
                        @endif
                        @if(count($multiple_other) > 0)
                        @foreach($multiple_other as $k => $value)
                            <?php 
                            $i = "";
                        ?>
                        <tr id="otherFieldMultipleCountry">
                        @if(count($value) > 0)
                        @foreach($value as $key => $other)
                            <?php 
                            if($key == 4)
                            {
                                $i = 0;
                            }
                            ?>
                            @if($key % 3 === 0 && $key == 0)
                            <td class="d-flex removeMultipleCountry_{{$i}}">
                                
                                <button type="button" class="d-none btn btn-sm  {{$k == 0 ? 'multiple_country_other btn-light' : 'remove_multiple_country btn-danger'}}">{{$k == 0 ? '+' : 'x'}}</button> 
                                <input type="text" class="form-control" placeholder="Others" name="multiple_other[{{$k}}][]" value="{{$other}}">
                            </td>
                            @elseif($key % 3 === 0)
                            <td class="removeMultipleCountry_{{$i}}"><input type="text" class="form-control" name="multiple_other[{{$k}}][]" attr="total" value="{{$other}}"></td>
                            @else
                            <td class="removeMultipleCountry_{{$i}}"><input type="text" class="form-control" name="multiple_other[{{$k}}][]" value="{{$other}}"></td>
                            @endif
                            <?php
                            if($key % 3 === 0 && $key > 3)
                            {
                                $i++;
                            }
                            ?>
                        @endforeach
                        @endif
                        </tr>
                        @endforeach
                        @endif
                        <tr>
                            <td class="total-cost relative ">Total project Cost</td>
                            @if(count($multiple_total_cost) > 0)
                            @foreach ($multiple_total_cost as $key => $value)
                            <td class="total-cost removeMultipleCountry_{{$key - 1}}"></td>
                            <td class="total-cost removeMultipleCountry_{{$key - 1}}"></td>
                            <td class="removeMultipleCountry_{{$key - 1}}"><input type="text" class="form-control " name="multiple_total_cost[]" value="{{$value}}"></td>
                            @endforeach
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>


    <div class="container">

        <div class="{{ isset($newrfq) && isset($newrfq->interview) ? '' : 'd-none' }}" id="interview-depth">
            <h5>In-Depth Interviews /Focus Groups Costing Sheet/ Central Location Tests Costing Sheet</h5>
            <?php
            if(isset($newrfq) && isset($newrfq->interview)){
                $interview_depth_methodology = json_decode($newrfq->interview->interview_depth_methodology);
                $interview_depth_currency = json_decode($newrfq->interview->interview_depth_currency);
                $interview_depth_loi = json_decode($newrfq->interview->interview_depth_loi);
                $interview_depth_client = json_decode($newrfq->interview->interview_depth_client);
                $interview_depth_no_fgd = json_decode($newrfq->interview->interview_depth_no_fgd);
                $interview_depth_sample_fgd = json_decode($newrfq->interview->interview_depth_sample_fgd);
                $interview_depth_countries = json_decode($newrfq->interview->interview_depth_countries);
                $interview_depth_requirements = json_decode($newrfq->interview->interview_depth_requirements);
                $interview_depth_incentives = json_decode($newrfq->interview->interview_depth_incentives);
                $interview_depth_moderation = json_decode($newrfq->interview->interview_depth_moderation);
                $interview_depth_transcripts = json_decode($newrfq->interview->interview_depth_transcripts);
                $interview_depth_project_management = json_decode($newrfq->interview->interview_depth_project_management);
                $interview_depth_other = json_decode($newrfq->interview->interview_depth_other);
                $interview_depth_total_cost_1 = json_decode($newrfq->interview->interview_depth_total_cost_1);
                $interview_depth_total_cost_2 = json_decode($newrfq->interview->interview_depth_total_cost_2);
            }   
            ?>
            @if(isset($newrfq) && isset($newrfq->interview))
           

            <div class="table-container mt-2">
                <table class="" id="InterviewDepth">
                    <tbody>
                        <tr>
                            <td class="static-field">Methodology</td>
                            @if(count($interview_depth_methodology) > 0)
                                @foreach($interview_depth_methodology as $key => $methodology)
                                    <td colspan="3">
                                        <label class="mb-0 label">
                                        <input type="text" class="form-control" name="interview_depth_methodology[]" value="{{$methodology}}" placeholder="Online FGDs">
                                        </label>
                                    </td>
                                @endforeach
                            @endif
                            
                        </tr>
                        <tr>
                            <td class="static-field">Currency</td>
                            @if(count($interview_depth_currency) > 0)
                                @foreach($interview_depth_currency as $key => $currency)
                                    <td class="editable-field removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                        <label class="mb-0 label">
                                        <input type="text" class="form-control" name="interview_depth_currency[]" value="{{$currency}}"  placeholder="currency">
                                        </label>
                                    </td>
                                @endforeach
                            @endif
                            
                        </tr>
                        <tr>
                            <td class="static-field">LOI</td>
                            @if(count($interview_depth_loi) > 0)
                                @foreach($interview_depth_loi as $key => $loi)
                                    <td class="editable-field removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                        <label class="mb-0 label">
                                        <input type="text" class="form-control sample" name="interview_depth_loi[]" value="{{$loi}}"  placeholder="mins">
                                        </label>
                                    </td>
                                @endforeach
                            @endif
                            
                        </tr>
                        <tr>
                            <td class="static-field">Client</td>
                            @if(count($interview_depth_client) > 0)
                                @foreach($interview_depth_client as $key => $value)
                                    <td class="editable-field removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                    <label class="mb-0 label"> 
                                        <select class="form-control label-gray-3" name="interview_depth_client[]">
                                        <option class="label-gray-3" value="">Client</option>
                                        @foreach ($client as $v)
                                            <option value="{{ $v->client_name }}" {{$v->client_name == $value ? 'selected' : ''}}>{{ $v->client_name }}</option>
                                        @endforeach
                                        </select>
                                    </label>
                                    </td>
                                @endforeach
                            @endif
                            
                        </tr>
                        <tr>
                            <td class="static-field">No of FGDs/IDI</td>
                            @if(count($interview_depth_no_fgd) > 0)
                                @foreach($interview_depth_no_fgd as $key => $fgd)
                                    <td class="editable-field removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                        <label class="mb-0 label">
                                        <input type="text" class="form-control sample" name="interview_depth_fgd[]" value="{{$fgd}}"  placeholder="value">
                                        </label>
                                    </td>
                                @endforeach
                            @endif
                        </tr>
                        <tr>
                            <td class="static-field">Samples per FGD/IDI</td>
                            @if(count($interview_depth_sample_fgd) > 0)
                                @foreach($interview_depth_sample_fgd as $key => $fgd)
                                <td class="editable-field removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                    <label class="mb-0 label">
                                    <input type="text" class="form-control sample" name="interview_depth_sample_fgd[]" value="{{$fgd}}"  placeholder="value">
                                    </label>
                                </td>
                                @endforeach
                            @endif
                        </tr>
                        <tr>
                            <td class="static-field">Country</td>
                            @if(count($interview_depth_countries) > 0)
                                @foreach($interview_depth_countries as $key => $country)
                                <td class="editable-field removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                <label class="mb-0 label">
                                <input type="text" class="form-control sample" value="{{$country}}" name="interview_depth_countries[]"  placeholder="Country">
                                </label>
                                </td>
                                @endforeach
                            @endif
                        </tr>
                        <tr>
                            <td class="static-field"></td>
                            @if(count($interview_depth_countries) > 0)
                            @foreach($interview_depth_countries as $key => $country)
                                <td class="static-field removeInterviewDepth_{{$key - 1}}">Sample</td>
                                <td class="static-field removeInterviewDepth_{{$key - 1}}">CPI</td>
                                <td class="static-field removeInterviewDepth_{{$key - 1}}">Total</td>
                            @endforeach
                            @endif
                        </tr>

                        <tr>
                            <td class="static-field ">Recruitment</td>
                            <?php 
                                $i = "";
                            ?>
                            @if(count($interview_depth_requirements) > 0)
                            @foreach($interview_depth_requirements as $key => $value)
                                <?php 
                                if($key == 3)
                                {
                                    $i = 0;
                                }
                                ?>
                                <td class="removeInterviewDepth_{{$i}}"><input type="text" class="form-control  sample" name="interview_depth_requirement[]" value="{{$value}}" attr="{{($key + 1) % 3 === 0 ? 'total' : ''}}"></td>
                                <?php
                                if(($key + 1) % 3 === 0 && $key > 3)
                                {
                                    $i++;
                                }
                                ?>
                            @endforeach
                            @endif
                        </tr>
                        <tr>
                            <?php 
                                $i = "";
                            ?>
                            <td class="static-field removeInterviewDepth_{{$key - 1}}">Incentives</td>
                            @if(count($interview_depth_incentives) > 0)
                            @foreach($interview_depth_incentives as $key => $value)
                                <?php
                                if($key == 3)
                                {
                                    $i = 0;
                                }
                                ?>
                                <td class="removeInterviewDepth_{{$i}}"><input type="text" class="form-control sample" name="interview_depth_incentives[]" value="{{$value}}" attr="{{($key + 1) % 3 === 0 ? 'total' : ''}}"></td>
                                <?php
                                if(($key + 1) % 3 === 0 && $key > 3)
                                {
                                    $i++;
                                }
                                ?>
                            @endforeach
                            @endif
                        </tr>
                        <tr>
                            <?php 
                                $i = "";
                            ?>
                            <td class="static-field removeInterviewDepth_{{$key - 1}}">Moderation</td>
                            @if(count($interview_depth_moderation) > 0)
                            @foreach($interview_depth_moderation as $key => $value)
                            <?php 
                                if($key == 3)
                                {
                                    $i = 0;
                                }
                                ?>
                                <td class="removeInterviewDepth_{{$i}}"><input type="text" class="form-control sample" name="interview_depth_moderation[]" value="{{$value}}" attr="{{($key + 1) % 3 === 0 ? 'total' : ''}}"></td>
                                <?php
                                if(($key + 1) % 3 === 0 && $key > 3)
                                {
                                    $i++;
                                }
                                ?>
                            @endforeach
                            @endif
                        </tr>
                        <tr>
                            <?php 
                                $i = "";
                            ?>
                            <td class="static-field removeInterviewDepth_{{$key - 1}}">Transcripts</td>
                            @if(count($interview_depth_transcripts) > 0)
                            @foreach($interview_depth_transcripts as $key => $value)
                            <?php 
                                if($key == 3)
                                {
                                    $i = 0;
                                }
                                ?>
                                <td class="removeInterviewDepth_{{$i}}"><input type="text" class="form-control sample" name="interview_depth_transcripts[]" value="{{$value}}" attr="{{($key + 1) % 3 === 0 ? 'total' : ''}}"></td>
                                <?php
                                if(($key + 1) % 3 === 0 && $key > 3)
                                {
                                    $i++;
                                }
                                ?>
                            @endforeach
                            @endif
                        </tr>
                        <tr>
                        <?php 
                                $i = "";
                            ?>
                            <td class="static-field removeInterviewDepth_{{$key - 1}}">Project Management</td>
                            @if(count($interview_depth_project_management) > 0)
                            @foreach($interview_depth_project_management as $key => $value)
                                <?php
                                    if($key == 3)
                                    {
                                        $i = 0;
                                    }
                                ?>
                                <td class="removeInterviewDepth_{{$i}}"><input type="text" class="form-control sample" name="interview_depth_project_management[]" value="{{$value}}" attr="{{($key + 1) % 3 === 0 ? 'total' : ''}}"></td>
                                <?php
                                if(($key + 1) % 3 === 0 && $key > 3)
                                {
                                    $i++;
                                }
                                ?>
                            @endforeach
                            @endif
                        </tr>
                        @if(count($interview_depth_other) > 0)
                        @foreach($interview_depth_other as $k => $value)
                        <tr id="otherFieldsInterview">
                        <?php 
                            $i = "";
                        ?>
                        @if(count($value) > 0)
                        @foreach($value as $key => $other)
                            <?php 
                            if($key == 4)
                            {
                                $i = 0;
                            }
                            ?>
                            @if($key % 3 === 0 && $key == 0)
                            <td class="d-flex removeInterviewDepth_{{$i}}">
                                <button type="button" class="d-none btn btn-sm  {{$k == 0 ? 'interview_depth_other btn-light' : 'remove_interview_depth btn-danger'}}">{{$k == 0 ? '+' : 'x'}}</button> 
                                <input type="text" class="form-control" placeholder="Others" name="interview_depth_other[{{$k}}][]" value="{{$other}}">
                            </td>
                            @elseif($key % 3 === 0)
                            <td class="removeInterviewDepth_{{$i}}"><input type="text" class="form-control" name="interview_depth_other[{{$k}}][]" attr="total" value="{{$other}}"></td>
                            @else
                            <td class="removeInterviewDepth_{{$i}}"><input type="text" class="form-control" name="interview_depth_other[{{$k}}][]" value="{{$other}}"></td>
                            @endif
                            <?php
                            if($key % 3 === 0 && $key > 3)
                            {
                                $i++;
                            }
                            ?>
                        @endforeach
                        @endif
                        </tr>
                        @endforeach
                        @endif
                        {{-- <tr id="otherFieldsInterview">
                            <td class="d-flex"><button type="button" class="btn btn-sm interview_depth_other">+</button> <input type="text" name="interview_depth_other[0][]" class="form-control" placeholder="Others"></td>
                            <td><input type="text" class="form-control sample" name="interview_depth_other[0][]"></td>
                            <td><input type="text" class="form-control cpi" name="interview_depth_other[0][]"></td>
                            <td> <input type="text" class="form-control cpi" name="interview_depth_other[0][]" attr="total" value=""></td>
                        </tr> --}}
                        <tr>
                        @if(count($interview_depth_total_cost_1) > 0)
                            <td class="total-cost"><input type="text" class="form-control" name="interview_depth_total_cost_1[]" value="{{$interview_depth_total_cost_1[0]}}" placeholder="Total cost for 1 FGD"></td>
                            @foreach ($interview_depth_total_cost_1 as $key => $value)
                            @if($key > 0)
                            <td class="total-cost removeInterviewDepth_{{$key > 1 ? $key - 2 : ''}}"></td>
                            <td class="total-cost removeInterviewDepth_{{$key > 1 ? $key - 2 : ''}}"></td>
                            <td class="total-cost removeInterviewDepth_{{$key > 1 ? $key - 2 : ''}}"><input type="text" class="form-control cpi" name="interview_depth_total_cost_1[]" attr="total1" value="{{$value}}"></td>
                            @endif
                            @endforeach
                        @endif
                        </tr>
                        <tr>
                        @if(count($interview_depth_total_cost_2) > 0)
                            <td class="total-cost"><input type="text" class="form-control" name="interview_depth_total_cost_2[]" value="{{$interview_depth_total_cost_2[0]}}" placeholder="Total cost for 1 FGD"></td>
                            @foreach ($interview_depth_total_cost_2 as $key => $value)
                            @if($key > 0)
                            <td class="total-cost removeInterviewDepth_{{$key > 1 ? $key - 2 : ''}}"></td>
                            <td class="total-cost removeInterviewDepth_{{$key > 1 ? $key - 2 : ''}}"></td>
                            <td class="total-cost removeInterviewDepth_{{$key > 1 ? $key - 2 : ''}}"><input type="text" class="form-control cpi" name="interview_depth_total_cost_2[]" attr="total2" value="{{$value}}"></td>
                            
                            @endif
                            @endforeach
                        @endif
                            {{-- <td class="total-cost"><input type="text" class="form-control"  name="interview_depth_total_cost_2[]" placeholder="Total cost for 2 FGDs"></td>
                            <td class="total-cost"></td>
                            <td class="total-cost"></td>
                            <td><input type="text" class="form-control cpi" name="interview_depth_total_cost_2[]" attr="total2" value=""></td> --}}
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>





    <div class="container">

        <div class="{{ isset($newrfq) && isset($newrfq->online) ? '' : 'd-none' }}" id="online-community">
            <h5>Online Community - Costing Sheet</h5>
                <?php
            if(isset($newrfq) && isset($newrfq->online)){
                $online_community_methodology = json_decode($newrfq->online->online_community_methodology);
                $online_community_currency = json_decode($newrfq->online->online_community_currency);
                $online_community_client = json_decode($newrfq->online->online_community_client);
                    $online_community_duration = json_decode($newrfq->online->online_community_duration);
                $online_community_loi_screener = json_decode($newrfq->online->online_community_loi_screener);
                $online_community_sample_loi_month = json_decode($newrfq->online->online_community_sample_loi_month);
                $online_community_countries = json_decode($newrfq->online->online_community_countries);
                $online_community_requirements = json_decode($newrfq->online->online_community_requirements);
                $online_community_incentives = json_decode($newrfq->online->online_community_incentives);
                $online_community_pmfree = json_decode($newrfq->online->online_community_pmfree);
                $online_community_project_management = json_decode($newrfq->online->online_community_project_management);
                $online_community_other = json_decode($newrfq->online->online_community_other);
                $online_community_total_cost = json_decode($newrfq->online->online_community_total_cost);
                
            }   
            ?>
            @if(isset($newrfq) && isset($newrfq->online))
           

            <div class="table-container mt-2">
                <table class="" id="OnlineCommunity">
                    <tbody>
                        <tr>
                            <td class="static-field w-25">Methodology</td>
                                @if(count($online_community_methodology) > 0)
                            @foreach($online_community_methodology as $key => $methodology)
                                <td  colspan="3">
                                <label class="mb-0 label">
                                <input type="text" class="form-control sample" name="online_community_methodology[]" value="{{$methodology}}"  placeholder="Online Community"></label>
                                </td>
                            @endforeach
                            @endif
                        </tr>
                        <tr>
                            <td class="static-field ">Currency</td>
                                @if(count($online_community_currency) > 0)
                            @foreach($online_community_currency as $key => $currency)
                            <td class="editable-field removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                            <label class="mb-0 label">
                            <input type="text" class="form-control sample" name="online_community_currency[]" value="{{$currency}}"  placeholder="currency">
                            </label>
                            </td>
                            @endforeach
                            @endif
                        </tr>
                        <tr>
                        <td class="static-field ">Client</td>
                                @if(count($online_community_client) > 0)
                                @foreach($online_community_client as $key => $value)
                                    <td class="editable-field removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                                        <label class="mb-0 label"> 
                                        <select class="form-control label-gray-3" name="online_community_client[]">
                                            <option class="label-gray-3" value="">Client</option>
                                            @foreach ($client as $v)
                                                <option value="{{ $v->client_name }}" {{$v->client_name == $value ? 'selected' : ''}}> 
                                                {{ $v->client_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        </label>
                                    </td>
                                    @endforeach
                                @endif
                            

                        </tr>
                        <tr>
                            <td class="static-field ">Duration</td>
                                @if(count($online_community_duration) > 0)
                                @foreach($online_community_duration as $key => $duration)
                                    <td class="editable-field removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                                    <label class="mb-0 label">
                                    <input type="text" class="form-control" name="online_community_duration[]" value="{{$duration}}" placeholder="Year" value="">
                                    </label>
                                    </td>
                                @endforeach
                                @endif

                        </tr>
                        <tr>
                            <td class="static-field ">LOI</td>
                                @if(count($online_community_loi_screener) > 0)
                                @foreach($online_community_loi_screener as $key => $screener)
                                    <td class="editable-field removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                                    <label class="mb-0 label">
                                    <input type="text" class="form-control sample" name="online_community_loi_screener[]"  value="{{$screener}}"  placeholder="mins">
                                    </label>
                                    </td>
                                @endforeach
                                @endif

                        </tr>
                        <tr>
                            <td class="static-field ">LOI/Month</td>
                                @if(count($online_community_sample_loi_month) > 0)
                                @foreach($online_community_sample_loi_month as $key => $sample_loi_month)
                                    <td class="editable-field removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                                    <label class="mb-0 label">
                                    <input type="text" class="form-control sample" name="online_community_loi_month[]" value="{{$sample_loi_month}}"  placeholder="mins">
                                    </label>
                                    </td>
                                    @endforeach
                                @endif

                        </tr>
                        <tr>
                            <td class="static-field ">Country</td>
                                @if(count($online_community_countries) > 0)
                                @foreach($online_community_countries as $key => $countries)
                                    <td class="editable-field removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                                    <label class="mb-0 label">
                                    <input type="text" class="form-control sample" name="online_community_countries[]" value="{{$countries}}"  placeholder="Country">
                                    </label>
                                    </td>
                                    @endforeach
                                @endif

                        </tr>
                        <tr>
                            <td class="static-field"></td>
                                @if(count($online_community_countries) > 0)
                                @foreach($online_community_countries as $key=> $online)
                                <td class="static-field removeOnlineCommunity_{{$key - 1}}">Sample</td>
                                <td class="static-field removeOnlineCommunity_{{$key - 1}}">CPI</td>
                                <td class="static-field removeOnlineCommunity_{{$key - 1}}">Total</td>
                            @endforeach
                            @endif
                        </tr>
                        <tr>
                            <?php 
                                $i = "";
                            ?>
                            <td class="static-field ">Recruitment</td>
                            @if(count($online_community_requirements) > 0)
                            @foreach($online_community_requirements as $key => $value)
                                <?php 
                                if($key == 3)
                                {
                                    $i = 0;
                                }
                                ?>
                                <td class="removeOnlineCommunity_{{$i}}"><input type="text" class="form-control sample" name="online_community_requirements[]" value="{{$value}}" attr="{{($key + 1) % 3 === 0 ? 'total' : ''}}"></td>
                                <?php
                                if(($key + 1) % 3 === 0 && $key > 3)
                                {
                                    $i++;
                                }
                                ?>
                            @endforeach
                            @endif
                        </tr>
                        <tr>
                            <?php 
                                $i = "";
                            ?>
                            <td class="static-field ">Incentives</td>
                            @if(count($online_community_incentives) > 0)
                            @foreach($online_community_incentives as $key => $value)
                                <?php 
                                if($key == 3)
                                {
                                    $i = 0;
                                }
                                ?>
                                <td class="removeOnlineCommunity_{{$i}}"><input type="text" class="form-control sample"  name="online_community_incentives[]"  value="{{$value}}" attr="{{($key + 1) % 3 === 0 ? 'total' : ''}}"></td>
                                <?php
                                if(($key + 1) % 3 === 0 && $key > 3)
                                {
                                    $i++;
                                }
                                ?>
                            @endforeach
                            @endif
                        </tr>
                        <tr>
                            <?php 
                                $i = "";
                            ?>
                            <td class="static-field">Project Management</td>
                            @if(count($online_community_pmfree) > 0)
                            @foreach($online_community_pmfree as $key => $value)
                                <?php 
                                if($key == 3)
                                {
                                    $i = 0;
                                }
                                ?>
                                <td class="removeOnlineCommunity_{{$i}}"><input type="text" class="form-control sample"  name="online_community_pmfree[]"  value="{{$value}}" attr="{{($key + 1) % 3 === 0 ? 'total' : ''}}"></td>
                                <?php
                                if(($key + 1) % 3 === 0 && $key > 3)
                                {
                                    $i++;
                                }
                                ?>
                            @endforeach
                            @endif
                        </tr>
                        @if(count($online_community_other) > 0)
                        @foreach($online_community_other as $k => $value)
                        <?php 
                            $i = "";
                        ?>
                        <tr id="otherFieldsOnline">
                        @if(count($value) > 0)
                        @foreach($value as $key => $other)
                            <?php 
                            if($key == 4)
                            {
                                $i = 0;
                            }
                            ?>
                            @if($key % 3 === 0 && $key == 0)
                            <td class="d-flex removeOnlineCommunity_{{$i}}">
                                <button type="button" class="d-none btn btn-sm  {{$k == 0 ? 'online_community_other btn-light' : 'remove_online_community btn-danger'}}">{{$k == 0 ? '+' : 'x'}}</button> 
                                <input type="text" class="form-control" placeholder="Others" name="online_community_other[{{$k}}][]" value="{{$other}}">
                            </td>
                            @elseif($key % 3 === 0)
                            <td class="removeOnlineCommunity_{{$i}}"><input type="text" class="form-control" name="online_community_other[{{$k}}][]" attr="total" value="{{$other}}"></td>
                            @else
                            <td class="removeOnlineCommunity_{{$i}}"><input type="text" class="form-control" name="online_community_other[{{$k}}][]" value="{{$other}}"></td>
                            @endif
                            <?php
                            if($key % 3 === 0 && $key > 3)
                            {
                                $i++;
                            }
                            ?>
                        @endforeach
                        @endif
                        </tr>
                        @endforeach
                        @endif
                        {{-- <tr id="otherFieldsOnline">
                            <td class="d-flex"><button type="button" class="btn btn-sm online_community_other">+</button> <input type="text" class="form-control"  name="online_community_other[0][]"  placeholder="Others"></td>
                            <td><input type="text" class="form-control sample"  name="online_community_other[0][]"></td>
                            <td><input type="text" class="form-control cpi" name="online_community_other[0][]"></td>
                            <td> <input type="text" class="form-control cpi" attr="total"  name="online_community_other[0][]" value=""></td>
                        </tr> --}}
                        <tr>
                            <td class="total-cost">Total Project Cost</td>
                            @if(count($online_community_total_cost) > 0)
                            @foreach ($online_community_total_cost as $key => $value)
                            <td class="total-cost removeOnlineCommunity_{{$key > 0 ? $key - 1 : ''}}"></td>
                            <td class="total-cost removeOnlineCommunity_{{$key > 0 ? $key - 1 : ''}}"></td>
                            <td class="removeOnlineCommunity_{{$key > 0 ? $key - 1 : ''}}"><input type="text" class="form-control" name="online_community_total_cost[]" value="{{$value}}"></td>
                            @endforeach
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>    