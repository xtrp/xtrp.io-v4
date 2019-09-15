<?php
/* this file has controllers for the site */

// list of routes, and api routes
$routes = [
    [
        "route" => "/",
        "api_route" => "https://api.xtrp.io/home/",
        "view_filename" => "home.php",
        "title" => "Home",
        "priority" => "0.9",
        "updated" => "weekly"
    ],
    [
        "route" => "/about/",
        "api_route" => "https://api.xtrp.io/about/",
        "view_filename" => "about.php",
        "title" => "About",
        "priority" => "0.6",
        "updated" => "monthly"
    ],
    [
        "route" => "/blog/",
        "api_route" => "https://api.xtrp.io/blog/",
        "view_filename" => "blog.php",
        "title" => "Blog",
        "priority" => "0.8",
        "updated" => "weekly"
    ],
    [
        "route" => "/code/",
        "api_route" => "https://api.xtrp.io/code/",
        "view_filename" => "code.php",
        "title" => "Code",
        "priority" => "0.8",
        "updated" => "weekly"
    ],
    [
        "route" => "/resume/",
        "api_route" => "https://api.xtrp.io/resume/",
        "view_filename" => "resume.php",
        "title" => "Résumé",
        "priority" => "0.6",
        "updated" => "monthly"
    ]
];

// for each route, add to router and display view
foreach($routes as $route) {
    $router->get($route["route"], function() use( &$route ) {
        // get site details data from api/site_details/ and store in var
        $site_details = json_decode(file_get_contents("https://api.xtrp.io/site_details/"), true);
        
        // get page details and store in var
        
        // page title
        $page_title = $route["title"];
        if($page_title == "Home") {
            $page_title = $site_details["full_title"];
        }else {
            $page_title .= " | " . $site_details["full_title"];
        }
        
        $page_details = ["title" => $page_title, "description" => $site_details["description"]];

        // get data from api and store in var
        $page_data = json_decode(file_get_contents($route["api_route"]), true);

        // display view
        include_once "views/" . $route["view_filename"];
    });
}

// blog posts!

// variable for list of posts with URLs and dates, to be used in sitemap
$blog_post_urls_and_dates = [];

// list of post objs
$blog_posts = json_decode(file_get_contents("https://api.xtrp.io/blog/"), true);

// loop through each post, add data to $blog_post_urls_and_dates, and route corresponding post path
foreach($blog_posts as $post) {
    $post_url = "/blog/" . str_replace("-", "/", $post["last_updated"]) . "/" . $post["filename"] . "/";
    $post_date = $post["last_updated"];
    array_push($blog_post_urls_and_dates, ["url" => $post_url, "last_updated" => $post_date]);

    // route path
    $router->get($post_url, function() use( &$post ) {
        // get site details data from api/site_details/ and store in var
        $site_details = json_decode(file_get_contents("https://api.xtrp.io/site_details/"), true);

        // post preview: first 200 chars in post content
        $post_preview = $post["content"];
        if(strlen($post_preview) > 200) {
            $post_preview = substr($post_preview, 0, 200) . "...";
        }
        
        // get page details and store in var
        $page_details = ["title" => $post["title"], "description" => $post_preview];
        
        // get page data and store in var
        $page_data = $post;

        // display view
        include_once "views/blog_post.php";
    });
}

// RSS feed
$router->get("/feed/", function() {
    // site details
    $site_details = json_decode(file_get_contents("https://api.xtrp.io/site_details/"), true);

    // all blog posts
    $blog_posts = json_decode(file_get_contents("https://api.xtrp.io/blog/"), true);

    // include rss feed view
    include_once "views/feed.php";
});

// Sitemap XML
$router->get("/sitemap/", function() {
    $page_data = ["main_pages" => $routes, "blog_posts" => $blog_post_urls_and_dates];

    // include sitemap view
    include_once "views/sitemap.php";
});

// errors
$router->error("method_not_allowed", function() {
    // error view, with method not allowed variables
    $error_code = "method_not_allowed";
    $error_title = "Method Not Allowed";
    $error_description = "Sorry, it seems that the method " . $request->getRequestMethod() . " is not available for this URL. Return to <a href='/'>home</a> or try a different method.";
    include_once "views/error.php";
});

$router->error("is_using_ie", function() {
    // error view, with method not allowed variables
    $error_code = "using_ie";
    $error_title = "Internet Explorer Not Supported";
    $error_description = "Sorry, you are using Internet Explorer, which is not supported for this website. Try downloading a different browser such as <a href='https://www.google.com/chrome/'>Google Chrome</a>.";
    include_once "views/error.php";
});

$router->error("page_not_found", function() {
    // error view, with page not found variables
    $error_code = "page_not_found";
    $error_title = "Page Not Found";
    $error_description = "Sorry, it seems that this URL is pointing to a page that does not exist. Return to <a href='/'>home</a> or try another URL.";
    include_once "views/error.php";
});

?>