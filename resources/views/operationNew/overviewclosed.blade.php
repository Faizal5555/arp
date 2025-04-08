@extends('layouts.master')

@section('content')

{{-- daterange picker cdn --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.2/dist/echarts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- for chartjs --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    .status-badge {
    font-size: 17px; /* Adjust as needed */
    font-weight: bold;
    text-align: center; /* Optional for better emphasis */
    }
    .target-table {
        width: auto;
        margin: 0 auto;
        border-collapse: collapse;
    }

    .target-table th,
    .target-table td {
        min-width: 100px;
        max-width: 120px;
        padding: 8px;
        text-align: center;
        white-space: nowrap;
    }
    .status-colored {
    font-weight: bold;
    border-radius: 6px;
}
.table-country{
    table-layout: fixed;
    width: 100% !important; 
 
}
th, td {
    width: 150px !important; 
    overflow: hidden;
    text-overflow: ellipsis;  /* Truncate text with an ellipsis */
    white-space: nowrap; /* Set the desired width for both th and td */
}

  </style>

<div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
            <div style="background-color: #eaf0fb; padding: 10px 20px; border-left: 5px solid #2f66cd;">
                <h4 class="card-title" style="color: #2f66cd; margin: 0;">
                    Project Status
                </h4>
            </div>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Project No</th>
                  {{-- <th>Team Leader </th> --}}
                  <th>Project Manager Name</th>
                  {{-- <th>Quality Analyst Name	 </th> --}}
                  <th>Status </th>
                  <th>Progress </th>
                  <th>Target Group</th>
                  <th>Date</th>
                  <th>Comments</th>
                </tr>
              </thead>
              <tbody>
                
                  @if(count($operation)>0)
                  @foreach($operation as $key=> $data)
                   
                 <tr>
                     <td>{{$data->project_no}}</td>
                     
                     
                     {{-- <td> @if(count($tl)>0)
                      @foreach ($tl as $item)
                      @if($data->team_leader == $item->id)
                      {{$item->name}}
                      @endif
                      @endforeach
                      @endif
                      </td> --}}
                     
                     <td>
                          @if(count($pl)>0)
                      @foreach ($pl as $item)
                      @if($data->project_manager_name == $item->id)
                      {{$item->name}}
                      @endif
                      @endforeach
                      @endif
                      </td>
                      

                     {{-- <td>
                      @if(count($ql)>0)
                      @foreach ($ql as $item)
                      @if($data->quality_analyst_name == $item->id)
                      {{$item->name}}
                      @else
                      -
                      @endif
                      @endforeach
                      @endif
                      </td> --}}
                      
                      {{-- <td>
                          @if($data->status == 'hold')
                              <span class="badge badge-info status-badge">Ongoing Project</span>
                          @elseif($data->status == 'completed')
                              <span class="badge badge-success status-badge">Completed</span>
                          @else
                              <span class="badge badge-danger status-badge">Project Stop In Middle</span>
                          @endif
                      </td> --}}

                      <td>
                        @php
                            $statusClass = '';
                            $statusLabel = '';
                    
                            switch ($data->status) {
                                case 'completed':
                                    $statusClass = 'bg-success text-white';
                                    $statusLabel = 'Completed';
                                    break;
                                case 'stop':
                                    $statusClass = 'bg-danger text-white';
                                    $statusLabel = 'Cancel By Client';
                                    break;
                                default:
                                    $statusClass = 'bg-secondary text-white';
                                    $statusLabel = ucfirst($data->status);
                            }
                        @endphp
                    
                        <span class="status-badge status-colored {{ $statusClass }}" style="min-width: 170px; display: inline-block; padding: 8px;">
                            {{ $statusLabel }}
                        </span>
                    </td>
                      <td>
                          <div class="progress">
                              @if($data->status == 'hold')
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                             @elseif($data->status == 'completed')  <!-- ✅ Show progress for completed -->
                              <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                              @elseif($data->status == 'stop')  <!-- ✅ Show progress for completed -->
                              <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                              @else
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                           @endif
                          
                          </div>
                    </td>
                  <td class="country">
                      @php
                      $countries = explode(',', $data->country_name);
                      $groups = explode(',', $data->target_group);
                      $sampleTargets = json_decode($data->sample_target, true);
                      $sampleAchieved = json_decode($data->sample_achieved, true);
                      $totals = json_decode($data->total, true);
                  
                      $groupCount = count($groups);
                  
                      // Determine active columns (columns with at least one non-zero value)
                      $activeColumns = [];
                      for ($i = 0; $i < $groupCount; $i++) {
                          $hasValue = false;
                          foreach ($sampleTargets as $index => $targets) {
                              if (!empty($targets[$i]) && $targets[$i] != 0) {
                                  $hasValue = true;
                                  break;
                              }
                          }
                          foreach ($sampleAchieved as $index => $achieved) {
                              if (!empty($achieved[$i]) && $achieved[$i] != 0) {
                                  $hasValue = true;
                                  break;
                              }
                          }
                  
                          if ($hasValue) {
                              $activeColumns[] = $i;
                          }
                      }
                  @endphp
                  
                  <table class="table-country table-bordered text-center w-50">
                      <thead class="country">
                          <tr>
                              <th rowspan="2">Country</th>
                              @foreach ($activeColumns as $i)
                                  <th colspan="2">{{ $groups[$i] }}</th>
                              @endforeach
                          </tr>
                          <tr>
                              @foreach ($activeColumns as $i)
                                  <th>Sample Target</th>
                                  <th>Sample Achieved</th>
                              @endforeach
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($countries as $index => $country)
                              <tr>
                                  <td>{{ trim($country) }}</td>
                                  @foreach ($activeColumns as $i)
                                      <td>{{ $sampleTargets[$index][$i] ?? 0 }}</td>
                                      <td>{{ $sampleAchieved[$index][$i] ?? 0 }}</td>
                                  @endforeach
                              </tr>
                          @endforeach
                          <tr>
                              <th>Total</th>
                              @foreach ($activeColumns as $i)
                                  <th>{{ $totals[$i * 2] ?? 0 }}</th>
                                  <th>{{ $totals[$i * 2 + 1] ?? 0 }}</th>
                              @endforeach
                          </tr>
                      </tbody>
                  </table>
                  
                  </td>
                  <td>{{ $data->pm_updated_at ? \Carbon\Carbon::parse($data->pm_updated_at)->format('d-m-y') : '-' }}</td>
                  <td>
                      <span style="display: block; min-width: 250px; line-height: normal; white-space: normal; padding: 5px; word-break: break-word;">
                          {{ $data->project_comment ? $data->project_comment : '-' }}
                      </span>
                  </td>
                 </tr>
                   @endforeach
                    @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection
  <script>
    $(document).ready(function() {
        function applySelectColor(selectElement) {
    let value = $(selectElement).val();
    $(selectElement).removeClass('bg-success bg-danger text-white');

    switch (value) {
    
        case 'completed':
            $(selectElement).addClass('bg-success text-white');
            break;
        case 'stop':
            $(selectElement).addClass('bg-danger text-white');
            break;
    }
}
// Apply on page load
$('.status-colored').each(function () {
    applySelectColor(this);
});

// Apply on change
$(document).on('change', '.status-colored', function () {
    applySelectColor(this);
});
    });
  </script>