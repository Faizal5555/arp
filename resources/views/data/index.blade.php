<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        <th>Sno</th>
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
                        {{-- <th>Created At</th> --}}
                    </tr>
                </thead>
            </table>
        </div>

        <!-- Consumer Tab -->
        <div class="tab-pane fade" id="consumer" role="tabpanel" aria-labelledby="consumer-tab">
            <table id="consumerTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th style="min-width: 150px;">First Name</th>
                        <th style="min-width: 150px;">Last Name</th>
                        <th>Email</th>
                        <th style="min-width: 150px;">Phone Number</th>
                        <th>Address</th>
                        <th>Country</th>
                        <th style="min-width: 150px;">Zip Code</th>
                        {{-- <th>Created At</th> --}}
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
            url: "{{ url('adminapp/data') }}",
            data: { type: 'hcp' }, // Pass type=hcp for HCP data
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
            // {
            //     data: 'created_at',
            //     name: 'created_at',
            //     render: function (data) {
            //         if (data) {
            //             const date = new Date(data);
            //             return `${('0' + date.getDate()).slice(-2)}/${
            //                 ('0' + (date.getMonth() + 1)).slice(-2)
            //             }/${date.getFullYear()}`;
            //         }
            //         return '';
            //     },
            // },
        ],
    });

    // Consumer Table
    const consumerTable = $('#consumerTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ url('adminapp/data') }}",
            data: { type: 'consumer' }, // Pass type=consumer for Consumer data
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
                    return meta.row + 1 + meta.settings._iDisplayStart;
                },
                orderable: false,
                searchable: false,
            },
            { data: 'fname', name: 'fname' },
            { data: 'lname', name: 'lname' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'country', name: 'country' },
            { data: 'address', name: 'address' },
            { data: 'zipcode', name: 'zipcode' },
            // {
            //     data: 'created_at',
            //     name: 'created_at',
            //     render: function (data) {
            //         if (data) {
            //             const date = new Date(data);
            //             return `${('0' + date.getDate()).slice(-2)}/${
            //                 ('0' + (date.getMonth() + 1)).slice(-2)
            //             }/${date.getFullYear()}`;
            //         }
            //         return '';
            //     },
            // },
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

        // Prepare data with blank rows
        const formattedData = [];
        data.forEach((row, index) => {
            // Add the actual data row
            formattedData.push(row);

            // Add a blank row after each data row
            if (index < data.length - 1) {
                const blankRow = {}; // Create an empty object for the blank row
                Object.keys(row).forEach((key) => {
                    blankRow[key] = ''; // Add empty values for each column
                });
                formattedData.push(blankRow);
            }
        });

        // Use SheetJS to export data to Excel
        const worksheet = XLSX.utils.json_to_sheet(formattedData);
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
