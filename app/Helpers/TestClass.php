<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use Illuminate\Support\Facades\Input;
use Auth;
use Response;
use App\User;
use Session;
use Hash;
use DateTime;
use Mail;
use App\AfricasTalkingGateway;
use App\SystemModule;
use App\ProviderModule;
use App\Message;





class TestClass
{
  public static $connected_devices=array();


  public static function AddNewDevice($device){
  	Self::$connected_devices[]=$device;
  	return true;

  }


  public static  function getDevices($id=null)
  {
  	return Self::$connected_devices;
  	
  }


}