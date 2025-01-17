<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AsiasResearch Partners Data</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h4>Asia Research Partners Data</h4>

    <!-- Tabs -->
    <ul class="nav nav-tabs" id="dataTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="hcp-tab" data-toggle="tab" href="#hcp" role="tab" aria-controls="hcp" aria-selected="true">HCP Data</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="consumer-tab" data-toggle="tab" href="#consumer" role="tab" aria-controls="consumer" aria-selected="false">Consumer Data</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content mt-3" id="dataTabsContent">
        <!-- HCP Tab -->
        <div class="tab-pane fade show active" id="hcp" role="tabpanel" aria-labelledby="hcp-tab">
            <table id="hcpTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Reg ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th style="min-width: 150px;">City Name</th>
                        <th style="min-width: 150px;">City Code</th>
                        <th style="min-width: 150px;">Ph Number</th>
                        <th style="min-width: 150px;">Whatsapp Number</th>
                        <th>Speciality</th>
                        <th style="min-width: 150px;">Total Experience</th>
                        <th>Practice</th>
                        <th>License</th>
                        <th style="min-width: 150px;">Patient Month</th>
                        <th>Date</th>
                    </tr>
                </thead>
            </table>
        </div>

        <!-- Consumer Tab -->
        <div class="tab-pane fade" id="consumer" role="tabpanel" aria-labelledby="consumer-tab">
            <table id="consumerTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Reg ID</th>
                        <th style="min-width: 150px;">First Name</th>
                        <th style="min-width: 150px;">Last Name</th>
                        <th>Email</th>
                        <th style="min-width: 150px;">Phone Number</th>
                        <th>Address</th>
                        <th>Country</th>
                        <th style="min-width: 150px;">Zip Code</th>
                        <th style="min-width: 150px;">place where you live</th>
                        <th style="min-width: 150px;">interested to be invited</th>
                        <th style="min-width: 150px;">research studies have a web camera</th>
                        <th style="min-width: 150px;">Would you be willing to participate in a research</th>
                        <th style="min-width: 150px;">Do you agree to opt-in and participate in types of research</th>
                        <th style="min-width: 150px;">track your exposure to certain advertising</th>
                        <th style="min-width: 150px;">highest level of education</th>
                        <th style="min-width: 150px;">did you graduate from university/college</th>
                        <th style="min-width: 150px;">television do you watch per week</th>
                        <th style="min-width: 150px;">Do you smoke</th>
                        <th style="min-width: 150px;">brand of cigarettes do you smoke</th>
                        <th style="min-width: 150px;">how many cigarettes do you smoke in a day</th>
                        <th style="min-width: 150px;">Do you have access to a car</th>
                        <th style="min-width: 150px;">automotive-related purchases</th>
                        <th style="min-width: 150px;">cars are there in your household </th>
                        <th style="min-width: 150px;">If you own/lease a car(s)</th>
                        <th style="min-width: 150px;">the car(s) you own/lease</th>
                        <th style="min-width: 150px;">car (owned or leased) manufactured</th>
                        <th style="min-width: 150px;">Do you own a motorcycle</th>
                        <th style="min-width: 150px;">If you own a two wheeled vehicle</th>
                        <th style="min-width: 150px;">two wheeled vehicle, what engine capacity</th>
                        <th style="min-width: 150px;">own a two wheeled vehicle</th>
                        <th style="min-width: 150px;">own/lease a car(s), what fuel do they use</th>
                        <th style="min-width: 150px;">buying or leasing a new or used car</th>
                        <th style="min-width: 150px;">your current occupational status</th>
                        <th style="min-width: 150px;">What is your occupation</th>
                        <th style="min-width: 150px;">organisation's primary industry</th>
                        <th style="min-width: 150px;">employees work at your organisation</th>
                        <th style="min-width: 150px;">department do you primarily work </th>
                        <th style="min-width: 150px;">work in your organisation's IT department</th>
                        <th style="min-width: 150px;">primary role in your organisation</th>
                        <th style="min-width: 150px;">professional position in the organisation</th>
                        <th style="min-width: 150px;">illnesses/conditions</th>
                        <th style="min-width: 150px;">type of cancer</th>
                        <th style="min-width: 150px;">diagnosed with diabetes</th>
                        <th style="min-width: 150px;">Do you use glasses or contact lenses</th>
                        <th style="min-width: 150px;">Do you use a hearing aid</th>

                        <th>Date</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>


