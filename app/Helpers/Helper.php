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
use Modules\Backend\Entities\Upload;
use Modules\UserManagement\Entities\Role;
use Modules\Backend\Entities\SMessage;
use Modules\Gate\Entities\GateGaurd;
use Modules\Gate\Entities\GateAssignment;
use Modules\Gate\Entities\Gate;
use Modules\Backend\Entities\Property;
use Modules\Backend\Entities\PropertyImage;
use Modules\Backend\Entities\Plot;
use Modules\Backend\Entities\PlotImage;
use App\Messaging;
use Validator;
use Modules\Backend\Entities\Receipt;
use App\TenantMonthlyReport;
use Image;


class Helper
{

   

 public static function getAccountBalances($accountNumber,$currency,$date)
 {
   
   $plainText=$accountNumber.$currency.date('Y-m-d',strtotime($date));
    $privateKey = openssl_pkey_get_private(("file://".base_path()."/privatekey.pem"));
    $token      = "AIAZ1DNTnosxAuppox8TQSit5QvY";
  openssl_sign($plainText, $signature, $privateKey, OPENSSL_ALGO_SHA256);
 $curl        = curl_init();
$data_string = '{
    "countryCode":"'.$currency.'",
    "accountId":'.$accountNumber.',
    "date":"'.$date.'"
    }';


curl_setopt_array($curl, array(
    CURLOPT_URL => "https://sandbox.jengahq.io/account-test/v2/accountbalance/query",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $data_string,
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer " . $token,
        "cache-control: no-cache",
        "Content-Type: application/json",
        "signature: " . base64_encode($signature)
    )
));
$result = curl_exec($curl);
$err    = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $result;
}

 } 


 public static function getMinStatement($currency,$accountNumber)
 {
    $plainText=$currency.$accountNumber;

    $privateKey = openssl_pkey_get_private(("file://".base_path()."/privatekey.pem"));
    $token      = "8BYc4bF5TqokeKDFrGIsO13aeicu";
  openssl_sign($plainText, $signature, $privateKey, OPENSSL_ALGO_SHA256);
 $curl        = curl_init();
$data_string = '{
    "countryCode":"'.$currency.'",
    "accountId":'.$accountNumber.'
    }';

$url="https://sandbox.jengahq.io/account-test/v2/accounts/ministatement";

curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $data_string,
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer " . $token,
        "cache-control: no-cache",
        "Content-Type: application/json",
        "signature: " . base64_encode($signature)
    )
));
$result = curl_exec($curl);

$err    = curl_error($curl);


curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {

    echo $result;
}

 }






    /*Function to handle SMS Sending across the application*/
    public static function sendSMS($to,$text,$provider=null,$count=null)
	{
	      
    return true;
         if($provider==null){
           $provider=Auth::User()->getProvider->id;
         }
        $testmodule=Self::testModule("SMS and Bulk Emails Module",$provider);
            if($testmodule==true){

                $lenth=strlen($text)+10;
                $size=($count)? $count :round($lenth/160);
                $test=Self::send($to,$text); 

                  if(isset($to) && !empty($text)){
                     $message=new Message();
                     $message->phone=$to;
                     $message->message=$text;
                     $message->type="Provider";
                     $message->delvery_status=(isset($to))?"DELIVERED" :'UNDELIVERED';
                     $message->mesage_size=$size;
                     $message->type_id=$provider;
                     $message->save();

                  }
                
                

            }
	  
           
	}


  public static function  CreateTenantMonthlySummary($invoice,$tenant)
  {
     
    $payment=new TenantMonthlyReport();
     $payment->tenant_id=$tenant->id;
       $payment->space_id=$invoice->space_id;
       $payment->month=date('M',strtotime($invoice->issue_date));
       $payment->year=date('Y',strtotime($invoice->issue_date));
       $payment->pre_balance=0;

       $payment->invoice_amount=$invoice->amount;
       $payment->new_balance=$payment->pre_balance+$payment->invoice_amount;
       $payment->amount_paid=0;
       $payment->balance=$payment->new_balance-$payment->amount_paid;
       $payment->save();
       

  }

  public static function repopulateMonthlyBreakdown($summary,$credit,$debit,$rent,$deposit,$direct)
  {
      
     $model=TenantMonthlyReport::where(['space_id'=>$summary->space_id,'month'=>$summary->month,'year'=>$summary->year])->latest('id')->first();



    
     
      if(!$model)
      {
        $model=new TenantMonthlyReport();
        $model->tenant_id=$summary->tenant_id;
        $model->space_id=$summary->space_id;
        $model->month=$summary->month;
        $model->year=$summary->year;
        $model->pre_balance=0;
        $model->invoice_amount=$credit;
        $model->new_balance=$model->pre_balance+$model->invoice_amount;
       $model->amount_paid=$debit;

       $model->balance=$model->new_balance-$model->amount_paid;
      
       $model->rent=0;
       $model->deposit=$deposit;
       $model->direct_amount=$direct;
        $model->save();


      }else{
          

        $model->amount_paid=$model->amount_paid+$debit;
        $model->balance=$model->new_balance-$model->amount_paid;
        $model->rent=0;
        $model->rent_amount_paid=$rent;
       $model->deposit=$deposit;
       $model->direct_amount=$direct;
       
       
         
      }




      $property=self::getProperty($model);


        if($property)
        {
       $percentage=$property->agent_commission_percentage;
       $agentAmount=($rent*$percentage)/100;
        $model->agent_commision=$agentAmount;
        $model->landload_amount=$rent-$agentAmount;
        }
         
        $model->save();
        
        

  }

  public static  function checkForMonthReports($space,$amount)
  {
    
    $model=TenantMonthlyReport::where(['space_id'=>$space->id,'month'=>date("M"),'year'=>date('Y')])->latest('id')->first();
     
     
      if(!$model)
      {
        $model=new TenantMonthlyReport();
        $model->tenant_id=$space->tenant_id;
        $model->space_id=$space->id;
        $model->month=date('M');
        $model->year=date('Y');
        $model->pre_balance=0;
        $model->invoice_amount=$amount;
        $model->new_balance=$model->pre_balance+$model->invoice_amount;
       $model->amount_paid=0;
       $model->balance=$model->new_balance-$model->amount_paid;
        $model->save();
       }else{
        $model->invoice_amount=$model->invoice_amount+$amount;
        $model->new_balance=$model->new_balance+$amount;
        $model->balance=$model->new_balance-$model->amount_paid;
           
        $model->save();
         
      }

  }

  public static function getProperty($model)
  {
    $space=$model->space;
     if($space)
     {
       $property=$space->property;
        return $property;
     }else{
       return null;
     }

    

  }








  public static function updateTenantMonthReport($component,$tenant,$model)
  {

   
      

    $invoice=$component->invoice;

   $payment=TenantMonthlyReport::where(['tenant_id'=>$tenant->id,'space_id'=>$invoice->space_id])->latest('id')->first();  
     
      if($payment)
      { 
        $payment->amount_paid=$payment->amount_paid+$model->debit;
        $payment->balance=$payment->new_balance-$payment->amount_paid;
        

         $property=$tenant->space->property;
         if($component->name=="Rent")
         {
          
           $payment->rent=$component->amount_paid;
           $payment->agent_commision=( $property->agent_commission_percentage*$payment->rent)/100;
         }
         else if($component->name=="Deposit"){
          $payment->deposit=$component->amount_paid;

         }
          else if($component->name=="Garbage collection"){
          $payment->gabbage_bill=$component->amount_paid;

         }
         else if($component->name=="Internet"){
          $payment->internet=$component->amount_paid;

         }
         else {
          $payment->other_changes=$component->amount_paid;
         }




         $payment->landload_amount=$payment->amount_paid- $payment->agent_commision;
         $payment->save();

      }
    

  }



    public static function testModule($module_name,$provider){
        $module=SystemModule::where(['name'=>$module_name])->first();
         if($module){
            $id=$provider;

            $testmodel=ProviderModule::where(['module_id'=>$module->id,'type'=>'Provider','type_id'=>$id,'status'=>'Active'])->first();
              if($testmodel){
                return true;
              }else{
                return false;
              }

            
         }

    }


    public  static function sendSms2($to,$text)
    {

      try{
         $key="YxNyBdkeCqrImxaxBNy6wj4H16VTtO9qAgMrPmy1mlleTsfbileslpeykLabi1BO";
       
      $post = [
            'key' => $key,
            'numbers' => $to,
            'text'   => $text,
            'sender_id'=>'Geecko',

        ];

        $ch = curl_init('http://gmessenger.co.ke/api/message/bulk/send');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        // execute!
        $response = curl_exec($ch);

        // close the connection, release resources used
        curl_close($ch);
        // do anything you want with your response
        $return_message=json_decode($response);

        $success=$return_message->success;
        return true;
        
      
           
    }catch(\Exception $e)
     {
       return false;
      }
    }



   public static  function send($phone,$message2)
    {
      $key="H9RhFPF1l2s5gFa77A9SnVtHhzRPp";
    $to=substr($phone, 0,100);
    
    $post = [
    'key' => $key,
    'numbers' => $to,
    'text'   => $message2,
    ];

    $ch = curl_init('http://bulk.pictonet.co.ke/api/message/bulk/send');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        // execute!
    $response = curl_exec($ch);

        // close the connection, release resources used
    curl_close($ch);
    return true;
    /* dd($message2);
    return true;

        // do anything you want with your response
    $return_message=json_decode($response);
    $success=$return_message->success;
    if($success){
      $response=$return_message->response;
      foreach($response as $respons){
        $message=new Message();
        $message->type="Provider";
        $message->type_id=Auth::User()->getProvider->id;
        $message->mesage_size=$respons->sms_count;
        $message->message=$message2;
        $message->delvery_status=$respons->status;;
        $message->phone=$respons->recipient;
        $message->message_id=$respons->message_id;
        $message->save();
      }

    }*/
    return true;

        
     

    }

	


	public static function sendEmail($email, $message_body, $subject) 
	{
     return true;

        try 
        {
            Mail::send('emails.layout', array('mail_body' => $message_body), function ($message) use ($email, $subject) {
                $message->to($email)->subject($subject);
            });
        } 

        catch (Exception $e)
        {
            Log::error($e->getMessage());
            return false;
        }

    }


    public static function sendEmailToSupport($body) 
  {
   
        try 
        {
            $email="hisanyad@gmail.com";
            $subject="Development Error";
            Mail::send('emails.errors', array('e' => $body), function ($message) use ($email, $subject) {
                $message->to($email)->subject($subject);
            });
        } 

        catch (Exception $e)
        {
            Log::error($e->getMessage());
        }

    }
    public static function uploadFile2($data){
      try{
        $file=$data['avatar'];
       $path="uploads/";
       $extention=$file->getClientOriginalExtension();
       $filename=date('UNIX').".".$extention;
       $file->move($path,$filename);
        $upload=new Upload;
        $upload->filename=$filename;
        $upload->extention=$extention;
        $upload->user_id=Auth::user()->id;
        $upload->save();
        return  $upload;


      }catch(\Exception $e){
         Helper::sendEmailToSupport($e);
         return false;

      }
       



    }

    public static function uploadFile()
    {
    	$files=Input::file('files');
    	$fileuploads=[];

    	foreach ($files as $file) {
    		$path="uploads/";
    		$extention=$file->getClientOriginalExtension();
    		$filename=date('UNIX').".".$extention;
    		$file->move($path,$filename);
    		$upload=new Upload;
    		$upload->filename=$filename;
    		$upload->extention=$extention;
    		$upload->user_id=Auth::user()->id;
    		$upload->save();



      $url=url('/uploads/'.$filename);
    		$deleteurl=url('/uploads/delete/'.$filename);
    		//dd($url);

    		$fileuploads[]=['thumbnailUrl'=>$url,'url'=>$url,'name'=>$filename,'deleteUrl'=>$deleteurl,'size'=>23434,'id'=>$upload->id,'ext'=>$extention];
    	}

    	//dd($fileuploads);
    	return json_encode(['files'=>$fileuploads]);
    	exit;
    }
    public static function getFileUrl($id=NULL)
    {
    	if($id==NULL)
    	{
    		$auth=@Auth::user()->avatar;
			if($auth=="" || $auth==NULL)
			{
				return url('assets/img/k.png');
			} 	
			elseif(is_numeric(Auth::user()->avatar))
			{
				$file=Upload::find(Auth::user()->avatar);
	    	    return  url('uploads/'.$file->filename);

			}
			else
			{
				return @Auth::user()->avatar;
			}
    	}
    	else
    	{
    		$user=User::find($id);
    		$auth=$user->avatar;
			if($auth=="" || $auth==NULL)
			{
				return url('assets/img/k.png');
			} 	
			elseif(is_numeric($user->avatar))
			{
				$file=Upload::find($user->avatar);
	    	    return  url('uploads/'.$file->filename);
			}
			else
			{
				return $user->avatar;
			}
    	}   	

    	
    }

    public static  function uploadReceipt($model,$data)
    {
       
       $photo=$data['receipt'];
      $file = array('file' => $photo);
    $rules = array('file' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
    $validator = Validator::make($file, $rules);
    if ($validator->fails()) {
      // send back to the page with the input data and errors
      return redirect()->back()->withInput()->withErrors($validator);
    }
    else {
        
      if ($photo->isValid()) {
        
     $paths= '/uploads/docs/';

     $destinationPath = public_path().'/uploads/docs';
     $extension = $photo->getClientOriginalExtension(); // getting 
     
      $fileName =date('Ymdhis').'_doc.'.$extension; // renameing image
      $extension = $photo->getClientOriginalExtension();
        $directory="Receipts/provider-".$model->provider_id;
     \Storage::disk('local')->put($directory."/".$photo->getFilename().'.'.$extension,  \File::get($photo));
     $file_name=$photo->getFilename().'.'.$extension;
     $name= $fileName;
     $receipt=new Receipt();
     $receipt->payment_id=$model->id;
     $receipt->ref_no=$model->reference_number;
     $receipt->doc_path=$directory;
     $receipt->doc_size=round($photo->getClientSize()/(1024*1024),2);
     $receipt->mime=$photo->getClientMimeType();;
     $receipt->original_filename=$photo->getClientOriginalName();
     $receipt->other_meta_data=$fileName;  
     $receipt->save();
     return true;

       }
      else {
        return redirect()->back()->with('msg','File is Not valis');
      }
}

    }




    

    public static function getFilePath($id)
    { 

      if(strlen($id)>12){
                return $id;
             }
    	if($id=="")
    	{
    		return url('assets/img/k.png');
    	}
    	else
    	{
    		$file=Upload::find($id);
			if(!is_object($file))
			{
				return url('assets/img/k.png');
			}
			else
			{
				if($file->filename==NULL)
				{
					return url('assets/img/k.png');
				}
				else
				{
					return  url('uploads/'.$file->filename);
				}
				
			}
    	}
  	
    }

     public static function getPropertyCoverImage($id,$mode=null)
    { 


      if(strlen($id)>12){
                return $id;
             }
      if($id=="")
      {
        return url('assets/img/k.png');
      }
      else
      {
      
        if($mode==null){
          $image=PropertyImage::where(['property_id'=>$id])->first();
        }else{
          $image=PropertyImage::where(['property_id'=>$id])->inRandomOrder()->first();
        }
        

         if(!$image){
          return url('assets/img/k.png');
        }
        
       $file=Upload::find($image->image_id);
      if(!is_object($file))
      {
        return url('assets/img/k.png');
      }
      else
      {
        if($file->filename==NULL)
        {
          return url('assets/img/k.png');
        }
        else
        {
          return  url('uploads/'.$file->filename);
        }
        
      }
      }
    
    }

    public  static function getPlotCoverImage($id,$mode=null){


      if(strlen($id)>12){
                return $id;
             }
      if($id=="")
      {
        return url('assets/img/k.png');
      }
      else
      {

        if($mode==null){
          $image=PlotImage::where(['plot_id'=>$id])->first();
        }else{
          $image=PlotImage::where(['plot_id'=>$id])->inRandomOrder()->first();
        }
        

         if(!$image){
          return url('assets/img/k.png');
        }
        
       $file=Upload::find($image->image_id);
      if(!is_object($file))
      {
        return url('assets/img/k.png');
      }
      else
      {
        if($file->filename==NULL)
        {
          return url('assets/img/k.png');
        }
        else
        {
          return  url('uploads/'.$file->filename);
        }
        
      }
      }

    }







    public static function fetchFiles()
    {
    	$images=Upload::where('user_id',Auth::user()->id)->orderBy('id','DESC')->take(12)->get();
    	return json_encode($images);
    }
    public static function getVehicleMake()
    {
    	$makes=Makes::all();
		return $makes;
    }


    public static function createNotification($user,$body,$send_email=true,$subject=null)
    {
       $message=new Messaging();
       $message->receiver_id=$user->id;
       $message->sender_id=Auth::User()->id;
       $message->subject=$subject;
       $message->content=$body;
       $message->flag="notification";
       $message->key=strtoupper(str_random(8));
       $message->save();
        if($send_email)
        {

       Helper::sendEmail("hisanyad@gmail.com",$body,$subject);
         
        }
        return true;


    }

    
   
    
   

   
    


    public static function generateToken() {
    	return Helper::clean(Hash::make(rand() . time() . rand()));
	}

	

	public static function clean($string) {
	    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

	    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}

	public static function isTokenActive($current_time) {
	    if ($current_time >= time()) 
	    {
	        return true;
	    } else {
	        return false;
	    }
	}



  public static function RandomEmail(){

    // array of possible top-level domains
$tlds = array("com", "net", "gov", "org", "edu", "biz", "info");

// string of possible characters
$char = "0123456789abcdefghijklmnopqrstuvwxyz";

// start output


// main loop - this gives 1000 addresses
for ($j = 0; $j < 1; $j++) {

  // choose random lengths for the username ($ulen) and the domain ($dlen)
  $ulen = mt_rand(2, 5);
  $dlen = mt_rand(3, 4);

  // reset the address
  $a = "";

  // get $ulen random entries from the list of possible characters
  // these make up the username (to the left of the @)
  for ($i = 1; $i <= $ulen; $i++) {
    $a .= substr($char, mt_rand(0, strlen($char)), 1);
  }

  // wouldn't work so well without this
  $a .= "@";

  // now get $dlen entries from the list of possible characters
  // this is the domain name (to the right of the @, excluding the tld)
  for ($i = 1; $i <= $dlen; $i++) {
    $a .= substr($char, mt_rand(0, strlen($char)), 1);
  }

  // need a dot to separate the domain from the tld
  $a .= ".";

  // finally, pick a random top-level domain and stick it on the end
  $a .= $tlds[mt_rand(0, (sizeof($tlds)-1))];

  // done - echo the address inside a link
  //echo "<a href=\"mailto:". $a. "\">". $a. "</a><br>\n";

} 

return $a;



  }


  public static function FindRoleDetails($param,$value){

  try{
    $role=Role::where($param,$value)->first();
    
       return $role;


    }catch(\Exception $e){
      Self::sendEmailToSupport($e);

    }

    

  }

   public static  function GateDetails($id){
        $today=date('Y-m-d');


       
           try{
             $assingment=GateAssignment::where(['status'=>'Active'])->where('guard_id',$id)->first();
                try{
                    $id=($assingment)?$assingment->gate_id:0;


                    
                    $model=Gate::find($id);
                     return $model;

                   }
                   catch(\Exception $e)
                   {
                    Helper::sendEmailToSupport($e);
                   } 
         }catch(\Exception $e){
             Helper::sendEmailToSupport($e);
         }

    }

    public static function getProviderByPropertyID($property_id){
      $model=Property::find($property_id);
      return ($model)? $model->provider_id:null;

    }

    public static function ScheduleMessage($data){

        try{
                if(isset($data['group_id'])){
                    $model=new SMessage();
                    $model->message=$data['message'];
                    $model->group_ids=json_encode($data['group_id']);
                    $model->type=$data['type'];
                    $model->send_date=(isset($data['date']))? $data['date']:null;
                    $model->send_time=(isset($data['time']))? $data['time']:null;
                     $date=(isset($data['date']))? $data['date']:null;
                     $time=(isset($data['time']))? $data['time']:null;
                     $new_date=$date." ".$time;
                     $model->send_day=(date('l', strtotime($new_date)));
                     $model->status="Active";
                     $model->owner_type="Provider";
                     $model->owner_id=\Auth::User()->getProvider->id;
                     $model->save();
                     return true;




                  }else{
                    return false;
                  }
                 
      }catch(\Exception $e){
        Self::sendEmailToSupport($e);

       }

        }

  public static function processNumber($no){
     $sub_number=substr($no, 0,4);
        if(preg_match("/25/i", $sub_number)){
          return $no;
        }else{
          $sub_number=substr($no, 0,2);
            if($sub_number==07){
              $add_number=substr($no, 1,20);
              $new_nmber="+254".$add_number;
               return $new_nmber;
              
            }else{

              ///from excel
                $sub_number=substr($no, 0,1);
               if(preg_match('/7/i',$sub_number )){
                $add_number=substr($no, 0,10);
              $new_nmber="+254".$add_number;
               return $new_nmber;
              

               }else{
                return $no;
               }
              
            }

           
           
        }



  }


	

	

    
    

        

     



}