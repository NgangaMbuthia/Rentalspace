<?php namespace Modules\Usermanagement\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;
use OwenIt\Auditing\AuditingTrait;
use App\User;

class Role extends EntrustRole {
	use AuditingTrait;

    protected $guarded = ['id'];
	//protected $table="userroles"  if the table is saved in a different naming format.
   public function getStatistics($role=false,$year=false,$month=false){

   	 if($role==false && $year==false && $month==false){
      $model=User::count();
   
   	 }
   	 elseif($role==false && $month==false){
   	  	$model=User::join('role_user','role_user.user_id','=','users.id')
   	  	       ->join('roles','roles.id','=','role_user.role_id')
   	  	       ->whereYear('users.created_at','=',$year)
   	  	       ->count();
   	  }

   	  elseif($year==false && $month==false){
   	  	$model=User::join('role_user','role_user.user_id','=','users.id')
   	  	       ->join('roles','roles.id','=','role_user.role_id')
   	  	       ->where(['roles.id'=>$role])->count();
   	  }
   	   elseif($role==false){
   $model=User::join('role_user','role_user.user_id','=','users.id')
   	  	       ->join('roles','roles.id','=','role_user.role_id')
   	  	       ->whereYear('users.created_at','=',$year)
   	  	       ->whereMonth('users.created_at','=',$month)
   	  	       ->count();



   	   }

   	  elseif($year==false){
   	  	$model=User::join('role_user','role_user.user_id','=','users.id')
   	  	       ->join('roles','roles.id','=','role_user.role_id')
   	  	       ->where(['roles.id'=>$role])
   	  	       ->whereMonth('users.created_at','=',$month)
   	  	       ->count();
       }
      elseif($month==false){
      		$model=User::join('role_user','role_user.user_id','=','users.id')
   	  	       ->join('roles','roles.id','=','role_user.role_id')
   	  	       ->where(['roles.id'=>$role])
   	  	       ->whereYear('users.created_at','=',$year)
   	  	       ->count();

      }else{

      	$model=User::join('role_user','role_user.user_id','=','users.id')
   	  	       ->join('roles','roles.id','=','role_user.role_id')
   	  	       ->where(['roles.id'=>$role])
   	  	       ->whereYear('users.created_at','=',$year)
   	  	       ->whereMonth('users.created_at','=',$month)
   	  	       ->count();

      }
      return $model;

   }
}