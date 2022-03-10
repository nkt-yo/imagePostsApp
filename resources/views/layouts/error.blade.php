@section('error')
@if ($errors->any())
<div class="alert alert-danger mt-3 list-disc list-inside text-sm text-red-600">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endsection
