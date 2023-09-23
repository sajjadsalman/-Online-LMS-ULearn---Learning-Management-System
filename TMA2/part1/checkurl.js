document.getElementById('urlForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var url = document.getElementById('url').value;
    var errorContainer = document.getElementById('errorContainer');

    // Step 1: Validate URL format using JavaScript
    var urlPattern = /^(ftp|http|https):\/\/[^ "]+$/;
    if (!url.match(urlPattern)) {
        errorContainer.innerText = 'Invalid URL format';
        return;
    }

    // Step 2: Submit form to server for further validation
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset=UTF-8');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            errorContainer.innerText = xhr.responseText;
        }
    };
    xhr.send('url=' + encodeURIComponent(url));
});
