@extends('layouts.app')
@section('content')
<h1>INI home</h1>
<form action="/auth/logout" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
@endsection
