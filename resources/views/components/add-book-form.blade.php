<form class="form-horizontal" action="{{url('library/add-new-book')}}" method="post">
  {{ csrf_field() }}
  <div class="form-group{{ $errors->has('book_title') ? ' has-error' : '' }}">
      <label for="book_title" class="col-md-4 control-label">Book Title</label>

      <div class="col-md-6">
          <input id="book_title" type="text" class="form-control" name="book_title" value="{{ old('book_title') }}" placeholder="Book Title" required>

          @if ($errors->has('book_title'))
              <span class="help-block">
                  <strong>{{ $errors->first('book_title') }}</strong>
              </span>
          @endif
      </div>
  </div>
  <div class="form-group{{ $errors->has('book_about') ? ' has-error' : '' }}">
      <label for="book_about" class="col-md-4 control-label">About Book</label>

      <div class="col-md-6">
          <textarea rows="3" id="book_about" type="text" class="form-control" name="book_about" value="{{ old('book_about') }}" placeholder="About Book" required></textarea>

          @if ($errors->has('book_about'))
              <span class="help-block">
                  <strong>{{ $errors->first('book_about') }}</strong>
              </span>
          @endif
      </div>
  </div>
  <div class="form-group{{ $errors->has('book_code') ? ' has-error' : '' }}">
      <label for="book_code" class="col-md-4 control-label">Book Code</label>

      <div class="col-md-6">
          <input id="book_code" type="text" class="form-control" name="book_code" value="{{ old('book_code') }}" placeholder="Book Code" required>

          @if ($errors->has('book_code'))
              <span class="help-block">
                  <strong>{{ $errors->first('book_code') }}</strong>
              </span>
          @endif
      </div>
  </div>
  <div class="form-group{{ $errors->has('book_author') ? ' has-error' : '' }}">
      <label for="book_author" class="col-md-4 control-label">Book Author</label>

      <div class="col-md-6">
          <input id="book_author" type="text" class="form-control" name="book_author" value="{{ old('book_author') }}" placeholder="Book Author" required>

          @if ($errors->has('book_author'))
              <span class="help-block">
                  <strong>{{ $errors->first('book_author') }}</strong>
              </span>
          @endif
      </div>
  </div>
  <div class="form-group{{ $errors->has('book_price') ? ' has-error' : '' }}">
      <label for="book_price" class="col-md-4 control-label">Book Price</label>

      <div class="col-md-6">
          <input id="book_price" type="number" class="form-control" name="book_price" value="{{ old('book_price') }}" placeholder="Book Price" required>

          @if ($errors->has('book_price'))
              <span class="help-block">
                  <strong>{{ $errors->first('book_price') }}</strong>
              </span>
          @endif
      </div>
  </div>
  <div class="form-group{{ $errors->has('book_quantity') ? ' has-error' : '' }}">
      <label for="book_quantity" class="col-md-4 control-label">Book Quantity</label>

      <div class="col-md-6">
          <input id="book_quantity" type="number" class="form-control" name="book_quantity" value="{{ old('book_quantity') }}" placeholder="Book Quantity" required>

          @if ($errors->has('book_quantity'))
              <span class="help-block">
                  <strong>{{ $errors->first('book_quantity') }}</strong>
              </span>
          @endif
      </div>
  </div>
  <div class="form-group{{ $errors->has('book_rackNo') ? ' has-error' : '' }}">
      <label for="book_rackNo" class="col-md-4 control-label">Book Rack Number</label>

      <div class="col-md-6">
          <input id="book_rackNo" type="number" class="form-control" name="book_rackNo" value="{{ old('book_rackNo') }}" placeholder="Book Rack Number" required>

          @if ($errors->has('book_rackNo'))
              <span class="help-block">
                  <strong>{{ $errors->first('book_rackNo') }}</strong>
              </span>
          @endif
      </div>
  </div>
  <div class="form-group{{ $errors->has('book_rowNo') ? ' has-error' : '' }}">
      <label for="book_rowNo" class="col-md-4 control-label">Book Row Number</label>

      <div class="col-md-6">
          <input id="book_rowNo" type="number" class="form-control" name="book_rowNo" value="{{ old('book_rowNo') }}" placeholder="Book Row Number" required>

          @if ($errors->has('book_rowNo'))
              <span class="help-block">
                  <strong>{{ $errors->first('book_rowNo') }}</strong>
              </span>
          @endif
      </div>
  </div>
  <div class="form-group{{ $errors->has('book_type') ? ' has-error' : '' }}">
      <label for="book_type" class="col-md-4 control-label">Book Type</label>

      <div class="col-md-6">
        <select id="book_type" class="form-control" name="book_type">
          <option value="Academic">Academic</option>
          <option value="Magazine">Magazine</option>
          <option value="Story">Story</option>
          <option value="Other">Other</option>
        </select>

        @if ($errors->has('book_type'))
              <span class="help-block">
                  <strong>{{ $errors->first('book_type') }}</strong>
              </span>
        @endif
      </div>
  </div>
  <div class="form-group{{ $errors->has('class_id') ? ' has-error' : '' }}">
      <label for="class_id" class="col-md-4 control-label">For Class</label>

      <div class="col-md-6">
        <select id="class_id" class="form-control" name="class_id">
          @foreach($classes as $class)
          <option value="{{$class->id}}">{{$class->class_number}} {{$class->group}}</option>
          @endforeach
        </select>

        @if ($errors->has('class_id'))
              <span class="help-block">
                  <strong>{{ $errors->first('class_id') }}</strong>
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
