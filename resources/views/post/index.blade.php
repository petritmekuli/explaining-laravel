<!DOCTYPE html>
<html>
<head>
    <title>Posts Count</title>
</head>
<body>
    <h1>
        This posts count will automatically update every 10seconds.
        To see the change use tinker to add new posts.
    </h1>
    <span>Posts count: </span>
    <span id="posts-count"></span>

    <script>
        // Define a function to get the posts count using fetch API
        function getPostsCount() {
            fetch('/posts/count')
                .then(response => response.json())
                .then(data => {
                    // Update the posts count in the HTML
                    document.getElementById('posts-count').textContent = data.count;
                })
                .catch(error => console.error(error));
        }

        // Call the function to get the initial posts count
        getPostsCount();

        // Call the function every 10 seconds using setInterval
        setInterval(getPostsCount, 10000);
    </script>
</body>
</html>
