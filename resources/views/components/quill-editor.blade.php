<!-- Create the editor container -->
<div id="editor{{$syllabus->id}}" style="height: 250px">
</div>

<!-- Initialize Quill editor -->
<script>
  var delta{{$syllabus->id}} = {
  "ops": [
    {
      "insert": "{{$syllabus->description}}\n"
    }
  ]
};
var toolbarOptions = [
['bold', 'italic', 'underline', 'strike'],        // toggled buttons
['blockquote', 'code-block'],

[{ 'header': 1 }, { 'header': 2 }],               // custom button values
[{ 'list': 'ordered'}, { 'list': 'bullet' }],
[{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
[{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
[{ 'direction': 'rtl' }],                         // text direction

[{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
[{ 'header': [1, 2, 3, 4, 5, 6, false] }],

[{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
[{ 'font': [] }],
[{ 'align': [] }],

['clean']                                         // remove formatting button
];

  var quill{{$syllabus->id}} = new Quill('#editor{{$syllabus->id}}', {
    modules: { toolbar: toolbarOptions },
    theme: 'snow'
  });
  quill{{$syllabus->id}}.setContents(delta{{$syllabus->id}});
</script>
