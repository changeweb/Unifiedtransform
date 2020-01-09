<a role="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#promote{{$user->id}}"><i class="material-icons">add</i >@lang('Promote')</a>

<div class="modal fade" id="promote{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="promote{{$user->id}}Label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">@lang('Promote Student Form')</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{url('/school/promote-tct-student')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" value="{{$user->id}}" name="user_id">
                    {{-- <input type="hidden" value="{{$userSer->getInactiveRequest($user)->id}}" name="inactive_id"> --}}
                    <!-- Form & Sections -->
                    <div class="row form-group">
                        <label for="section" class="col-sm-4 control-label">@lang('Select Form')</label>
                        <div class="col-sm-8">
                            <select id="section" class="form-control" name="section">
                                @php
                                    $sections = $userSer->getAdminDetails()['sections'];
                                    $form_nums = $userSer->getAdminDetails()['form_nums'];
                                @endphp
                                @foreach ($sections as $section)
                                    @php 
                                        $user_form_num = $form_nums[$section->id];
                                    @endphp
                                    <option value="{{$section->id}}">
                                        {{$section->class->class_number}}{{$section->section_number}}
                                        (#{{$user_form_num}})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- House -->
                    <div class="row form-group">
                        <label for="house" class="col-sm-4 control-label">@lang('Select House')</label>
                        <div class="col-sm-8">
                            <select id="house" class="form-control" name="house">
                                @php
                                    $houses = $userSer->getAdminDetails()['houses'];
                                @endphp
                                @foreach ($houses as $house)
                                    <option value="{{$house->id}}">{{$house->house_name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                     <!-- Session -->
                     <div class="row form-group">
                        <label for="session" class="col-sm-4 control-label">@lang('Session')</label>
                        <div class="col-sm-8">
                            <input id="session" type="text" class="form-control" name="session" value="{{date("Y")}}" 
                                required>
                        </div>
                    </div>
                    <!-- Status -->
                    <div class="row form-group">
                        <label for="status" class="col-sm-4 control-label">@lang('Select Status')</label>
                        <div class="col-sm-8">
                            <select id="status" class="form-control" name="status">
                                @php
                                    $statuses = ['old', 'prefect', 'Head Prefect'];
                                @endphp
                                @foreach ($statuses as $status)
                                    <option value="{{$status}}"
                                        {{($status == $user->studentInfo->group)?'selected="selected"':''}}
                                        >{{ucfirst($status)}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Notes -->
                    <div class="row form-group">
                        <label for="notes" class="col-sm-4 control-label">@lang('Notes')</label>
                        <div class="col-sm-8">
                            <textarea id="notes" type="text" class="form-control" name="notes">{{$user->studentInfo->reg_notes}}</textarea>
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
