@extends('layouts.app')

@section('title', 'All Fees')

@section('content')
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">All Fees
                  <button class="btn btn-xs btn-success pull-right" role="button" id="btnPrint" ><i class="material-icons">print</i> Print Fees Form</button>
              </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @component('components.fees-list',['fees'=>$fees])
                    @endcomponent
                </div>
            </div>
        </div>
<script>
$("#btnPrint").on("click", function () {
    var feesTable = document.createElement('table');
    feesTable.setAttribute('class', 'table');
    feesTable.style.width = "100%";
    feesTable.style['border-collapse'] = "collapse";
    var htr = feesTable.insertRow();
    for(var j = 0; j < 3; j++){
      var htd = htr.insertCell();
      if(j == 0)
        cellText = 'Sl.';
      else if(j == 1)
        cellText = "Field Name";
      else {
        cellText = 'Amount (taka)';
      }
      htd.appendChild(document.createTextNode(cellText));
    }
    $('input:checked').each(function(index, val) {
        var tr = feesTable.insertRow();
        for(var j = 0; j < 3; j++){
            var td = tr.insertCell();
            var cellText;
            if(j == 0)
              cellText = index + 1;
            else if(j == 1)
              cellText = this.value;
            else {
              cellText = '';
            }
            td.appendChild(document.createTextNode(cellText));
            td.style.border = '1px solid black';
            if(j == 0)
              td.style.width = '4%';
            else
              td.style.width = '48%';
        }
    });
    var schoolTable = feesTable.cloneNode(true);
    var printWindow = window.open('', '', 'height=720,width=1280');
    printWindow.document.write('<html><head><title>Fees Form</title>');
    printWindow.document.write('<link href="{{url('css/app.css')}}" rel="stylesheet">');
    printWindow.document.write('</head><body>');
    printWindow.document.write('<div class="container" style="height:100vh;"><div class="col-md-6" id="academic-part"  style="border-right: dotted 1px black;height:100vh;"><h2 style="text-align:center;">{{Auth::user()->school->name}}</h2><h4 style="text-align:center;">Fees Form</h4><h5>Academic Part</h5><div style="display:flex;"><div><h5>Student Name: </h5></div><div style="width:250px; border-bottom: 1px solid black;"></div><div><h5>Session:</h5></div><div style="width:100px; border-bottom: 1px solid black;"></div></div><div style="display:flex;"><div><h5>Class: </h5></div><div style="width:100px; border-bottom: 1px solid black;"></div><div><h5>Section: </h5></div><div style="width:100px; border-bottom: 1px solid black;"></div><div><h5>Roll No.:</h5></div><div style="width:100px; border-bottom: 1px solid black;"></div></div></div><div class="col-md-6" id="school-part" style="height:100vh;"><h2 style="text-align:center;">{{Auth::user()->school->name}}</h2><h4 style="text-align:center;">Fees Form</h4><h5>School Part</h5><div style="display:flex;"><div><h5>Student Name: </h5></div><div style="width:250px; border-bottom: 1px solid black;"></div><div><h5>Session:</h5></div><div style="width:100px; border-bottom: 1px solid black;"></div></div><div style="display:flex;"><div><h5>Class: </h5></div><div style="width:100px; border-bottom: 1px solid black;"></div><div><h5>Section: </h5></div><div style="width:100px; border-bottom: 1px solid black;"></div><div><h5>Roll No.:</h5></div><div style="width:100px; border-bottom: 1px solid black;"></div></div></div></div>');
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    var academicPart = printWindow.document.getElementById("academic-part");
    academicPart.appendChild(feesTable);
    var schoolPart = printWindow.document.getElementById("school-part");
    schoolPart.appendChild(schoolTable);
    printWindow.print();
  });
</script>
@endsection
