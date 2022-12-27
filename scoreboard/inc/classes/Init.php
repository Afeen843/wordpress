<?php

namespace Inc;

class Init{

	public static function get_service()
	{
		return[
			adminPages::class
		];
	}

public static function initialize($class){
	return new $class;
}



	public static function register_service() {

		foreach (self::get_service() as $class){
			$service=self::initialize($class);
			if(method_exists($service,$class)){
				$service->Register();
			}
		}
	}


}