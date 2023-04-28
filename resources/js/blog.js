$(document).ready(function () {

tinymce.init({
    selector: 'textarea#body',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
});

/*Form Submit*/
if ($("#blogForm").length > 0) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $("#blogForm").validate({
        rules: {
            title: {
                required: true,
                maxlength: 255,
                remote: {
                    url: hasDuplicateBlogTitle,
                    type: "post",
                    data: {
                        id: function () {
                            return $("input[name='blog_id']").val();
                        },
                        title: function () {
                            return $("input[name='title']").val();
                        }
                    },
                    dataFilter: function (data) {
                        if (data) {
                            return false;
                        } else {
                            return true;
                        }
                    }
                }
            },   
            file: {
                accept: "image/jpeg,image/jpg,image/png"
            }
        },
        messages: {
            title: {
                required: "Please enter title",
                maxlength: "Your title maxlength should be 255 characters long.",
                remote: "This title is already exists in our system. Please try something new!"
            },  
            file: {
                accept: "Please select a valid image file (jpeg, jpg, png)."
            }
        },
        submitHandler: function(form) {

            var bodycontent = tinymce.activeEditor.getContent();
            
            if (bodycontent.trim().length === 0) {
                // display error message
                $('#body-error').text('Please enter some content here!');
                return false;
            }
            var form = $('#blogForm')[0];
            var formData = new FormData(form);
            formData.append('body', bodycontent);

            event.preventDefault();

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#submit').html('Please Wait...');
            $("#submit"). attr("disabled", true);
            $.ajax({
                url: blogUrl,
                type: "POST",
                processData: false,
                contentType: false,
                data: formData,
                success: function( data ) {
                    if (data.status === 'success') {
                        window.location.href = '/blogs';
                    } else {
                        $('#submit').html('Submit');
                        $("#submit").attr("disabled", false);
                        // display validation error messages
                        $('#title-error').text(data.message.title[0]);
                        $('#body-error').text(data.message.body[0]);
                        $('#file-error').text(data.message.file[0]);
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
    })
}
});