<script type="text/javascript">
$(document).ready(function () {
    // HCP Table
    const hcpTable = $('#hcpTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
        url: "{{ route('adminapp.data') }}",
        type: "POST", // Use POST instead of GET
        data: function (d) {
            d.type = 'hcp'; // Pass the type parameter
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token for Laravel
        }
    },
        dom: 'Bfrtip',
        buttons: [
            {
                text: 'Export All',
                action: function () {
                    exportData('hcp', 'hcp_data.xlsx'); // Trigger export for HCP data
                },
            },
        ],
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + 1 + meta.settings._iDisplayStart;
                },
                orderable: false,
                searchable: false,
            },
            { data: 'pno', name: 'pno' },
            { data: 'firstname', name: 'firstname' },
            { data: 'email', name: 'email' },
            { data: 'country1', name: 'country1' },
            { data: 'cityname', name: 'cityname' },
            { data: 'citycode', name: 'citycode' },
            { data: 'PhNumber', name: 'PhNumber' },
            { data: 'whatdsappNumber', name: 'whatdsappNumber' },
            { data: 'docterSpeciality', name: 'docterSpeciality' },
            { data: 'totalExperience', name: 'totalExperience' },
            { data: 'practice', name: 'practice' },
            { data: 'licence', name: 'licence' },
            { data: 'PatientsMonth', name: 'PatientsMonth' },
            {
                data: 'created_at',
                name: 'created_at',
                render: function (data) {
                    if (data) {
                        const date = new Date(data);
                        return `${('0' + date.getDate()).slice(-2)}/${
                            ('0' + (date.getMonth() + 1)).slice(-2)
                        }/${date.getFullYear()}`;
                    }
                    return '';
                },
            },
        ],
    });

    // Consumer Table
    const consumerTable = $('#consumerTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
        url: "{{ route('adminapp.data') }}",
        type: "POST", // Use POST instead of GET
        data: function (d) {
            d.type = 'consumer'; // Pass the type parameter
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token for Laravel
        }
    },
        dom: 'Bfrtip',
        buttons: [
            {
                text: 'Export All',
                action: function () {
                    exportData('consumer', 'consumer_data.xlsx'); // Trigger export for Consumer data
                },
            },
        ],
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + 1 + meta.settings._iDisplayStart; // Serial number
                },
                orderable: false,
                searchable: false,
            },
            { data: 'cno', name: 'cno', title: 'Reg ID' },
            { data: 'fname', name: 'fname', title: 'First Name' },
            { data: 'lname', name: 'lname', title: 'Last Name' },
            { data: 'email', name: 'email', title: 'Email' },
            { data: 'phone', name: 'phone', title: 'Phone' },
            { data: 'country', name: 'country', title: 'Country' },
            { data: 'address', name: 'address', title: 'Address' },
            { data: 'zipcode', name: 'zipcode', title: 'Zip Code' },

            // Dynamically include questions
            { data: 'que_1', name: 'que_1', title: 'Place where you live' },
            { data: 'que_2', name: 'que_2', title: 'Interested to be invited' },
            { data: 'que_3', name: 'que_3', title: 'Research studies with a web camera' },
            { data: 'que_4', name: 'que_4', title: 'Willingness to participate in research' },
            { data: 'que_5', name: 'que_5', title: 'Agree to participate in research types' },
            { data: 'que_6', name: 'que_6', title: 'Exposure tracking for advertising' },
            { data: 'que_7', name: 'que_7', title: 'Highest level of education' },
            { data: 'que_8', name: 'que_8', title: 'University/college graduation status' },
            { data: 'que_9', name: 'que_9', title: 'Hours of TV watched per week' },
            { data: 'que_10', name: 'que_10', title: 'Smoking habits' },
            { data: 'que_11', name: 'que_11', title: 'Brand of cigarettes smoked' },
            { data: 'que_12', name: 'que_12', title: 'Daily cigarette count' },
            { data: 'que_13', name: 'que_13', title: 'Access to a car' },
            { data: 'que_14', name: 'que_14', title: 'Automotive-related purchases' },
            { data: 'que_15', name: 'que_15', title: 'Number of cars in the household' },
            { data: 'que_16', name: 'que_16', title: 'Car ownership details' },
            { data: 'que_17', name: 'que_17', title: 'Owned/leased cars details' },
            { data: 'que_18', name: 'que_18', title: 'Year of car manufacture' },
            { data: 'que_19', name: 'que_19', title: 'Motorcycle ownership' },
            { data: 'que_20', name: 'que_20', title: 'Two-wheeled vehicle details' },
            { data: 'que_21', name: 'que_21', title: 'Engine capacity of two-wheelers' },
            { data: 'que_22', name: 'que_22', title: 'Two-wheeled vehicle usage' },
            { data: 'que_23', name: 'que_23', title: 'Car fuel type' },
            { data: 'que_24', name: 'que_24', title: 'Car buying/leasing preferences' },
            { data: 'que_25', name: 'que_25', title: 'Current occupational status' },
            { data: 'que_26', name: 'que_26', title: 'Occupation' },
            { data: 'que_27', name: 'que_27', title: "Organisation's primary industry" },
            { data: 'que_28', name: 'que_28', title: 'Number of employees in organisation' },
            { data: 'que_29', name: 'que_29', title: 'Primary work department' },
            { data: 'que_30', name: 'que_30', title: 'Work in IT department' },
            { data: 'que_31', name: 'que_31', title: 'Role in organisation' },
            { data: 'que_32', name: 'que_32', title: 'Professional position' },
            { data: 'que_33', name: 'que_33', title: 'Illnesses/conditions' },
            { data: 'que_34', name: 'que_34', title: 'Type of cancer' },
            { data: 'que_35', name: 'que_35', title: 'Diabetes diagnosis' },
            { data: 'que_36', name: 'que_36', title: 'Usage of glasses/contact lenses' },
            { data: 'que_37', name: 'que_37', title: 'Usage of hearing aid' },

            // Created Date column
            {
                data: 'created_at',
                name: 'created_at',
                title: 'Date',
                render: function (data) {
                    if (data) {
                        const date = new Date(data);
                        return `${('0' + date.getDate()).slice(-2)}/${
                            ('0' + (date.getMonth() + 1)).slice(-2)
                        }/${date.getFullYear()}`;
                    }
                    return '';
                },
            },
        ],
    });

    // Export data function
    function exportData(type, filename) {
    $.ajax({
        url: "{{ route('adminapp.data.export') }}", // Backend route for export
        method: 'GET',
        data: { type: type }, // Pass type=hcp or type=consumer
        success: function (response) {
            const data = response.data;

            // Use SheetJS to export data to Excel
            const worksheet = XLSX.utils.json_to_sheet(data);
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, "Data");
            XLSX.writeFile(workbook, filename); // Download file with the given filename
        },
        error: function () {
            alert('Failed to export data');
        },
    });
}
});

</script>
</body>
</html>
