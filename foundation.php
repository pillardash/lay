<?php

use BrickLayer\Lay\Core\App;
use BrickLayer\Lay\Core\Startup;

include_once __DIR__ . DIRECTORY_SEPARATOR . "vendor" .  DIRECTORY_SEPARATOR . "autoload.php";

Startup::validate_lay();

$sess = [
    "http_only" => true,
//    "only_cookies" => true,
    "secure" => true,
    "samesite" => 'None',
];

if(App::is_prod()) {
    $sess['lifetime'] = 0;
    $sess['path'] = "/";
    $sess['domain'] = "localhost";
}

Startup::session($sess);

Startup::cors(
// Specify where to allow requests from
    allowed_origins: [
        "http://localhost",
    ],

    // Allow requests from all origins
    allow_all: true,

    // Headers to add to the response
    fun: function () {
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
);

///// Project Configuration

$site_name = "Sample Lay Project";

Startup::new()
    ->name($site_name, "$site_name | Slogan Goes Here")
    ->color("#082a96", "#0e72e3")
    ->email("EMAIL-1", "EMAIL-2")
    ->tel("TEL-1", "TEL-2")
    ->author("Lay by PillarDash")
    ->copyright("&copy; " . date('Y') . "; All rights reserved <a href='https://lay.pillardash.com'>Lay - By PillarDash</a>")

    // If you don't want your app to connect to the database by default; then remove the next line
    ->connect_db()

    // Store non-sensitive data ands access it anywhere in the project by calling the `App::globals()->desc` method.
    // If you have a value that persists both on local environment and production, use this
    ->set_globals([
        "desc" => "This is an awesome project that is about to unfold you just watch and see 😉.",
        "bucket_domain" => "https://bucket.lay.osaitech.dev/"
    ]);
