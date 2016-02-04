<?php
/**
 * Created by PhpStorm.
 * User: Christopher Goehrs
 * Date: 12/8/2015
 * Time: 9:45 PM
 */

namespace lillockey\Utilities\App\Access\ObjectAccess;


use lillockey\Utilities\App\Access\Helpers\JsonErrorReportable;
use lillockey\Utilities\App\InstanceHolder;

class JsonObject extends AccessibleObject implements JsonErrorReportable
{
	private $json_error = null;
	private $json_error_msg = null;

	public function __construct($json)
	{
		$util = InstanceHolder::util();
		if($util->is_json($json)) {
			parent::__construct($std = json_decode($json));
			$this->json_error = json_last_error();
			$this->json_error_msg = json_last_error_msg();
		} else {
			parent::__construct($std = new \stdClass());
		}
	}

	public function getJsonError()
	{
		return $this->json_error;
	}

	public function getJsonErrorMessage()
	{
		return $this->json_error_msg;
	}
}