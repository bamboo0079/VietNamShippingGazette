<option disabled>{{ __("Cánh đồng") }}</option>
@foreach($chapters as $chapter)
    <option value="{{ $chapter->id }}" @if(count($chapter->audios)) class="has-audio" @endif>{{ $chapter->name }}</option>
@endforeach
