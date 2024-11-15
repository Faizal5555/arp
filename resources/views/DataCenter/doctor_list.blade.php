<div class="doctor-list">
    <div class="form-check one">
        <input class="form-check-input" type="checkbox" id="select_all">
        <label class="form-check-label" for="select_all">Select All</label>
    </div>

    @foreach($filteredDoctors as $doctor)
        <div class="doctor-item form-check">
            <input class="form-check-input doctor-checkbox" type="checkbox" name="doctors[]" value="{{ $doctor->id }}" id="doctor_{{ $doctor->id }}">
            <label class="form-check-label" for="doctor_{{ $doctor->id }}">
                <span class="doctor-name">{{ $doctor->firstname }}</span>
                <span class="doctor-email">({{ $doctor->email }})</span>
            </label>
        </div>
    @endforeach
</div>

<style>
    .doctor-list {
        max-width: 600px;
        margin-top: 12px;
    }

    .doctor-item {
        display: flex;
        align-items: center;
        padding: 10px;
        margin: 5px 0;
        border-radius: 5px;
        background-color: #f9f9f9;
        transition: background-color 0.2s;
    }

    .doctor-item:hover {
        background-color: #f0f4ff;
    }

    .form-check-input {
        margin-right: 10px;
    }

    .form-check-label {
        display: flex;
        align-items: center;
    }

    .doctor-name {
        font-weight: bold;
    }

    .doctor-email {
        color: #888;
        font-style: italic;
        font-size: 0.9em;
        font-weight: bold;
    }

    .form-check .form-check-label {
        margin: 0px;
    }
    .form-check {
        padding-left:10px;
    }
</style>

@push('scripts')
<script>
$(document).ready(function() {
    // Toggle all checkboxes when "Select All" is clicked
    $('#select_all').on('change', function() {
        $('.doctor-checkbox').prop('checked', this.checked);
    });

    // Uncheck "Select All" if any checkbox is manually unchecked
    $('.doctor-checkbox').on('change', function() {
        if ($('.doctor-checkbox:checked').length === $('.doctor-checkbox').length) {
            $('#select_all').prop('checked', true);
        } else {
            $('#select_all').prop('checked', false);
        }
    });
});
</script>
@endpush
