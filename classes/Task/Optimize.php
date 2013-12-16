<?php defined('SYSPATH') or die('No direct script access.');

class Task_Optimize extends Minion_Task
{
	private $config;

	protected $_options = array(
		'build_profile' = true,
		'use_profile' => true,
	);

	/**
	 * Run the r.js optimizer using node and the build profile designated in your config.
	 *
	 * @param array $arguments Any additional arguments you want to pass to the optimizer
	 *
	 * @return int
	 */
	protected function _execute(array $params)
	{
		$this->config = Kohana::$config->load('requirejs');

		if ( ! isset($this->config["requirejs.build_profile_path"]))
		{
			echo "You must specify a build_profile_path in the bundle config file.";
			return -1;
		}

		if ($_options['build_profile'] AND isset($this->config["requirejs.build_profile"]))
		{
			if ($this->build_profile() !== 0)
			{
				echo "Unable to run RequireJS Optimizer!\n";
				return -1;
			}
		}

		$cmd = "node " . $this->config["lib_location"] ."r.js";

		if ($_options['use_profile'])
		{
			$cmd .= " -o " . $this->config["requirejs.build_profile_path"];

			if (isset($this->config["requirejs.build_args"])) {
				$cmd .= " " . $this->config["requirejs.build_args"];
			}
		}

		if (count($arguments) > 0) {
			$cmd .= " " . implode(" ", $arguments);
		}

		echo "\n$cmd\n";
		passthru($cmd);
		return 0;
	}

	private function build_profile()
	{
		$profile = "(".json_encode($this->config["requirejs.build_profile"]).")";

		$filename = $this->config["requirejs.build_profile_path"];
		$current = file_exists($filename) ?
			file_get_contents($filename) :
			"";

		if (strcmp($profile, $current) !== 0) {
			if ( ! file_put_contents($filename, $profile)) {
				echo "Update build profile: Error writing to $filename\n";
				return -1;
			}
			echo "Update build profile: Changes found. Build profile was updated\n";
		} else {
			echo "Update build profile: No changes. Build profile was not updated\n";
		}
		return 0;
	}
}
