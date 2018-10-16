<script>
  var $editor = $('#editor');
  $editor.summernote({
      fontNames: ['Roboto'],
      fontNamesIgnoreCheck: ['Roboto'],
      toolbar: [
      ['style', ['style']],
//      ['fontname', ['fontname']],
      ['fontsize', ['fontsize']],
      ['font', ['bold', 'italic', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['height', ['height']],
      ['insert', ['picture', 'link', 'hr', 'video']],
      ['table', ['table']],
      ["view", ["codeview"]]
    ],
    height: 400,
  })
</script>
