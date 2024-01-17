// function likeAjax(commentId) {
    $(document).ready(function () {
        $('#likeButton').click(function () {
            // e.preventDefault();


            $.ajax({
                type: 'POST',
                url: $('#likeForm').attr('action'),
                data: $('#likeForm').serialize(),
                success: function (response) {
                    console.log('Like action successful:', response);
                    $('#likeButton').text(response.liked ? 'Unlike' : 'Like');
                    $('#likeCount').text(response.likeCount);
                },
                error: function (error) {
                    console.error('Error performing like action:', error);
                }
            });
        });
    });
// }
