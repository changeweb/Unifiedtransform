<a role="button" class="btn btn-danger btn-xs" href="" data-toggle="modal" data-target="#editSectionModal{{$section->id}}"><i class="material-icons">edit</i> @lang('Edit Section')</a>
<!-- MODAL -->
<div class="modal fade" id="editSectionModal{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="editSectionModal{{$section->id}}Label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">@lang('Edit Form and Section')</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{url('school/edit-tct-section/'.$section->id)}}" method="post">
                    {{csrf_field()}}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="class{{$section->class_id}}" class="col-sm-4 control-label">@lang('Class Number/Name')</label>
                        <div class="col-sm-8">
                            {{-- <input type="text" name="class_number" class="form-control" id="class{{$section->class_id}}" placeholder="@lang('Class Number/Name')" value="{{$section->class->class_number}}" required> --}}
                            <select id="class_number" class="form-control" name="class_number" required>
                                @foreach ($classes as $form)
                                    <option value="{{$form->id}}" {{($form->id == $section->class_id)? 'selected="selected"' : ''}}>{{$form->class_number}}</option>                                                                            
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="section{{$section->id}}" class="col-sm-4 control-label">@lang('Section')</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="section_number" id="section{{$section->id}}" value="{{$section->section_number}}">
                            {{-- <span id="helpBlock" class="help-block">@lang('Leave Empty if this Class belongs to no Group')</span> --}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room{{$section->id}}" class="col-sm-4 control-label">@lang('Room Number')</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="room_number" id="room{{$section->id}}"  value="{{$section->room_number}}">
                            {{-- <span id="helpBlock" class="help-block">@lang('Leave Empty if this Class belongs to no Group')</span> --}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="active{{$section->id}}" class="col-sm-4 control-label">@lang('Set as Active')</label>
                        <div class="col-sm-8">
                            <select id="section_active" class="form-control" name="section_active">
                                <option value="1" {{($section->active == 1)? 'selected="selected"' : ''}}>Active</option>
                                <option value="0" {{($section->active == 0)? 'selected="selected"' : ''}}>Inactive</option>
                            </select>
                            <span id="helpBlock" class="help-block">@lang('Please move students first before deactivating section')</span>
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger btn-sm">@lang('Submit')</button>
            </div> 
        </form>
        </div>  
    </div>
</div>
