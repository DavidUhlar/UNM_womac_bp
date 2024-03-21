$(document).ready(function () {
    $('#likeButton').click(function () {
        $.ajax({
            type: 'POST',
            url: $('#likeForm').attr('action'),
            data: $('#likeForm').serialize(),
            success: function (response) {
                console.log('Like action successful:', response);
                $('#likeButton').text(response.liked ? 'Evidované' : 'Neevidované');
                $('#likeCount').text(response.likeCount);
            },
            error: function (error) {
                console.error('Error performing like action:', error);
            }
        });
    });
});

