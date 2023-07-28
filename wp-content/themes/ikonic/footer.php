<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Assuming you are using jQuery for the AJAX request
    jQuery(document).ready(function($) {
        // Function to fetch projects using AJAX
        var ajaxurl = "<?php admin_url('admin-ajax.php') ?>";

        function fetchProjects() {
            $.ajax({
                url: ajaxurl, // WordPress AJAX URL
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'custom_project_endpoint',
                },
                success: function(response) {
                    if (response.success) {
                        // Process the response data (array of projects)
                        console.log(response.data);
                        // Do whatever you want with the data here (e.g., display it on the page)
                    } else {
                        console.error('Error fetching projects.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        }

        // Call the function to fetch projects
        fetchProjects();
    });
</script>
<?php
wp_footer();
?>