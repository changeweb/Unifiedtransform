<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <title>{{$user->name}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
      table{
        font-size: 12px;
      }
      h2{
        font-size: 20px;
      }
      h3{
        font-size: 15px;
      }
    </style>
  </head>
  <body>
    <div class="row">
      <div class="col-md-12">
        <div class="col-xs-8">
          <h2>{{$user->section->class->school->name}}</h2>
          <div style="font-size: 10px;">{{$user->section->class->school->about}}</div>
        </div>
        <div class="col-xs-4">
          <h3>Student Profile</h3>
          <div style="font-size: 10px;">Printing Date: {{Carbon\Carbon::now()->format('d/m/Y')}}</div>
        </div>
      </div>
    </div>
    <br/>
    <div class="row">
      <div class="col-md-12">
        <p class="bg-primary" style="text-align:center;">
          Academic Information
        </p>
        <div class="col-xs-9">
          <table class="table table-condensed">
            <tr>
              <td>Student ID:</td>
              <td>{{$user->student_code}}</td>
              <td>Student's Name:</td>
              <td>{{$user->name}}</td>
            </tr>
            <tr>
              <td>Class:</td>
              <td>{{$user->section->class->class_number}}</td>
              <td>Section:</td>
              <td>{{$user->section->section_number}}</td>
            </tr>
            <tr>
              <td>Session:</td>
              <td>{{$user->session}}</td>
              <td>Version:</td>
              <td>{{$user->version}}</td>
            </tr>
            <tr>
              <td>Group:</td>
              <td>{{$user->group}}</td>
              <td colspan="2"></td>
            </tr>
          </table>
        </div>
        <div class="col-xs-3">
          <img src="https://avatars.io/platform/{{$user->student_code}}" width="120px" height="120px">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <p class="bg-primary" style="text-align:center;">
          Personal details
        </p>
        <div class="col-xs-12">
          <table class="table table-condensed">
            <tr>
              <td>Email:</td>
              <td>{{$user->email}}</td>
              <td>Contact Number</td>
              <td>{{$user->phone_number}}</td>
            </tr>
            <tr>
              <td>Gender:</td>
              <td>{{$user->gender}}</td>
              <td>Blood Group:</td>
              <td>{{$user->blood_group}}</td>
            </tr>
            <tr>
              <td>Nationality:</td>
              <td>{{$user->nationality}}</td>
              <td>Birthday:</td>
              <td>{{Carbon\Carbon::parse($user->birthday)->format('d/m/Y')}}</td>
            </tr>
            <tr>
              <td>Religion:</td>
              <td>{{$user->religion}}</td>
              <td>Father Name:</td>
              <td>{{$user->father_name}}</td>
            </tr>
            <tr>
              <td>Mother Name:</td>
              <td>{{$user->mother_name}}</td>
              <td>Address:</td>
              <td>{{$user->address}}</td>
            </tr>
            <tr>
              <td>Phone Number:</td>
              <td>{{$user->phone_number}}</td>
              <td>Father's Phone Number:</td>
              <td>{{$user->father_phone_number}}</td>
            </tr>
            <tr>
              <td>Father's National ID:</td>
              <td>{{$user->father_national_id}}</td>
              <td>Father's Occupation:</td>
              <td>{{$user->father_occupation}}</td>
            </tr>
            <tr>
              <td>Father's Designation:</td>
              <td>{{$user->father_designation}}</td>
              <td>Father's Annual Income:</td>
              <td>{{$user->father_annual_income}}</td>
            </tr>
            <tr>
              <td>Mother's Phone Number:</td>
              <td>{{$user->mother_phone_number}}</td>
              <td>Mother's National ID:</td>
              <td>{{$user->mother_national_id}}</td>
            </tr>
            <tr>
              <td>Mother's Occupation:</td>
              <td>{{$user->mother_occupation}}</td>
              <td>Mother's Designation:</td>
              <td>{{$user->mother_designation}}</td>
            </tr>
            <tr>
              <td>Mother's Annual Income:</td>
              <td>{{$user->mother_annual_income}}</td>
              <td>About:</td>
              <td>{{$user->about}}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
