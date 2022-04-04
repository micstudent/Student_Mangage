@extends('layout.default')

@section('content')
<h1>Course Edit</h1>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">
        <br />
        <form action="{{ route('course.update',$branches->cid) }}" method="post" id="demo-form2"  class="form-horizontal form-label-left">
          @csrf
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Branch name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control col-md-7 col-xs-12" name="branchid" id="someselect">
                {{-- <option value="{{$branches->id}}" selected>{{$branches->bfull}}</option> --}}
                @foreach($courses as $course)
                  <option value="{{$course->id}}">{{ $course->bfull }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Course name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="cname" value="{{$branches->cname}}" id="last-name" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <!-- <button class="btn btn-primary" type="cancel">Cancel</button> -->
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

$(document).ready(function() {
    $("#someselect option[value={{$branches->bid}}]").attr("selected","selected");
});

</script>
@endpush