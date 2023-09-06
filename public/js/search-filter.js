$(document).ready(function() {
    // Search Form
    $('#searchForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        var formData = $(this).serialize(); // Get form data

        // Send AJAX request
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            success: function(response) {
                // Update the results container with the received results
                $('#resultsContainer').html(response);
            },
            error: function(xhr, status, error) {
                // Handle error if necessary
            }
        });
    });

    // Sort Form
    $('#sortForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        var formData = $(this).serialize(); // Get form data

        // Send AJAX request
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            success: function(response) {
                // Updatethe results container with the received results
                $('#resultsContainer').html(response);
            },
            error: function(xhr, status, error) {
                // Handle error if necessary
            }
        });
    });
});
