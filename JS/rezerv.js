/**
 * Script for handling the reservation button click event.
 * 
 * This script listens for a click event on the 'reserveButton' element. Upon
 * clicking, it sends an AJAX request to a server-side script to process the
 * reservation for a selected date. The response from the server is then displayed
 * to the user.
 */

document.getElementById('reserveButton').addEventListener('click', function() {

    // Retrieving the selected date from the input field.

    var selectedDate = document.getElementById('date').value;

    // Only proceed if a date has been selected.

    if (selectedDate) {

        /**
         * Creating and configuring an XMLHttpRequest to send the selected date
         * to the server for processing the reservation.
         */
        
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'mysql/reserve.php', true); 
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

         /**
         * Handling the response from the server.
         * 
         * Updates the 'message' element's text based on the server's response.
         * Displays an error message if the request fails.
         */

        xhr.onload = function() {
            if (xhr.status == 200) {
                document.getElementById('message').innerText = xhr.responseText;
            } else {
                document.getElementById('message').innerText = 'An error occurred during your request: ' +  xhr.status + ' ' + xhr.statusText;
            }
        };
        // Sending the AJAX request with the selected date.
        xhr.send('date=' + encodeURIComponent(selectedDate));
    } else {
        // Displaying a message if no date is selected.
        document.getElementById('message').innerText = 'Please select a date.';
    }
});