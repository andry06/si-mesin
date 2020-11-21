@extends('adminlte.master')

@section('content')
<h1>Ini Halaman Create</h1>
@endsection

@push('scripts')
    <script>
        var wrappers = document.getElementsByClassName('wrappers');
        var items = ['ini', 'contoh'];

        console.log("Ini Items  : ", items);
    </script>
@endpush
