@php
    $register_date = Auth::user()->register_date;
    $user_day = \App\Helpers\Helper::getCurrentUserDay($register_date);
@endphp
@foreach($chapters as $key => $chapter)
    @if($user_day >= $chapter->day)
        <li><a class="@if(isset($current_chapter->id) && $current_chapter->id == $chapter->id) active @endif" href="{{ route('home') }}?chapter={{ $chapter->id }}" data-id="{{ $chapter->id }}">{{ $chapter->name }}</a></li>
    @else
        <li><a href="javascript:void(0);" class="block-chapter"><i class="fa fa-lock"></i> {{ $chapter->name }}</a></li>
    @endif
@endforeach
