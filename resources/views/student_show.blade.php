@extends('layout.default')

@section('content')

<div style="text-align: center;border: 1px solid black; width:200px;margin-top: 70px">
	<img style="width: 100%" src="{{url('/posting')}}/{{$student->image}}">
	<div>
		<p>Student Name : {{$student->sname}}</p>
		<p>Father Name : {{$student->fname}}</p>
		<p>Class : {{$student->class}}</p>
		<p>Email : {{$student->email}}</p>
	</div>
</div>

@endsection