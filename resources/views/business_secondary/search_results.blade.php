<style>
    .card-title {
    font-weight: 600;
}

ul.list-inline li {
    font-size: 0.9rem;
    padding: 0.4rem 0.6rem;
    border-radius: 0.25rem;
}
</style>

@if(!empty($results) && count($results))
<div class="d-flex justify-content-end m-2">
    <form method="GET" action="{{ route('search.export') }}">
        <input type="hidden" name="keyword" value="{{ request('keyword') }}">
        <input type="hidden" name="client_name" value="{{ request('client_name') }}">
        <input type="hidden" name="industry" value="{{ request('industry') }}">
        <input type="hidden" name="pn_number" value="{{ request('pn_number') }}">
        <button class="btn btn-success" type="submit">
            <i class="fa fa-download"></i> Download XLSX
        </button>
    </form>
</div>
@endif

@if(!empty($results) && count($results))
    @foreach($results as $research)
        <div class="card border-primary shadow-sm mb-4">
            <div class="card-body">
                @php
                    $keyword = request('keyword');
                @endphp
               @if(!$keyword)
                <h5 class="card-title text-primary mb-2">
                    Client: {{ $research->client_name }}
                </h5>
                @endif

                
                @if($keyword)
                    {{-- Show only data that matches the keyword --}}
                    @if(Str::contains(strtolower($research->pn_number), strtolower($keyword)))
                        <div class="mb-2">
                            <span class="fw-semibold">PN Number:</span> {{ $research->pn_number }}
                        </div>
                    @endif

                    @if(Str::contains(strtolower($research->subject_line), strtolower($keyword)))
                        <div class="mb-2">
                            <span class="fw-semibold">Subject Line:</span> {{ $research->subject_line }}
                        </div>
                    @endif

                    @if(Str::contains(strtolower($research->industry), strtolower($keyword)))
                        <div class="mb-2">
                            <span class="fw-semibold">Industry:</span> {{ $research->industry }}
                        </div>
                    @endif

                    @if(Str::contains(strtolower($research->client_name), strtolower($keyword)))
                    <div class="mb-2">
                        <span class="fw-semibold">Client Name:</span> {{ $research->client_name }}
                    </div>
                    @endif
                    

                    {{-- Show only questions related to the keyword --}}
                    @if($research->questions && count($research->questions))
                        <div class="mb-3">
                            @if($keyword)
                            <h6 class="fw-semibold text-primary">Questions:</h6>
                            @endif
                            <ul class="list-unstyled ps-3">
                                @foreach($research->questions as $question)
                                    @if(Str::contains(strtolower($question->question), strtolower($keyword)) || Str::contains(strtolower($question->answer), strtolower($keyword)))
                                        <li class="mb-2">
                                            <span class="fw-semibold">Q:</span> {{ $question->question }}<br>
                                            <span class="fw-semibold">A:</span> {{ $question->answer }}<br>
                                            @if($question->attachment)
                                                <a href="{{ asset('adminapp/storage/app/public/' . $question->attachment) }}" class="text-decoration-none text-primary" target="_blank" download>  
                                                    <i class="fas fa-paperclip px-1"></i>View Attachment
                                                </a>
                                            @endif
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

                @else
                    {{-- Show full details if no keyword is searched --}}
                    <div class="mb-2">
                        <span class="fw-semibold">PN Number:</span> {{ $research->pn_number }}<br>
                        <span class="fw-semibold">Subject Line:</span> {{ $research->subject_line }}<br>
                        <span class="fw-semibold">Industry:</span> {{ $research->industry }}
                         @if($research->attachments)
                    @php
                        $attachments = explode(',', $research->attachments);
                    @endphp
                    <div class="mt-3">
                        <h6 class="fw-semibold text-primary">Attachments:</h6>
                        <ul class="list-unstyled ps-3 mb-0" style="max-height: 120px; overflow-y: auto;">
                            @foreach($attachments as $attachment)
                                @php $attachment = trim($attachment); @endphp
                                @if($attachment)
                                    <li>
                                        <a href="{{ asset('adminapp/storage/app/public/' . $attachment) }}" target="_blank" download class="text-decoration-none text-primary">
                                            <i class="fas fa-paperclip px-1"></i>{{ basename($attachment) }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if($research->questions && count($research->questions))
                        <div class="mb-3">
                            <h6 class="fw-semibold text-primary">Questions:</h6>
                            <ul class="list-unstyled ps-3">
                                @foreach($research->questions as $question)
                                    <li class="mb-2">
                                        <span class="fw-semibold">Q:</span> {{ $question->question }}<br>
                                        <span class="fw-semibold">A:</span> {{ $question->answer }}<br>
                                        @if($question->attachment)
                                            <a href="{{ asset('adminapp/storage/app/public/' . $question->attachment) }}" class="text-decoration-none text-primary" target="_blank" download>  
                                                <i class="fas fa-paperclip px-1"></i>View Attachment
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
    @endforeach
@else
    <div class="alert alert-warning">No results found.</div>
@endif