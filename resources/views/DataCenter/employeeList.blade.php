@extends('layouts.master')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<div class="container">
    <h4>Employee List</h4>

    <!-- Filter Tab for Consumer and HCP -->
    <ul class="nav nav-tabs" id="employeeTab" role="tablist">
        <li class="nav-item" role="presentation">
            <!-- Link to reload page with Consumer filter -->
            <a 
                class="nav-link {{ $filter == 'consumer' ? 'active' : '' }}" 
                href="{{ url()->current() }}?filter=consumer"
                id="consumer-tab"
            >
                Consumer
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <!-- Link to reload page with HCP filter -->
            <a 
                class="nav-link {{ $filter == 'hcp' ? 'active' : '' }}" 
                href="{{ url()->current() }}?filter=hcp"
                id="hcp-tab"
            >
                HCP
            </a>
        </li>
    </ul>

    <div class="tab-content" id="employeeTabContent">
        <!-- Consumer Tab -->
        <div class="tab-pane fade {{ $filter == 'consumer' ? 'show active' : '' }}" id="consumer" role="tabpanel" aria-labelledby="consumer-tab">
            <h4>Consumers</h4>
            <table id="consumerTable" class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($consumerEmployees as $employee)
                        <tr>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->country }}</td>
                            <td>
                                <a href="{{ route('dashboard.view', ['user_id' => $employee->user_id, 'type' => $filter]) }}" class="btn btn-primary">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No consumers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- HCP Tab -->
        <div class="tab-pane fade {{ $filter == 'hcp' ? 'show active' : '' }}" id="hcp" role="tabpanel" aria-labelledby="hcp-tab">
            <h5>HCP Employee</h5>
            <table id="hcpTable" class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Country</th>
                        <th>Speciality</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($hcpEmployees as $employee)
                        <tr>
                            <td>{{ $employee->firstname }}</td>
                            <td>{{ $employee->country }}</td>
                            <td>{{ $employee->docterSpeciality }}</td>
                            <td>
                               --
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No HCPs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- DataTables Initialization -->
<script>
   $(document).ready(function () {
    // Initialize DataTable for Consumer Table
    $('#consumerTable').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "responsive": true,
        "lengthMenu": [10, 20, 50],
    });

    // Initialize DataTable for HCP Table
    $('#hcpTable').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "responsive": true,
        "lengthMenu": [10, 20, 50],
    });

    
});

</script>
<style>
    /* Apply border only to the header (thead) and footer (tfoot) */
    table thead, table tfoot {
        border: 2px solid #ddd; /* Header and footer border */
    }
    table thead th, table tfoot td {
        border: 1px solid #ddd; /* Border within header and footer cells */
    }
    table tbody tr td {
        border: none; /* Remove border for table body rows */
    }
</style>
@endsection
