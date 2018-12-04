@extends('backend.layouts.app')
@section('title') Create Terms @stop 
@section('styles')
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 <link rel="stylesheet" href="{{ asset('assets/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
 <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endsection
@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <form method="POST"  class="form-horizontal form-groups-bordered">
                        {!! csrf_field() !!}
     
                        <div class="form-group">
                            <label for="field-ta" class="control-label" style="padding:20px;">Policies</label>
<div class="mb-3">
                <textarea class="textarea" placeholder="Place some text here" name="terms" value="<?php if(!empty($policies)){
echo $policies->terms;} else { echo old('terms'); } ?>"style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php if(!empty($policies)){
echo $policies->terms;} else { echo old('terms'); } ?>
                          </textarea>
              </div> </div>
                                @if ($errors->has('terms'))
                                    <span class="help-block">
                                        <strong style="color:red; font-size:14px;">{{ $errors->first('terms') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>     


                        <div class="form-group">
                            <div class="col-sm-offset-10 col-sm-12"  style="padding:20px;">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>@stop
@section('scripts')
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    ClassicEditor
      .create(document.querySelector('#editor1'))
      .then(function (editor) {
        // The editor instance
      })
      .catch(function (error) {
        console.error(error)
      })

    // bootstrap WYSIHTML5 - text editor

    $('.textarea').wysihtml5({
      toolbar: { fa: true }
    })
  })
</script>
@endsection