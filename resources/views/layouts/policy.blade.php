<?php $title_heading = '開宗明義章、第一。'; ?>
@include('frontend.elements.header-policy')
<div class="main-content container @if(isset($policy)) general-page @endif">
  @yield('content')
</div>

