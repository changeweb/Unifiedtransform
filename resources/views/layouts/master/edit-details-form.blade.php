<!-- ACADEMIC DETAILS -->
<a role="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editAdminDetails{{$user->id}}"><i class="material-icons">edit</i> @lang('Edit Admin')</a>

{{-- {{$userSer->getAdminDetails()['sections']}} --}}
<div class="modal fade" id="editAdminDetails{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="#editAdminDetails{{$user->id}}Label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">@lang('Edit Admin Details')</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{url('tct_edit_administration')}}" method="post">
                    {{csrf_field()}}
                    {{-- {{ method_field('PUT') }} --}}
                    <input type="hidden" value="{{$user->id}}" name="user_id">
                    <div class="row form-group">
                        <label for="tct_id" class="col-sm-4 control-label">@lang('TCT ID')</label>
                        <div class="col-sm-8">
                             <input class="form-control" type="text" placeholder="{{$user->student_code}}" readonly>
                        </div>
                    </div>
                    <!-- FORM & SECTION -->
                    <div class="row form-group">
                        <label for="section" class="col-sm-4 control-label">@lang('Select Form')</label>
                        <div class="col-sm-8">
                            <select id="section" class="form-control" name="section" 
                                @if($user->studentInfo->session < date("Y")) 
                                    readonly>
                                    <option>{{$user->section->class->class_number}}{{$user->section->section_number}}
                                        (#{{$user->studentInfo->form_num}})</option>
                                     </select>
                                @else
                                    @php
                                        $sections = $userSer->getAdminDetails()['sections'];
                                        $form_nums = $userSer->getAdminDetails()['form_nums'];
                                    @endphp
                                    @foreach ($sections as $section)
                                        @php 
                                            $user_form_num = ($section->id == $user->section_id)? $user->studentInfo->form_num : $form_nums[$section->id];
                                        @endphp
                                            ><option value="{{$section->id}}" {{($section->id == $user->section_id)?'selected="selected"':''}}>
                                            {{$section->class->class_number}}{{$section->section_number}}
                                            (#{{$user_form_num}})
                                           
                                        </option>
                                    @endforeach
                                    </select>
                                @endif
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
                                    <option value="{{$house->id}}"
                                        {{($house->id == $user->studentInfo->house_id)?'selected="selected"':''}}
                                        >{{$house->house_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Status -->
                    <div class="row form-group">
                        <label for="status" class="col-sm-4 control-label">@lang('Select Status')</label>
                        <div class="col-sm-8">
                            <select id="status" class="form-control" name="status">
                                @php
                                    $statuses = ['old', 'new', 'prefect', 'Head Prefect'];
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
                    <!-- Session -->
                    <div class="row form-group">
                        <label for="session" class="col-sm-4 control-label">@lang('Select Status')</label>
                        <div class="col-sm-8">
                            <input id="session" type="text" class="form-control" name="session" value="{{$user->studentInfo->session}}" readonly
                                required>
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
<!-- OTHER DETAILS -->
<a role="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editOtherDetails{{$user->id}}"><i class="material-icons">edit</i> @lang('Edit Other')</a>
<div class="modal fade" id="editOtherDetails{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="#editOtherDetails{{$user->id}}Label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">@lang('Edit Other Details')</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{url('tct_edit_other')}}" method="post">
                    {{csrf_field()}}
                    {{-- {{ method_field('PUT') }} --}}
                    <input type="hidden" value="{{$user->id}}" name="user_id">
                    <!--Last Name-->
                    <div class="row form-group">
                        <label for="lst_name" class="col-sm-4 control-label">@lang('Last Name')</label>
                        <div class="col-sm-8">
                             <input class="form-control" name="lst_name" type="text" value="{{$user->lst_name}}">
                        </div>
                    </div>
                    <!--Given Names-->
                    <div class="row form-group">
                        <label for="given_name" class="col-sm-4 control-label">@lang('Given Names')</label>
                        <div class="col-sm-8">
                             <input class="form-control" name="given_name" type="text" value="{{$user->given_name}}">
                        </div>
                    </div>
                     <!--Date of Birth-->
                    <div class="row form-group">
                        <label for="birthday" class="col-sm-4 control-label">@lang('Date of Birth')</label>
                        <div class="col-sm-8">
                            <input id="birthday" type="text" class="form-control" name="birthday" value="{{Carbon\Carbon::parse($user->studentInfo->birthday)->format('Y-m-d')}}"
                                required>
                        </div>
                    </div>
                    <!--Category-->
                    <div class="row form-group">
                        <label for="category" class="col-sm-4 control-label">@lang('Category')</label>
                        <div class="col-sm-8">
                            <select id="category" class="form-control" name="category">
                                @php
                                    $categories = ['1','2','3'];
                                @endphp
                                @foreach ($categories as $category)
                                    <option value="{{$category}}"
                                        {{($category == $user->studentInfo->category_id)?'selected="selected"':''}}
                                        >{{$category}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--Church-->
                    <div class="row form-group">
                        <label for="church" class="col-sm-4 control-label">@lang('Church')</label>
                        <div class="col-sm-8">
                            <select id="church" class="form-control" name="church">
                                @php
                                    $churches = ['FWC','Mormon','Tonga Tauataina','Tonga Konistitutone',"Tonga Hou'eiki","Anglican","Catholic",
                                    "Tokaikolo","Penitekosi","Salvation Army","Other"];
                                @endphp
                                @foreach ($churches as $church)
                                    <option value="{{$church}}"
                                        {{($church == $user->studentInfo->church)?'selected="selected"':''}}
                                        >{{$church}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                      <!--Village-->
                    <div class="row form-group">
                        <label for="village" class="col-sm-4 control-label">@lang('Village')</label>
                        <div class="col-sm-8">
                            <input id="village" type="text" class="form-control" name="village" value="{{$user->village}}">
                        </div>
                    </div>
                     <!--Nationality-->
                     <div class="row form-group">
                        <label for="nationality" class="col-sm-4 control-label">@lang('nationality')</label>
                        <div class="col-sm-8">
                            <select id="nationality" class="form-control" name="nationality">
                                @php
                                    $nationalities = ["Tonga","New Zealand","Australia", "USA", "Fiji", "Samoa", "United Kingdom", "Japanese", "Other"];
                                @endphp
                                @foreach ($nationalities as $nationality)
                                    <option value="{{$nationality}}"
                                        {{($nationality == $user->nationality)?'selected="selected"':''}}
                                        >{{$nationality}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                     <!--Health Condition-->
                     <div class="row form-group">
                        <label for="health_conditions" class="col-sm-4 control-label">@lang('Health Conditions')</label>
                        <div class="col-sm-8">
                            <input id="health_conditions" type="text" class="form-control" name="health_conditions" value="{{$user->health_conditions}}">
                        </div>
                    </div>
                     <!--Blood Group-->
                     <div class="row form-group">
                        <label for="blood_group" class="col-sm-4 control-label">@lang('Blood Group')</label>
                        <div class="col-sm-8">
                            <select id="blood_group" class="form-control" name="blood_group">
                                @php
                                    $blood_types = ["N/A", "A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-"];
                                @endphp
                                @foreach ($blood_types as $blood)
                                    <option value="{{$blood}}"
                                        {{($blood == $user->blood)?'selected="selected"':''}}
                                        >{{$blood}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                     <!--Father Details-->
                     <div class="row form-group">
                        <label for="father_name" class="col-sm-4 control-label">@lang('Father\'s Name')</label>
                        <div class="col-sm-8">
                            <input id="father_name" type="text" class="form-control" name="father_name" value="{{$user->studentInfo->father_name}}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="father_occupation" class="col-sm-4 control-label">@lang('Father\'s Occupation')</label>
                        <div class="col-sm-8">
                            <input id="father_occupation" type="text" class="form-control" name="father_occupation" value="{{$user->studentInfo->father_occupation}}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="father_phone_number" class="col-sm-4 control-label">@lang('Father\'s Occupation')</label>
                        <div class="col-sm-8">
                            <input id="father_phone_number" type="text" class="form-control" name="father_phone_number" value="{{$user->studentInfo->father_phone_number}}">
                        </div>
                    </div>
                     <!--Mother Details-->
                     <div class="row form-group">
                        <label for="mother_name" class="col-sm-4 control-label">@lang('Mother\'s Name')</label>
                        <div class="col-sm-8">
                            <input id="mother_name" type="text" class="form-control" name="mother_name" value="{{$user->studentInfo->mother_name}}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="mother_occupation" class="col-sm-4 control-label">@lang('Mother\'s Occupation')</label>
                        <div class="col-sm-8">
                            <input id="mother_occupation" type="text" class="form-control" name="mother_occupation" value="{{$user->studentInfo->mother_occupation}}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="mother_phone_number" class="col-sm-4 control-label">@lang('Mother\'s Occupation')</label>
                        <div class="col-sm-8">
                            <input id="mother_phone_number" type="text" class="form-control" name="mother_phone_number" value="{{$user->studentInfo->mother_phone_number}}">
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

<br>
<br>
@if($user->active == 0)
<!-- INACTIVE DETAILS -->
<a role="button" class="" data-toggle="modal" data-target="#editInactiveDetails{{$user->id}}"><i class="material-icons">edit</i> @lang('Edit Inactive Details')</a>
<div class="modal fade" id="editInactiveDetails{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="#editInactiveDetails{{$user->id}}Label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">@lang('Edit Inactive Details')</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{url('tct_edit_inactive')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" value="{{$user->id}}" name="user_id">
                    <input type="hidden" value="{{$userSer->getInactiveRequest($user)->id}}" name="inactive_id">

                    <div class="row form-group">
                        <label for="type" class="col-sm-4 control-label">@lang('Type')</label>
                        <div class="col-sm-8">
                            <select id="type" class="form-control" name="type">
                                @php
                                    $types = ['removed', 'withdrawn', 'suspended', 'expelled', 'leave'];
                                @endphp
                                @foreach ($types as $type)
                                    <option value="{{$type}}"
                                        {{($type == $userSer->getInactiveRequest($user)->type)?'selected="selected"':''}}
                                        >{{ucfirst($type)}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="inactive_date" class="col-sm-4 control-label">@lang('Inactive')</label>
                        <div class="col-sm-8">
                            <input id="inactive_date" type="text" class="form-control" name="inactive_date" value="{{Carbon\Carbon::parse($userSer->getInactiveRequest($user)->created_at)->format('d/m/Y')}}"  required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="notes" class="col-sm-4 control-label">@lang('Notes')</label>
                        <div class="col-sm-8">
                            <textarea id="notes" type="text" class="form-control" name="notes">{{$userSer->getInactiveRequest($user)->notes}}</textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="session" class="col-sm-4 control-label">@lang('Session')</label>
                        <div class="col-sm-8">
                            <input id="session" type="text" class="form-control" name="session" value="{{$user->studentInfo->session}}" placeholder="dd/mm/yyyy"
                                required>
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

@endif
