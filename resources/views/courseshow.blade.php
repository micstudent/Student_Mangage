@extends('layout.default')

@section('content')
<h1>Course details</h1>
<table class="table table-bordered">
	<thead>
		<th>Branch name</th>
		<th>Course name</th>
		<th>Edit</th>
		<th>Delete</th>
	</thead>
	<tbody>
		
			@foreach($courses as $course)
			<tr>
			<td>{{$course->bfull}}</td>
			<td>{{$course->cname}}</td>
			<td><a href="{{ route('course.edit',['id' => $course->id]) }}">Edit</a></td>
			<td><a href="{{ route('course.delete',['id' => $course->id]) }}" onclick="return confirm('Are you sure?')">Delete</a></td>
			</tr>
			@endforeach
		
	</tbody>
</table>
{{$courses->links()}}
@endsection