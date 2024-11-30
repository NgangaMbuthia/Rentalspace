<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use OwenIt\Auditing\AuditingTrait;
use Modules\UserManagement\Entities\Profile;
use Validator;
use Modules\Company\Entities\CompanyUser;
use Modules\Backend\Entities\Agent;
use Modules\Backend\Entities\Tenant;
use Modules\Gate\Entities\GateGaurd;
use Modules\Site\Entities\ServiceProvider;
use Modules\Hotels\Entities\Supplier;

class User extends Authenticatable
{
    use Notifiable ,EntrustUserTrait,AuditingTrait;
    //const DefaultUsername = "Isanya Hillary";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','social','provider','verification_code','username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function profile(){
        return $this->hasOne(Profile::class,'user_id');
    }

     public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

     public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

   public function getMyAvartar($user_id=false){
      if($user_id==false){
        $user_id=$this->id;
      }

   }

    public function getRole($user_id=false){
        if($user_id==false){
            $user_id=\Auth::User()->id;
           }
           $model=User::join('role_user','role_user.user_id','=','users.id')
                  ->join('roles','roles.id','=','role_user.role_id')
                  ->where(['users.id'=>$user_id])
                  ->first();
        return $model->display_name;
       
       }


       public function getprovider($user_id=null)
       {
         return $this->hasOne(Agent::class,'user_id');
        
       }

       public function tenant(){
        
        return $this->hasOne(Tenant::class,'user_id');
       }

       public function supplier(){
          ;
        return $this->hasOne(Supplier::class,'user_id');

       }

      public function getCompany(){
        $model=User::join('company_users','users.id','=','company_users.user_id')
               ->join('companies','companies.id','=','company_users.company_id')
               ->where(['users.id'=>$this->id])->first();
        if(!$model){
        return null;
        }else{
          return $model;
        }
      }


      public function guardDetails(){
        return $this->hasOne(GateGaurd::class,'user_id');
      }


      public function sprovider(){
        return $this->hasOne(ServiceProvider::class,'user_id');
      }

  
}
