<?php namespace Modules\Usermanagement\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission {

    protected $fillable = [];

}