@extends('layout.default')

@section('content')
<h1>Registration Page</h1>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">
        <br />
        @if($msg = Session::get('success'))
            <div class="alert alert-success">
              <p> {{ $msg }} </p>
            </div>
       
        @endif
        <form action="{{url('studentstore')}}" method="post" id="demo-form2"  class="form-horizontal form-label-left" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Student Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="sname" id="first-name" required="required" class="form-control col-md-7 col-xs-12 @error('sname') is-invalid @enderror">
              @error('sname')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Father's Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="fname" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12 @error('fname') is-invalid @enderror">
              @error('fname')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Class</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input name="class" id="middle-name" class="form-control col-md-7 col-xs-12 @error('class') is-invalid @enderror" type="text" name="class">
              @error('class')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone Num <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input name="phnum" id="birthday" class="date-picker form-control col-md-7 col-xs-12 @error('phnum') is-invalid @enderror" required="required" type="text">
              @error('phnum')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input name="email" id="birthday" class="date-picker form-control col-md-7 col-xs-12 @error('email') is-invalid @enderror" required="required" type="text">
              @error('email')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Branch: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="date-picker form-control col-md-7 col-xs-12 branches @error('branch_id') is-invalid @enderror" name="branch_id">
                <option value="null">-- Select Branch --</option>
                @foreach($branches as $branch)
                <option value="{{ $branch->id }}">{{$branch->bfull}}</option>
                @endforeach
              </select>
              @error('branch_id')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Course: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="date-picker form-control col-md-7 col-xs-12 courses @error('course_id') is-invalid @enderror" name="course_id" disabled>
                <option value="null">-- Select Course --</option>
                @foreach($courses as $course)

                <option value="{{ $course->id }}">{{$course->cname}}</option>
                @endforeach
              </select>
              @error('course_id')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Image: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input name="image" id="image" class="date-picker form-control col-md-7 col-xs-12 @error('image') is-invalid @enderror"  type="file">
              @error('image')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              
  <button class="btn btn-primary" type="reset">Reset</button>
              <button type="submit" name="submit" class="btn btn-success">Submit</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@push('footer-scripts')
<script type="text/javascript">


     $(document).on('change', '.branches', function(){
          branch_id = $(this).val();console.log("branch_id="+ branch_id);
          $.ajax('student/courses',{
            
            dataType: 'json',
            data: {"id":branch_id,"_token":"{{ csrf_token() }}"},
            method: 'post',
            success: function(data){
              var courses='<option value="null">-- Select Course --</option>';console.log(courses);
              var arr = data.course.length;console.log( arr);
              var aa = data.course;
              
                //$(".courses option[value=]").attr("selected","selected");
              
                $('.courses').prop('disabled', false);
               // $('.course').prop('disabled', false);
              
              
              for(var i=0;i<arr;i++)
              {
                courses += '<option value="'+aa[i].id+'">'+aa[i].cname+'</option>';
              }

              $(".courses").html(courses);
            }

          });

     });

</script>
@endpush
