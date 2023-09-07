
    $(document).ready(function() {
    // Search Form
    $('#searchPost').on(function(event) {
        event.preventDefault(); // Prevent default form submission

        var formData = $(this).serialize(); // Get form data

        // Send AJAX request
        $.ajax({
            url: '/search',
            type: 'post',
            data: formData,
            success: function(response) {
                // Update the results container with the received results
                $('#resultsContainer').html(response);
                lazyLoad();

            },
            error: function(xhr, status, error) {
                // Handle error if necessary
            }
        });
    });
});
