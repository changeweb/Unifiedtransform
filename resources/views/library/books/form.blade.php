<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label for="title" class="col-md-4 control-label">@lang('Book Title')</label>

    <div class="col-md-6">
        <input id="title" type="text" class="form-control" name="title" value="{{ $book->title Or old('title') }}" placeholder="@lang('Book Title')" required>

        @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
    <label for="about" class="col-md-4 control-label">@lang('About Book')</label>

    <div class="col-md-6">
        <textarea rows="3" id="about" type="text" class="form-control" name="about" placeholder="@lang('About Book')" required>{{ $book->about Or old('about') }}</textarea>

        @if ($errors->has('about'))
            <span class="help-block">
                <strong>{{ $errors->first('about') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('book_code') ? ' has-error' : '' }}">
    <label for="book_code" class="col-md-4 control-label">@lang('Book Code')</label>

    <div class="col-md-6">
        <input id="book_code" type="text" class="form-control" name="book_code" value="{{ $book->book_code Or old('book_code') }}" placeholder="@lang('Book Code')" required>

        @if ($errors->has('book_code'))
            <span class="help-block">
                <strong>{{ $errors->first('book_code') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">
    <label for="author" class="col-md-4 control-label">@lang('Book Author')</label>

    <div class="col-md-6">
        <input id="author" type="text" class="form-control" name="author" value="{{ $book->author Or old('author') }}" placeholder="@lang('Book Author')" required>

        @if ($errors->has('author'))
            <span class="help-block">
                <strong>{{ $errors->first('author') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
    <label for="price" class="col-md-4 control-label">@lang('Book Price')</label>

    <div class="col-md-6">
        <input id="price" type="number" class="form-control" name="price" value="{{ $book->price Or old('price') }}" placeholder="@lang('Book Price')" required>

        @if ($errors->has('price'))
            <span class="help-block">
                <strong>{{ $errors->first('price') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
    <label for="quantity" class="col-md-4 control-label">@lang('Book Quantity')</label>

    <div class="col-md-6">
        <input id="quantity" type="number" class="form-control" name="quantity" value="{{ $book->quantity Or old('quantity') }}" placeholder="@lang('Book Quantity')" required>

        @if ($errors->has('quantity'))
            <span class="help-block">
                <strong>{{ $errors->first('quantity') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('rackNo') ? ' has-error' : '' }}">
    <label for="rackNo" class="col-md-4 control-label">@lang('Book Rack Number')</label>

    <div class="col-md-6">
        <input id="rackNo" type="number" class="form-control" name="rackNo" value="{{ $book->rackNo Or old('rackNo') }}" placeholder="@lang('Book Rack Number')" required>

        @if ($errors->has('rackNo'))
            <span class="help-block">
                <strong>{{ $errors->first('rackNo') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('rowNo') ? ' has-error' : '' }}">
    <label for="rowNo" class="col-md-4 control-label">@lang('Book Row Number')</label>

    <div class="col-md-6">
        <input id="rowNo" type="number" class="form-control" name="rowNo" value="{{ $book->rowNo Or old('rowNo') }}" placeholder="@lang('Book Row Number')" required>

        @if ($errors->has('rowNo'))
            <span class="help-block">
                <strong>{{ $errors->first('rowNo') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('img_path') ? ' has-error' : '' }}">
    <label for="img_path" class="col-md-4 control-label">@lang('Book Image Url')</label>

    <div class="col-md-6">
        <input id="img_path" type="text" class="form-control" name="img_path" value="{{ $book->img_path Or old('img_path') }}" placeholder="@lang('Book Image Url')" required>

        @if ($errors->has('img_path'))
            <span class="help-block">
                <strong>{{ $errors->first('img_path') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
    <label for="type" class="col-md-4 control-label">@lang('Book Type')</label>

    <div class="col-md-6">
        <select id="type" class="form-control" name="type">
            @foreach( $types as $type )
                <option value="{{ $type }}" @if (isset($book)) {{ $book->type== $type ? 'Selected' : '' }} @endif >
                    {{ $type }}
                </option>
            @endforeach
        </select>

        @if ($errors->has('type'))
            <span class="help-block">
                <strong>{{ $errors->first('type') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('class_id') ? ' has-error' : '' }}">
    <label for="class_id" class="col-md-4 control-label">@lang('For Class')</label>

    <div class="col-md-6">
        <select id="class_id" class="form-control" name="class_id">
            @foreach($classes as $class)
                <option value="{{ $class->id }}" @if(isset($book)) {{ $book->class_id == $class->id ? 'Selected' : '' }} @endif>
                    {{ $class->class_number }} {{ $class->group }}
                </option>
            @endforeach
        </select>

        @if ($errors->has('class_id'))
            <span class="help-block">
                <strong>{{ $errors->first('class_id') }}</strong>
            </span>
        @endif
    </div>
</div>
