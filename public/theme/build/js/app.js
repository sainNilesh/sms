function showPreview(event) {
    if (event.target.files.length > 0) {
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("image-preview");
        preview.src = src;
        preview.style.display = "block";
    }
}

$(function () {
    //Initialize Select2 Elements
    $('.subjects').select2()
  })

  
//   $(document).ready(function () {
//     $('#standard-dropdown').on('change', function () {
//         var standard_id = this.value;
//         $("#subject-dropdown").html('');
//         $.ajax({
//             url: "{{url('api/subject')}}",
//             type: "POST",
//             data: {
//                 subject_id: standard_id,
//                 _token: '{{csrf_token()}}'
//             },
//             dataType: 'json',
//             success: function (result) {
//                 $('#subject-dropdown').html('<option value="">-- Select Subject --</option>');
//                 $.each(result.subject, function (key, value) {
//                     $("#subject-dropdown").append('<option value="' + value
//                         .id + '">' + value.name + '</option>');
//                 });
//             }
//         });
//     });
// });
