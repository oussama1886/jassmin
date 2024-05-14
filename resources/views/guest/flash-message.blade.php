@if ($message = session::get('success'))
<div class="alert alert-success"style="color: green; font-weight: bold;" >
    {{ $message }}
</div>
@endif

@if ($message = session::get('error'))
<div class="alert alert-success"style="color: red; font-weight: bold;" >
    {{ $message }}
</div>
@endif
