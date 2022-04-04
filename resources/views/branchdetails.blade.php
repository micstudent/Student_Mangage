@extends('layout.default')

@section('content')
<h1>Student Details</h1>
<table class="table table-bordered">
	<thead>
		<th>Branch full name</th>
		<th>Branch sort name</th>
		<th>Edit</th>
		<th>Delete</th>
	</thead>
	<tbody>
		
			@foreach($branches as $branch)
			<tr>
			<td>{{$branch->bfull}}</td>
			<td>{{$branch->bsort}}</td>
			<td><a href="{{route('branch.edit', ['id' => $branch->id])}}">Edit</a></td>
			<td><a href="{{route('branch.delete', ['id' => $branch->id])}}" onclick="return confirm('Are you sure?')">Delete</a></td>
			</tr>
			@endforeach
		
	</tbody>
</table>
{{$branches->links()}}
@endsection