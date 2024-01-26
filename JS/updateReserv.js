/**
 * Script for handling reservation editing and updating processes.
 *
 *script listens for click events on two buttons - one to display the reservation
 * edit form and the other to submit the updated reservation date. It uses AJAX to
 * communicate with the server for updating the reservation.
 */

/**
 * Adds an event listener to the 'editReservationButton'.
 * Displays the 'editReservationForm' when the button is clicked.
 */
document.getElementById('editReservationButton').addEventListener('click', function() {
    document.getElementById('editReservationForm').style.display = 'block';

});

/**
 * Adds an event listener to the 'updateReservationButton'.
 * Sends the new reservation date to the server and updates the reservation upon clicking.
 * Validates the input and displays appropriate messages based on the action's success or failure.
 */

document.getElementById('updateReservationButton').addEventListener('click', function() {
    var newDate = document.getElementById('newDate').value;
    if (newDate) {
        /**
         * Creating and configuring an XMLHttpRequest to send the new reservation date
         * to the server for updating.
         */
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'mysql/updateReservation.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        /**
         * Handling the response from the server.
         * Displays a message based on the response and reloads the page to reflect the changes.
         */
        xhr.onload = function() {
            document.getElementById('editMessage').innerText = xhr.responseText;
            location.reload();
        };
        xhr.send('date=' + encodeURIComponent(newDate));
    } else {
        document.getElementById('editMessage').innerText = 'Please select a new date.';
    }
});
