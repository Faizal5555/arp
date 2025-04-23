@extends('layouts.master')

@section('content')
<style>
    .form-control, .search-input {
        border-color: #0056b3;
        box-shadow: none;
    }

    .search-section {
        background-color: #f8f9fa;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .search-input {
        font-size: 1rem;
        padding: 0.75rem 1rem;
        border-radius: 8px;
    }

    .form-row .col {
        margin-bottom: 15px;
    }

    .search-label {
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.3rem;
    }
    select.form-control {
    border: 1px solid #0056b3;
    box-shadow: none;
    color: #333;
}
</style>

<div class="content-wrapper">
    <div class="container-fluid">
        <h4 class="mb-4 text-uppercase text-primary font-weight-bold border-bottom pb-2">
            <i class="fas fa-search mr-2"></i> Search Data Projects 
        </h4>
        <div class="search-section">

            <div class="form-group mb-4">
                <label for="search" class="search-label">Search</label>
                <input type="text" id="live-search" class="form-control search-input"
                    placeholder="Search Here...">
            </div>

            <div class="form-row">
                {{-- <div class="col-md-4">
                    <label for="client-name" class="search-label">Client Name</label>
                    <select id="client-name" class="form-control search-input">
                        <option value="">Select Client Name</option>
                        @foreach($clientNames as $name)
                            <option value="{{ $name }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="col-md-4">
                    <label for="industry" class="search-label">Industry</label>
                    <select id="industry" class="form-control search-input">
                        <option value="">Select Industry</option>
                        @foreach($industries as $ind)
                            <option value="{{ $ind }}">{{ $ind }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="pn-number" class="search-label">PN Number</label>
                    <input type="text" id="pn-number" class="form-control search-input" placeholder="PN Number">
                </div>
            </div>

         

        </div>

        <div class="mt-4" id="search-results">

            @include('business_secondary.search_results', ['results' => $results ?? [], 'keyword' => $keyword ?? ''])
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('live-search');
    const clientDropdown = document.getElementById('client-name');
    const industryDropdown = document.getElementById('industry');
    const pnInput = document.getElementById('pn-number');
    const resultsDiv = document.getElementById('search-results');

    function fetchResults() {
        const keyword = searchInput.value.trim();
        // const client_name = clientDropdown.value.trim();
        const industry = industryDropdown.value.trim();
        const pn_number = pnInput.value.trim();

        // Clear the results if all filters are empty
        if (!keyword && !industry && !pn_number) {
            resultsDiv.innerHTML = '';
            return;
        }

        const params = new URLSearchParams({
            keyword,
            // client_name,
            industry,
            pn_number
        });

        fetch(`{{ route('secondary.search') }}?${params.toString()}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            resultsDiv.innerHTML = html;
        })
        .catch(error => {
            console.error('Error fetching results:', error);
            resultsDiv.innerHTML = '<p>Error loading results</p>';
        });
    }

    // 🔥 Only trigger on keyup when user types in the search box
    searchInput.addEventListener('keyup', function () {
        fetchResults();
    });

    // Other filters (dropdowns, etc.)
    pnInput.addEventListener('input', fetchResults);
    // clientDropdown.addEventListener('change', fetchResults);
    industryDropdown.addEventListener('change', fetchResults);
});

function updateDownloadForm() {
    document.getElementById('download-keyword').value = document.getElementById('live-search').value;
    document.getElementById('download-client').value = document.getElementById('client-name').value;
    document.getElementById('download-industry').value = document.getElementById('industry').value;
    document.getElementById('download-pn').value = document.getElementById('pn-number').value;
}

</script>
@endsection
