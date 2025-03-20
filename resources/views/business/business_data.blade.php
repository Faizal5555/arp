<style>


 textarea.form-control {
        border-color:#0056b3;
    }

</style>

<div class="d-flex justify-content-center">
                <div class="col-md-12">
                    <label class="mb-2 pl-5"><strong>Question & Answer Section</strong></label>
                    <div id="qa-wrapper">
                        @if($questions->isNotEmpty())
                            @foreach($questions as $index => $qa)
                                <input type="hidden" name="question_id[]" value="{{ $qa->id }}">
                                <div class="row qa-row mb-3">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-3">
                                        <textarea class="form-control" name="que[]" placeholder="Enter question">{{ $qa->question }}</textarea>
                                    </div>
                                    <div class="col-md-3">
                                        <textarea class="form-control" name="ans[]" placeholder="Enter answer">{{ $qa->answer }}</textarea>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="file" class="form-control" name="attachment[]">
                                        @if($qa->attachment)
                                        <div>
                                            <a href="{{ url('adminapp/storage/app/public/' . $qa->attachment) }}" target="_blank">
                                                {{ ($qa->attachment) }}
                                            </a>
                                        </div>
                                    @endif
                                    </div>
                                    <div class="col-md-1 d-flex align-items-start">
                                        @if($index == 0)
                                            <button type="button" class="btn btn-sm btn-success add-qa-btn m-2 mt-1">+</button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-danger remove-qa-btn m-2 mt-1">−</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Default empty row if no questions exist -->
                            <div class="row qa-row mb-3">
                                <div class="col-md-1"></div>
                                <div class="col-md-3">
                                    <textarea class="form-control" name="que[]" placeholder="Enter question"></textarea>
                                </div>
                                <div class="col-md-3">
                                    <textarea class="form-control" name="ans[]" placeholder="Enter answer"></textarea>
                                </div>
                                <div class="col-md-3">
                                    <input type="file" class="form-control mb-1" name="attachment[]">
                                
                                    
                                </div>
                                <div class="col-md-1 d-flex align-items-start">
                                    <button type="button" class="btn btn-sm btn-success add-qa-btn m-2 mt-1">+</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>