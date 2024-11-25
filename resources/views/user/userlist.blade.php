<div class="user-list">
    <div class="form-check one">
        <input class="form-check-input" type="checkbox" id="select_all">
        <label class="form-check-label" for="select_all">Select All</label>
    </div>
    @foreach($filteredUsers as $user)
    <div class="user-item form-check">
        <input class="form-check-input user-checkbox" type="checkbox" name="users[]" value="{{ $user->id }}" id="user_{{ $user->id }}">
        <label class="form-check-label" for="user_{{ $user->id }}">
            <span class="user-name">{{ $user->fname }} {{ $user->lname }}</span>
            <span class="user-email">({{ $user->email }})</span>
        </label>
    </div>
    @endforeach
</div>

<style>
.user-list {
max-width: 600px;
margin-top: 12px;
}

.user-item {
display: flex;
align-items: center;
padding: 10px;
margin: 5px 0;
border-radius: 5px;
background-color: #f9f9f9;
transition: background-color 0.2s;
}

.user-item:hover {
background-color: #f0f4ff;
}

.form-check-input {
margin-right: 10px;
}

.form-check-label {
display: flex;
align-items: center;
}

.user-name {
font-weight: bold;
}

.user-email {
color: #888;
font-style: italic;
font-size: 0.9em;
font-weight: bold;
}

.form-check .form-check-label {
margin: 0px;
}
.form-check {
padding-left: 10px;
}
</style>


<script>
$(document).ready(function() {
// Toggle all checkboxes when "Select All" is clicked
$('#select_all').on('change', function() {
$('.user-checkbox').prop('checked', this.checked);
});

// Uncheck "Select All" if any checkbox is manually unchecked
$('.user-checkbox').on('change', function() {
if ($('.user-checkbox:checked').length === $('.user-checkbox').length) {
    $('#select_all').prop('checked', true);
} else {
    $('#select_all').prop('checked', false);
}
});
});
</script>

