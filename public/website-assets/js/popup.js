
    $(document).ready(function() {
    // Retrieve the stored data from localStorage
    let visible = localStorage.getItem('object_check_access');

    // Get the current date in YYYY-MM-DD format
    let now = new Date().toISOString().split('T')[0];

    // Check if there is no stored data
    if (!visible) {
        // Create a new object with the current date
        let object_check_access = {
            date_visible: now,
            visible: true,
        };
        // Store the new object in localStorage
        localStorage.setItem('object_check_access', JSON.stringify(object_check_access));
        // Show the modal
        $('#exampleModal').modal('show');
    } else {
        // Parse the stored data
        const storedData = JSON.parse(visible);
        // Check if the stored date is earlier than the current date
        if (new Date(storedData.date_visible) < new Date(now)) {
            // Show the modal
            $('#exampleModal').modal('show');
            // Update the timestamp and store it again
            storedData.date_visible = now;
            localStorage.setItem('object_check_access', JSON.stringify(storedData));
        }
    }
})
