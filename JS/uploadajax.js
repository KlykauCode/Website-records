/**
 * Script for handling the avatar upload form submission
 *
 * This script adds an event listener to the 'uploadForm' and prevents its default submission
 * behavior. It then validates the file type of the uploaded avatar and makes an AJAX request
 * to a server-side script to handle the file upload. Appropriate messages are displayed based
 * on the success or failure of the upload process
 */

document.getElementById('uploadForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var formData = new FormData(this);
    var file = formData.get('avatar');

    var types = ['image/jpeg', 'image/png', 'image/gif'];

    if (file && types.includes(file.type)) {

        /**
         * Creating and configuring an XMLHttpRequest for the file upload.
         */

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'mysql/uploadFoto.php', true);

        /**
         * Handling the server response.
         * Reloads the page upon successful upload or displays an error message otherwise.
         */

        xhr.onload = function () {
            if (xhr.status === 200) {
                location.reload();
            } else {
                document.getElementById('uploadStatus').textContent = 'Upload error';
            }
        };

        xhr.send(formData);
    } else {
        document.getElementById('uploadStatus').textContent = 'Invalid file type. Only JPG, PNG and GIF are allowed.';
    }
});