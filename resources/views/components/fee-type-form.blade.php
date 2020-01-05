
{{$buttonType}} {{$buttonTitle}}</button>
<!-- Modal -->
<div class="modal fade" id={{$modal_name}} tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">{{$title}}</h4>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" action="{{$url}}" method="post">
          {{csrf_field()}}
          {{$put_method}}
            {{$form_content}}
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger btn-sm">@lang('Submit')</button>
      </div>
    </form>
    </div>
  </div>
</div>
