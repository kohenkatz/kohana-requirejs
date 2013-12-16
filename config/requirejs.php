<?php defined('SYSPATH') OR die('No direct script access.');

// Paths here will be shared between the RequireJS config and build profiles.
$paths = array();

// Shims here will be shared between the RequireJS config and build profiles.
$shim  = array();

return array(
    // IMPORTANT! Path to where the RequireJS library can be found
    // You must download it yourself (manually or with a package manager).  Because
    // there are so many different project structures that can be used, this module
    // cannot assume that you are using any particular one.
    // Note that the path here must end with a slash.
    "lib_location" => "js/libs/",

    // Configuration for RequireJS.  Will be inserted into the page when you
    // call `Requirejs::config()`.
    //
    // See http://requirejs.org/docs/api.html#config
    "config" => array(
        /* Put your configuration here */

        // Override this in your application config to point to where you keep
        // your JavaScript. You can choose different paths based on the current
        // environment so the path to your optimized scripts in used in PRODUCTION
        // and the original scripts are used in DEVELOPMENT.
        "baseUrl" => 'js/app/',

        "paths" => $paths,
        "shim" => $shim,
    ),

    // The build profile that the optimizer should use
    "build_profile_path" => DOCROOT."js/app.build.js",

    // Additional arguments to the optimizer
    "build_args" => "",

    // The build profile (WIP)
    /* "build_profile" => array(
                'appDir' => "./app",
                'baseUrl' => ".",
                'dir' => "./app-build",
                'paths' => $paths,
                "shim" => $shim,
                'modules' => array(
                        // Modules to have requirejs optimize
                )
        ), */
);
