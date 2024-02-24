function toggleEditForm(commentId) {
    const editForm = document.getElementById(`editForm_${commentId}`);
    editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
}


var page = 2;
var loading = false;
var commentsDisplayed = 0;

function loadMoreComments() {

    if (loading || (commentsDisplayed >= totalComments)) {
        return;
    }


    loading = true;
    $('#loading-message').text('Loading more comments...');
    $.ajax({
        url: loadMoreCommentsRoute + '?page=' + page,
        type: 'GET',
        success: function (data) {
            $('#comments-container').append(data);
            page++;
            commentsDisplayed += 5;
        },
        error: function (error) {
            console.error('Error loading more comments:', error);
        },
        complete: function () {
            loading = false;

            $('#loading-message').text('');

            if (commentsDisplayed >= totalComments) {
                $(window).off('scroll');
            }
        },
    });
}

$(window).scroll(function() {
    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
        setTimeout(function () {

            loadMoreComments();

        }, 1500);
    }
});
