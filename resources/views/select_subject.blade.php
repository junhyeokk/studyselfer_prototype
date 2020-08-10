@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading"><h2>과목 선택</h2></div>
        <div class="panel-body">
            <a href="{{ url('/select/물리1') }}">물리 1</a><br/>
            <a href="{{ url('/select/화학1') }}">화학 1</a><br/>
            <a href="{{ url('/select/생물1') }}">생물 1</a><br/>
            <a href="{{ url('/select/지구과학1') }}">지구과학 1</a><br/>
        </div>
    </div>
</div>
@endsection
