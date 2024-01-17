$(document).ready(function () {

    var page = 2;
    var oznamDisplayed = 0;

    $('#load-more-posts').on('click', function () {
        $.ajax({
            url: loadMoreOznamRoute,
            type: 'GET',
            data: { page: page },
            success: function (data) {
                $('#oznam-container').append(data);
                page++;
                oznamDisplayed += 6;

                if (oznamDisplayed >= totalOznam) {
                    $('#load-more-posts').hide();
                }
            },
            error: function (error) {
                console.error('Error loading more posts:', error);
            }
        });
    });
});
