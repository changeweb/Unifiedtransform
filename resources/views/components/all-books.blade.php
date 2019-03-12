{{$books->links()}}
<div class="table-responsive">
  <table class="table table-bordered table-data-div table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Book Title</th>
        <th scope="col">Book Code</th>
        <th scope="col">Author</th>
        <th scope="col">Type</th>
        <th scope="col">Quantity</th>
        <th scope="col">About Book</th>
        <th scope="col">For Class</th>
        <th scope="col">Price</th>
        <th scope="col">Rack No.</th>
        <th scope="col">Row No.</th>
      </tr>
    </thead>
    <tbody>
      @foreach($books as $book)
      <tr>
        <td>{{($loop->index + 1)}}</td>
        <td>{{$book->title}}</td>
        <td>{{$book->book_code}}</td>
        <td>{{$book->author}}</td>
        <td>{{$book->type}}</td>
        <td>{{$book->quantity}}</td>
        <td>{{$book->about}}</td>
        <td>{{$book->class->class_number}}</td>
        <td>{{$book->price}}</td>
        <td>{{$book->rackNo}}</td>
        <td>{{$book->rowNo}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
{{$books->links()}}
