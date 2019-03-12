<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet">
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css">

<!-- JS -->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>
<form class="form-horizontal" action="{{url('library/issue-books')}}" method="post">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('student_code') ? ' has-error' : '' }}">
        <label for="student_code" class="col-md-4 control-label">Student Code</label>

        <div class="col-md-6">
            <input id="student_code" type="text" class="form-control" name="student_code" value="{{ old('student_code') }}"
                placeholder="Student Code" required>

            @if ($errors->has('student_code'))
            <span class="help-block">
                <strong>{{ $errors->first('student_code') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('book_code') ? ' has-error' : '' }}">
        <label for="book_code" class="col-md-4 control-label">Book Title &amp; Code (<small>Type & Search by Name/Code.
                You can Select Multiple Books (<i>Maximum 10 books</i>)</small>)</label>

        <div class="col-md-6">
            <select id="book_code" class="form-control" multiple name="book_code[]">
                @foreach($books as $book)
                <option value="{{$book->book_code}}">{{$book->title}} - {{$book->book_code}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group{{ $errors->has('issue_date') ? ' has-error' : '' }}">
        <label for="issue_date" class="col-md-4 control-label">Issue Date</label>

        <div class="col-md-6">
            <input id="issue_date" class="form-control datepicker" name="issue_date" value="{{ old('issue_date') }}"
                placeholder="Issue Date" required>

            @if ($errors->has('issue_date'))
            <span class="help-block">
                <strong>{{ $errors->first('issue_date') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('return_date') ? ' has-error' : '' }}">
        <label for="return_date" class="col-md-4 control-label">Return Date</label>

        <div class="col-md-6">
            <input id="return_date" class="form-control datepicker" name="return_date" value="{{ old('return_date') }}"
                placeholder="Return Date" required>

            @if ($errors->has('return_date'))
            <span class="help-block">
                <strong>{{ $errors->first('return_date') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
            <button type="submit" class="btn btn-danger">Save</button>
        </div>
    </div>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
    $(function () {
        $('#book_code').chosen({
            max_selected_options: 10,
            display_selected_options: true,
        });
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    })
</script>