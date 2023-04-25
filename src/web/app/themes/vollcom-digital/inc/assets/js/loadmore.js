// Loadmore function with vanilla js
var page = 2;
var loadmore = function(){
  // Handler when the DOM is fully loaded
  document.addEventListener('click', function (event) {
    // If the clicked element doesn't have the right selector, bail
    if (!event.target.matches('.loadmore')) return;

    // Don't follow the link
    event.preventDefault();

    var data = "action=load_posts_by_ajax&page=" + page + "&security=" + blog.security;

    // Set up the HTTP request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', blog.ajaxurl);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Setup the listener to process completed requests
    xhr.onload = function() {
      // Process our return data
      if( xhr.status === 200 && xhr.response.trim() !== "" ) {
        // Runs when the request is successful
        var postlist = document.body.querySelector(".posts-list");

        //Create DOM nodes from the response string of HTML
        var posts = document.createRange().createContextualFragment(xhr.responseText);
        postlist.appendChild(posts);
        page++;
      } else {
        // Runs when it's not
        var loadmore = document.querySelector(".loadmore");
        loadmore.hidden = true;
      }
    }
    // Create and send a POST request
    xhr.send(data);

  }, false);
};

// Check DOM ready
if (
  document.readyState === "complete" ||
  (document.readyState !== "loading" && !document.documentElement.doScroll)
) {
  loadmore();
} else {
  document.addEventListener("DOMContentLoaded", loadmore);
}
