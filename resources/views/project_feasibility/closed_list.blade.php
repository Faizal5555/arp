@extends('layouts.master')

@section('content')

<style>
    .header {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
        color: white;
    }
    a.ml-2.btn.btn-primary {
    float: right;
    }
a.ml-2.btn.btn-primary {
    background-color: #fff;
    color: #0b5dbb;
    border-color: #ffff;
}

a.ml-2.btn.btn-primary {
    /* margin-left: -3px; */
    margin: 10px;
}

select.custom-select.custom-select-sm.form-control.form-control-sm {
    margin: 11px;
    color: #000;
}
select.custom-select.custom-select-sm.form-control.form-control-sm {
    padding-left: 10px;
    padding-right: 26px;
}

/*next table follow up css*/
 label.mb-0.expired {
    background-color: #c82333;
    border-color: #bd2130;
    padding: 13px;
    border-radius: 20px;
}
label.mb-0.not-expired {
    background: #198ae3;
    border-color: #198ae3;
    padding: 13px;
    border-radius: 20px;
}

</style>

<div class="card">
    <div class="card-header header">
        <h5>Closed Feasibility Projects</h5>
    </div>

    <!-- Table Section -->
    <div class="table-responsive mt-4 px-2">
        <table class="table table-bordered mt-3" id="closed-feasibility-table">
            <thead>
                <tr>
                    <th>S.no</th>
                    <th>Date</th>
                    <th>PN Number</th>
                    <th>Respondent FirstName</th>
                    <th>Respondent LastName</th>
                    <th>Email Subject</th>
                    <th>Project Launch Date</th>
                    <th>Countries</th>
                    <th>Respondent Title</th>
                    @if(auth()->user()->user_type === 'admin')
                        <th>Respondent Email</th>
                    @endif
                    <th>Samples Required</th>
                    <th>Samples Delivered</th>
                    <th>Incentive Promised</th>
                    <th>Total Incentive Paid</th>
                    <th>Incentive Paid Date</th>
                    <th>Mode of Payment</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dynamic rows will be appended here -->
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        loadClosedProjects();

        function loadClosedProjects() {
            $('#closed-feasibility-table').DataTable({
                dom: 'Blfrtip',
                "lengthMenu": [ [10, 25, 50,75,100, -1], [10, 25, 50,75,100, "All"] ],
                ajax: {
                    url: "{{ route('projectFeasibility.closed') }}",
                    method: "GET",
                },
                columns: [
                    { data: null, render: function (data, type, row, meta) { return meta.row + 1; } },
                    { data: "date" },
                    { data: "pn_number" },
                    {
                        data: "respondent_firstname",
                        render: function(data, type, row) {
                            return data ? data : '-';
                    }
                    },
                    {
                        data: "respondent_lastname",
                        render: function(data, type, row) {
                            return data ? data : '-';
                    }
                    },

                    { data: "email_subject_line" },
                    { data: "project_launch_date" },
                    { data: "target_countries", render: function (data) { return JSON.parse(data || '[]').join(', '); } },
                    { data: "responded_titles", render: function (data) { return JSON.parse(data || '[]').join(', '); } },
                    @if(auth()->user()->user_type === 'admin')
                        { data: "responded_emails", render: function (data) { return JSON.parse(data || '[]').join(', '); } },
                    @endif
                    { data: "no_of_sample_required" },
                    { data: "no_of_sample_delivered" },
                    {
                        data: "incentive_promised",
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: "total_incentive_paid",
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: "incentive_paid_date",
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: "mode_of_payment",
                        render: function(data, type, row) {
                            try {
                                const parsed = JSON.parse(data || '[]');
                                if (Array.isArray(parsed)) {
                                    return parsed.join(', ');
                                }
                                return typeof parsed === 'string' ? parsed : '-';
                            } catch (e) {
                                return data || '-';
                            }
                        }
                    }
                ]
            });
        }
    });
</script>
@endpush
