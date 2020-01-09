@extends('layouts.app')

@section('title', __('Register'))

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet">
<div class="container{{ (\Auth::user()->role == 'master')? '' : '-fluid' }}">
    <div class="row">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(\Auth::user()->role != 'master')
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        @else
        <div class="col-md-3" id="side-navbar">
            <ul class="nav flex-column">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('schools.index') }}"><i class="material-icons">gamepad</i> <span class="nav-link-text">@lang('Back to Manage School')</span></a>
                </li>
            </ul>
        </div>
        @endif
        <div class="col-md-8" id="main-container">
            <!-- STATUS SECTION -->
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                    {{-- Display View admin links --}}
                    @if (session('register_school_id'))
                        <a href="{{ url('school/admin-list/' . session('register_school_id')) }}" target="_blank" class="text-white pull-right">@lang('View Admins')</a>
                    @endif
                </div>
            @endif
            <div class="panel panel-default">
                <div class="page-panel-title">@lang('Register') {{ucfirst(session('register_role'))}} </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" id="registerForm" action="{{ url('register/'.session('register_role_action')) }}">
                        {{ csrf_field() }}
                        <!-- LAST NAME -->
                        <div class="form-group{{ $errors->has('lst_name') ? ' has-err  or' : '' }}">
                            <label for="lst_name" class="col-md-4 control-label">* @lang('Last Name')</label>
                            <div class="col-md-6">
                                <input id="lst_name" type="text" class="form-control" name="lst_name" value="{{ old('lst_name') }}" placeholder="e.g. Lolohea"
                                    required>
                                @if ($errors->has('lst_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lst_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- GIVEN NAME -->
                        <div class="form-group{{ $errors->has('given_name') ? ' has-error' : '' }}">
                            <label for="given_name" class="col-md-4 control-label">* @lang('Given Names')</label>
                            <div class="col-md-6">
                                <input id="given_name" type="text" class="form-control" name="given_name" value="{{ old('given_name') }}" placeholder="e.g. Nikolasi 'Ofeina"
                                    required>
                                @if ($errors->has('given_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('given_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- EMAIL (teacher) -->
                        @if(session('register_role', 'teacher') == 'teacher')
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">* @lang('E-Mail Address')</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <!-- CATEGORY -->
                        @if(session('register_role', 'student') == 'student')
                            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                <label for="category" class="col-md-4 control-label">* @lang('Category')</label>
                                <div class="col-md-6">
                                    <select id="category" class="form-control" name="category">
                                        <option selected="selected">1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                    @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <!-- DATE OF BIRTH -->
                        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                            <label for="birthday" class="col-md-4 control-label">* @lang('Date of Birth')</label>
                            <div class="col-md-6">
                                <input id="birthday" type="text" class="form-control" name="birthday" value="{{ old('birthday') }}" placeholder="dd/mm/yyyy"
                                    required>
                                @if ($errors->has('birthday'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @if(session('register_role', 'teacher') == 'teacher')   
                            <hr>
                            <!-- PASSWORD (teacher) -->
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">* @lang('Password')</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">* @lang('Confirm Password')</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                        required>
                                </div>
                            </div>
                            <hr>
                            <!-- GENDER (teacher) default Male for TCT students -->
                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label for="gender" class="col-md-4 control-label">* @lang('Gender')</label>
                                <div class="col-md-6">
                                    <select id="gender" class="form-control" name="gender">
                                        <option selected="selected">@lang('Male')</option>
                                        <option>@lang('Female')</option>
                                    </select>
                                    @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <!-- Phone number (teacher) -->
                            <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                <label for="phone_number" class="col-md-4 control-label">* @lang('Phone Number')</label>
                                <div class="col-md-6">
                                    <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}">
                                    @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <!-- NATIONALITY --> 
                        <div class="form-group{{ $errors->has('nationality') ? ' has-error' : '' }}">
                            <label for="nationality" class="col-md-4 control-label">* @lang('Nationality')</label>
                            <div class="col-md-6">
                                <select id="nationality" class="form-control" name="nationality">
                                    <option selected="selected">Tonga</option>
                                    <option>New Zealand</option>
                                    <option>Australia</option>
                                    <option>USA</option>
                                    <option>Fiji</option>
                                    <option>Samoa</option>
                                    <option>United Kingdom</option>
                                    <option>Japanese</option>
                                    <option>Other</option>
                                </select>
                                @if ($errors->has('nationality'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nationality') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- CHURCH -->
                        <div class="form-group{{ $errors->has('church') ? ' has-error' : '' }}">
                            <label for="church" class="col-md-4 control-label">* @lang('Church')</label>
                            <div class="col-md-6">
                                <select id="church" class="form-control" name="church">
                                    <!-- TO BE POPULATED FROM QUERY -->
                                    <option selected="selected">FWC</option>
                                    <option>Mormon</option>
                                    <option>Tonga Tauataina</option>
                                    <option>Tonga Konisitutone</option>
                                    <option>Tonga Hou'eiki</option>
                                    <option>Anglican</option>
                                    <option>Catholic</option>
                                    <option>Tokaikolo</option>
                                    <option>Penitekosi</option>
                                    <option>Salvation Army</option>
                                    <option>Other</option>
                                </select>
                                @if ($errors->has('church'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('church') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- VILLAGE -->
                        <div class="form-group{{ $errors->has('village') ? ' has-error' : '' }}">
                            <label for="village" class="col-md-4 control-label">* @lang('Village')</label>
                            <div class="col-md-6">
                                <input id="village" type="text" class="form-control" name="village" value="{{ old('village') }}" placeholder="e.g. Ma'ufanga"
                                    required>
                                @if ($errors->has('village'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('village') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- NOTES -->
                        <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
                            <label for="notes" class="col-md-4 control-label">@lang('Notes')</label>
                            <div class="col-md-6">
                                <textarea id="notes" class="form-control" name="notes">{{ old('notes') }}</textarea>
                                @if ($errors->has('notes'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('notes') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <hr>
                        @if(session('register_role', 'student') == 'student')
                        <div class="page-panel-title">Enrollment</div>
                            <!-- Session -->
                            <div class="form-group{{ $errors->has('session') ? ' has-error' : '' }}">
                                <label for="session" class="col-md-4 control-label">* @lang('Session')</label>
                                <div class="col-md-6">
                                    <input id="session" type="text" class="form-control" name="session" value="{{date('Y')}}"
                                        required>
                                    @if ($errors->has('session'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('session') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                           <div class="form-group">
                                <label for="tct_id"  class="col-md-4 control-label">@lang('TCT ID')</label>
                                <div class="col-md-6">
                                    <input id="tct_id" type="text" class="form-control" name="tct_id" value="{{session('tct_id')}}" required>
                                </div>
                           </div>   

                            <!-- FOMRS & CLASSES -->                 
                            <div class="form-group{{ $errors->has('section') ? ' has-error' : '' }}">
                                <label for="section" class="col-md-4 control-label">* @lang('Class and Section')</label>
                                <div class="col-md-6">
                                    <select id="section" class="form-control" name="section" required>

                                        @foreach( session('register_forms') as $class)  
                                            @foreach ($class->active_sections as $section)
                                                <option value="{{$section->id}}">{{$class->class_number}}{{ucfirst($section->section_number)}} 
                                                    (#{{session('register_numbers')[$section->id]}})
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @if ($errors->has('section'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('section') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- HOUSES -->
                            <div class="form-group{{ $errors->has('house') ? ' has-error' : '' }}">
                                <label for="house" class="col-md-4 control-label">@lang('House')</label>
                                <div class="col-md-6">
                                    <select id="house" class="form-control" name="house">
                                        @foreach (session('register_house') as $house)
                                            <option value="{{$house->id}}">{{$house->house_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('house'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('house') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <!-- PREVIOUS FORM -->
                            <div class="form-group{{ $errors->has('previous_form') ? ' has-error' : '' }}">
                                <label for="previous_form" class="col-md-4 control-label">@lang('Previous Form')</label>
                                <div class="col-md-6">
                                    <input id="previous_form" type="text" class="form-control" name="previous_form" value="{{ old('previous_form') }}" >
                                    @if ($errors->has('previous_form'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('previous_form') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <!-- PREVIOUS SCHOOL -->
                            <div class="form-group{{ $errors->has('previous_school') ? ' has-error' : '' }}">
                                <label for="previous_school" class="col-md-4 control-label">@lang('Previous School')</label>
                                <div class="col-md-6">
                                    <input id="previous_school" type="text" class="form-control" name="previous_school" value="{{ old('previous_school') }}" >
                                    @if ($errors->has('previous_school'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('previous_school') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>         
                            <!-- GROUPS -->
                            {{-- <div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}">
                                <label for="group" class="col-md-4 control-label">@lang('Group (Optional)')</label>
                                <div class="col-md-6">
                                    <input id="group" type="text" class="form-control" name="group" value="{{ old('group') }}"
                                        placeholder="@lang('Academy, Sports, etc.')">
                                    @if ($errors->has('group'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('group') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>                 --}}
                        <hr>
                        @endif
                        @if(session('register_role', 'teacher') == 'teacher')
                        <!-- DEPARTMENT (teacher) -->
                            <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                                <label for="department" class="col-md-4 control-label">* @lang('Department')</label>
                                <div class="col-md-6">
                                    <select id="department" class="form-control" name="department_id" required>
                                        @if (count(session('departments')) > 0)
                                            @foreach (session('departments') as $d)
                                                <option value="{{$d->id}}">{{$d->department_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('department'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <!-- Class Teacher -->
                            <div class="form-group{{ $errors->has('class_teacher') ? ' has-error' : '' }}">
                                <label for="class_teacher" class="col-md-4 control-label">@lang('Class Teacher')</label>
                                <div class="col-md-6">
                                    <select id="class_teacher" class="form-control" name="class_teacher_section_id">
                                        <option selected="selected" value="0">@lang('Not Class Teacher')</option>
                                        @foreach (session('register_sections') as $section)
                                        <option value="{{$section->id}}">@lang('Section'): {{$section->section_number}} @lang('Class'):
                                            {{$section->class->class_number}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('class_teacher'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('class_teacher') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <hr>
                        <div class="page-panel-title">Health and Emergency Details</div>
                        <!-- BLOOD GROUP -->
                        <div class="form-group{{ $errors->has('blood_group') ? ' has-error' : '' }}">
                            <label for="blood_group" class="col-md-4 control-label">@lang('Blood Group')</label>
                            <div class="col-md-6">
                                <select id="blood_group" class="form-control" name="blood_group">
                                    <option selected="selected">N/A</option>
                                    <option>A+</option>
                                    <option>A-</option>
                                    <option>B+</option>
                                    <option>B-</option>
                                    <option>AB+</option>
                                    <option>AB-</option>
                                    <option>O+</option>
                                    <option>O-</option>
                                </select>
                                @if ($errors->has('blood_group'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('blood_group') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- HEALTH CONDITION -->
                        <div class="form-group{{ $errors->has('health_condition') ? ' has-error' : '' }}">
                            <label for="health_condition" class="col-md-4 control-label">@lang('Health Condition(s)')</label>
                            <div class="col-md-6">
                                <input id="health_condition" type="text" class="form-control" name="health_condition" value="{{ old('health_condition') }}">
                                @if ($errors->has('health_condition'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('health_condition') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @if(session('register_role', 'student') == 'student')                           
                            <!-- GUARDIAN DETAILS -->
                            <div class="form-group{{ $errors->has('father_name') ? ' has-error' : '' }}">
                                <label for="father_name" class="col-md-4 control-label">@lang('Father\'s (Guardian\'s) Name')</label>
                                <div class="col-md-6">
                                    <input id="father_name" type="text" class="form-control" name="father_name" value="{{ old('father_name') }}">
                                    @if ($errors->has('father_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('father_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('father_phone_number') ? ' has-error' : '' }}">
                                <label for="father_phone_number" class="col-md-4 control-label">@lang('Phone Number')</label>
                                <div class="col-md-6">
                                    <input id="father_phone_number" type="text" class="form-control" name="father_phone_number"
                                        value="{{ old('father_phone_number') }}">
                                    @if ($errors->has('father_phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('father_phone_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <!-- Guardian Occupation -->
                            <div class="form-group{{ $errors->has('father_occupation') ? ' has-error' : '' }}">
                                <label for="father_occupation" class="col-md-4 control-label">@lang('Father\'s (Guardian\'s) Occupation')</label>

                                <div class="col-md-6">
                                    <input id="father_occupation" type="text" class="form-control" name="father_occupation"
                                        value="{{ old('father_occupation') }}">

                                    @if ($errors->has('father_occupation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('father_occupation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <!-- Mother name -->
                            <div class="form-group{{ $errors->has('mother_name') ? ' has-error' : '' }}">
                                <label for="mother_name" class="col-md-4 control-label">@lang('Mother\'s Name')</label>
                                <div class="col-md-6">
                                    <input id="mother_name" type="text" class="form-control" name="mother_name" value="{{ old('mother_name') }}">
                                    @if ($errors->has('mother_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mother_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('mother_phone_number') ? ' has-error' : '' }}">
                                <label for="mother_phone_number" class="col-md-4 control-label">@lang('Phone Number')</label>
                                <div class="col-md-6">
                                    <input id="mother_phone_number" type="text" class="form-control" name="mother_phone_number"
                                        value="{{ old('mother_phone_number') }}">
                                    @if ($errors->has('mother_phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mother_phone_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('mother_occupation') ? ' has-error' : '' }}">
                                <label for="mother_occupation" class="col-md-4 control-label">@lang('Mother\'s Occupation')</label>
                                <div class="col-md-6">
                                    <input id="mother_occupation" type="text" class="form-control" name="mother_occupation"
                                        value="{{ old('mother_occupation') }}">
                                    @if ($errors->has('mother_occupation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mother_occupation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        @endif
                        <hr>
                        <div class="form-group">
                            <label class="col-md-4 control-label">@lang('Upload Profile Picture')</label>
                            <div class="col-md-6">
                                <input type="hidden" id="picPath" name="pic_path">
                                @component('components.file-uploader',['upload_type'=>'profile'])
                                @endcomponent
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" id="registerBtn" class="btn btn-primary">
                                    @lang('Register')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
    $(function () {
        $('#birthday').datepicker({
            format: "yyyy-mm-dd",
        });
        $('#session').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
    });
    $('#registerBtn').click(function () {
        $("#registerForm").submit();
    });
</script>
@endsection
