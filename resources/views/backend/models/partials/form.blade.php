<link href="{{asset('assets/fine-uploader/fine-uploader-new.min.css')}}" rel="stylesheet">
<script type="text/javascript" src="{{asset('assets/fine-uploader/jquery.fine-uploader.min.js')}}"></script>
 <div class="form-group required">
         
        </div>
<script type="text/template" id="qq-template-manual-trigger">
    <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here">
        <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
            <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
        </div>
        <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
            <span class="qq-upload-drop-area-text-selector"></span>
        </div>
        <div class="buttons">
            <div class="qq-upload-button-selector qq-upload-button">
                <div>Select files</div>
            </div>
            <button type="button" id="trigger-upload" class="btn btn-primary">
                <i class="icon-upload icon-white"></i> Upload
            </button>
        </div>
        <span class="qq-drop-processing-selector qq-drop-processing">
            <span>Processing dropped files...</span>
            <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
        </span>
        <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
            <li>
                <div class="qq-progress-bar-container-selector">
                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                </div>
                <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                <span class="qq-upload-file-selector qq-upload-file"></span>
                <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                <span class="qq-upload-size-selector qq-upload-size"></span>
                <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancel</button>
                <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Retry</button>
                <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Delete</button>
                <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
            </li>
        </ul>
        <dialog class="qq-alert-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">Close</button>
            </div>
        </dialog>

        <dialog class="qq-confirm-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">No</button>
                <button type="button" class="qq-ok-button-selector">Yes</button>
            </div>
        </dialog>

        <dialog class="qq-prompt-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <input type="text">
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">Cancel</button>
                <button type="button" class="qq-ok-button-selector">Ok</button>
            </div>
        </dialog>
    </div>
</script>
<style>
    #trigger-upload {
        color: white;
        background-color: #00ABC7;
        font-size: 14px;
        padding: 7px 20px;
        background-image: none;
    }

    #fine-uploader-manual-trigger .qq-upload-button {
        margin-right: 15px;
    }

    #fine-uploader-manual-trigger .buttons {
        width: 50%;
    }

    #fine-uploader-manual-trigger .qq-uploader .qq-total-progress-bar-container {
        width: 60%;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('id_car_make', 'Make *') !!}
            {!! Form::select('id_car_make',$makes, null, ['class' => 'form-control input-sm chosen', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('youtube_link', 'Youtube ID',['class'=>'control-label']) !!}
            {!! Form::text('youtube_link', null, ['class' => 'form-control input-sm']) !!}
        </div>
         
        <div class="form-group">
            {!! Form::label('year', 'Year *') !!}
            {!! Form::select('year',['2018' => '2018', '2019' => '2019'], null, ['class' => 'form-control input-sm chosen', 'required']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('name', 'Name',['class'=>'control-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control input-sm', 'required']) !!}
        </div>
         <div class="form-group required">
            {!! Form::label('searchImage', 'Search Image',['class'=>'control-label']) !!}
            {!! Form::file('searchImage', null, ['class' => 'form-control input-sm', 'required']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('niceName', 'Nice Name',['class'=>'control-label']) !!}
            {!! Form::text('niceName', null, ['class' => 'form-control input-sm', 'required']) !!}
        </div>
        <div class="form-group">
            <div class="">
                <a class="btn btn-primary" data-toggle="modal" data-target="#review_sort_img_modal">Review/Sort Images</a>
                <input type="hidden" id="image_names" name="image_names" value="{{isset($model) && $model->model_image != '' && $model->model_image != null?$model->model_image:''}}" />
            </div>
            <div id="fine-uploader-manual-trigger"></div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="review_sort_img_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Review/Sort Images</h5>
        <button type="button" id="close_sort_modal_btn" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="">
            <ul id="sortable">
             
                @if(isset($model) && $model->model_image != '' && $model->model_image != null)
                    <?php
                        $model_images = explode(',', $model->model_image);
                    ?>
                    @if(count($model_images))
                        @foreach($model_images as $model_image)
                         @if($model_image == $model->youtube_link)
                         <li class="model_image_li" dataid="{{$model->youtube_link}}"><img src="https://img.youtube.com/vi/{{$model->youtube_link}}/0.jpg" width="150px" height="100px" /></li>
                          @else
                          <li class="model_image_li" dataid="{{$model_image}}"><img src="{{asset('assets/car_images/model_images/'.$model_image)}}" width="150px" height="100px" /></li>
                         @endif 
                        @endforeach
                    @endif
                @endif
                
                @if(isset($model) && $model->youtube_link)
             <li class="model_image_li" dataid="{{$model->youtube_link}}"><img src="https://img.youtube.com/vi/{{$model->youtube_link}}/0.jpg" width="150px" height="100px" /></li>
              @endif
            </ul>
        </div>
        <div class="" style="text-align: right;">
            <a class="btn btn-danger hide" id="delete_image">Remove Selected Image</a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="close_sort_modal">Close</button>
        <button type="button" class="btn btn-primary" id="save_sort_model_imgs">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
    $('#close_sort_modal').click(function(){
        $('#review_sort_img_modal').modal('hide');
    });
    $('#close_sort_modal_btn').click(function(){
       $('#review_sort_img_modal').modal('hide'); 
    });
    $('#review_sort_img_modal').on('hidden.bs.modal', function(e){
        $('body').addClass('modal-open');
    });
    $('#review_sort_img_modal').on('show.bs.modal', function(e){
        $('#sortable .model_image_li').removeClass('hide').removeClass('selected');
        $('#delete_image').addClass('hide');
    });
    $('#sortable').on('click','.model_image_li', function(){
        $('#sortable .model_image_li').removeClass('selected');
        $('#delete_image').removeClass('hide');
        $(this).addClass('selected');
    });
    $('#sortable').on('mousedown','.model_image_li', function(){
        $('#sortable .model_image_li').removeClass('selected');
        $('#delete_image').removeClass('hide');
        $(this).addClass('selected');
    });
    $('#delete_image').click(function(){
        $('#sortable .model_image_li.selected').addClass('hide');
    });
    $( "#sortable" ).sortable();
    $('#save_sort_model_imgs').click(function(){
        $('#sortable').find('li.hide').each(function(index, element){
            $(this).remove();
        });
        var model_images = [];
        $('#sortable').find('li').each(function(index, element){
            model_images.push($(this).attr('dataid'));
        });
        $('#image_names').val(model_images.join(','));
        $('#review_sort_img_modal').modal('hide');
    });
    $('#fine-uploader-manual-trigger').fineUploader({
        template: 'qq-template-manual-trigger',
        request: {
            customHeaders: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            endpoint: '{{route("admin.models.store_image")}}'
        },
        thumbnails: {
            placeholders: {
                waitingPath: '{{asset("assets/fine-uploader/placeholders/waiting-generic.png")}}',
                notAvailablePath: '{{asset("assets/fine-uploader/placeholders/not_available-generic.png")}}'
            }
        },
        autoUpload: false,
        callbacks: {
            onComplete: function(id, name, object, xhr){
                var str = `<li class="model_image_li" dataid="`+object.filename+`"><img src="{{asset('assets/car_images/model_images')}}`+'/'+object.filename+`" width="150px" height="100px" /></li>`;
                $('#sortable').append(str);
                var model_images = $('#image_names').val();
                if(model_images){
                    $('#image_names').val(model_images+','+object.filename);    
                }else{
                    $('#image_names').val(object.filename);    
                }
                
            }
        }
    });
    $('#trigger-upload').click(function() {
        $('#fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');
    });
</script>