@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session()->has('success'))
<div class="alert alert-success alert-dismissable text-left">
    {!! __(session()->get('success')) !!}
</div>
@endif
@if (session('err'))
<div class="alert alert-danger alert-dismissable">
    {!! __(session('err')) !!}
</div>
@endif
@if (session('info'))
<div class="alert alert-primary alert-dismissable text-left">
    {!! __(session('info')) !!}
</div>
@endif

