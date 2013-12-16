<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Provides a handle for including the require.js script and related
 * configuration in your view.
 *
 * @author Moshe Katz, based on work by Jason Allred
 */
class Requirejs
{
    private static $config = Kohana::$config->load('requirejs');

    /**
     * Returns a script tag for requirejs. Passing a value for $main will
     * set the data-main attribute of the script.
     *
     * @param string $main The module for require to load.
     * @param array $attributes
     *
     * @return string
     */
    public static function load_require($main = null, $attributes = array())
    {
        if(!is_null($main))
        {
            $attributes['data-main'] = $main;
        }

        return HTML::script(self::config_get("lib_location")."require.js", $attributes);
    }

    /**
     * Returns a script element with your configuration from applicaion/config/requirejs.php
     * Make sure you call this method before including the requirejs script in your view
     *
     * @return string
     */
    public static function config()
    {
	$c = self::$config->get("config")
        if($c !== NULL)
        {
            return "<script> var require = ".json_encode($c)."</script>";
        }

        return "";
    }

    /**
     * Convienence method for loading both your configuration and the requirejs script
     *
     * @param string $main The module for require to load.
     * @param array $attributes
     *
     * @return string
     */
    public static function require_script_config($main = null, $attributes = array())
    {
        return self::config()."\n".self::load_require($main, $attributes);
    }
}
