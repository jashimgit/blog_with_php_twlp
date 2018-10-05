<?php

class Session
{

	public static function init()
	{
		session_start();
	}

	public static function setData( $key, $value ) {
		$_SESSION['$key'] = $value;

	}

	public static function get($key) {

		if (isset($_SESSION['$key'])){
			return $_SESSION['$key'];

		} else {
			return false;

		}
	} // end of get method

	public static function checkSession (  ) {
		self::init();
		if (self::get("login") == false){
			self::destroy();
			header('Location:login.php');
		} else {
			return false;
		}
	}

	public static function destroy(  ) {
		session_destroy();
		header('Location:login.php');
	}



}