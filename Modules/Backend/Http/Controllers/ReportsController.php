<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Excel;
use Auth;
use Entrust;
use App\User;
use Modules\Backend\Entities\Space;
use Modules\Backend\Entities\Tenant;
use Modules\Backend\Entities\TenantPayment;
use Modules\Backend\Entities\Property;
use Modules\Backend\Entities\Invoice;
use PDF;
use Modules\Backend\Entities\TenantCharges;
use App\Helpers\TestClass;
use Storage;
use Modules\Backend\Entities\Repair;
use Modules\Backend\Entities\Plot;
use App\Http\Middleware\AccountSetUp;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response


     */


     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(AccountSetUp::class);

    }



    public function index()
    {
        return view('backend::index');
    }


    public function getCreditReports($column,$tenant_id){
         $oreintation="landscape";
         Excel::create('records', function($excel) use($oreintation,$tenant_id,$column) {
          $excel->sheet('Sheet1', function($sheet) use($oreintation,$tenant_id,$column) {
          if($tenant_id=="All"){
            $p_id=Auth::User()->getProvider->id;
        $models=TenantPayment::join('tenants','tenants.id','=','tenant_payments.tenant_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('spaces','tenants.space_id','=','spaces.id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->join('sub_categories','sub_categories.id','=','properties.subcategory_id')
          ->join('profiles','profiles.user_id','=','users.id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id','tenants.space_id','users.email','telephone','tenants.updated_at','tenants.created_at','users.id as user_id','balance','debit','credit','reference_number','transaction_date','invoice_id','tenant_payments.created_at','sub_categories.name as sub_cat','tenant_payments.id as payment_id'])
          ->where($column,'>',0)
          ->where(['properties.provider_id'=>$p_id])->get();

          }else{
            $p_id=Auth::User()->getProvider->id;
        $models=TenantPayment::join('tenants','tenants.id','=','tenant_payments.tenant_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('spaces','tenants.space_id','=','spaces.id')
          ->join('sub_categories','sub_categories.id','=','properties.subcategory_id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->join('profiles','profiles.user_id','=','users.id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id','tenants.space_id','users.email','telephone','tenants.updated_at','tenants.created_at','users.id as user_id','balance','debit','credit','reference_number','transaction_date','invoice_id','tenant_payments.created_at','sub_categories.name as sub_cat','tenant_payments.id as payment_id'])
          ->where($column,'>',0)
          ->where(['properties.provider_id'=>$p_id,'tenant_id'=>$tenant_id])->get();
          ;
          }

         

            
                $arr =array();
                foreach($models as $model) {
                    $name=$model->name;
                    $invoice=Invoice::find($model->invoice_id);
                     if($invoice){
                      $invoice_number=$invoice->invoice_number;
                     }else{
                       $invoice_number="Not Set";
                     }
                    $date=date('dS M,Y',strtotime($model->transaction_date));
                      
                    $make=$model->make;
                    $modeld=$model->model;
                    $type=$model->number;
                    $sub_cat=$model->sub_cat;
                    $ref_no=$model->reference_number;
                    $status=$model->status;
                    $amount=($model->credit>0)? $model->credit:$model->debit;
                    $date_created=date('dS M,Y  H:i:s',strtotime($model->created_at));
                    


                    
                     //$number=$model->getStats($employee->id,"all");
                    $data =  array($invoice_number,$name,$date,$type,$sub_cat,$ref_no,$amount,$date_created);
                    array_push($arr, $data);
                    }
               $sheet->fromArray($arr,null,'A2',false,false)->prependRow(array(
                        'Invoice Number','Tenant Name','Transaction ','Unit','Unit Type','Ref Number','Amouunt','Date Entered'
                    )
                );
                
                $sheet->row(1,function($row){
                    $row->setFont(array(
                        'family'     => 'Calibri',
                        'bold'       =>  true
                    ));});

                $sheet->setOrientation($oreintation);
                 });

        })->export("xls");


    }


    public function getTransactions($tenant_id){
         $oreintation="landscape";
     Excel::create('records', function($excel) use($oreintation,$tenant_id) {
                $excel->sheet('Sheet1', function($sheet) use($oreintation,$tenant_id) {
           

              if($tenant_id=="All"){
            $p_id=Auth::User()->getProvider->id;
        $models=TenantPayment::join('tenants','tenants.id','=','tenant_payments.tenant_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('spaces','tenants.space_id','=','spaces.id')
          ->join('properties','properties.id','=','spaces.property_id')
           ->join('sub_categories','sub_categories.id','=','properties.subcategory_id')
          ->join('profiles','profiles.user_id','=','users.id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id','tenants.space_id','users.email','telephone','tenants.updated_at','tenants.created_at','users.id as user_id','balance','debit','credit','reference_number','transaction_date','invoice_id','sub_categories.name as sub_cat'])
          ->where(['properties.provider_id'=>$p_id])->get();

          }else{
            $p_id=Auth::User()->getProvider->id;
        $models=TenantPayment::join('tenants','tenants.id','=','tenant_payments.tenant_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('spaces','tenants.space_id','=','spaces.id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->join('profiles','profiles.user_id','=','users.id')
           ->join('sub_categories','sub_categories.id','=','properties.subcategory_id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id','tenants.space_id','users.email','telephone','tenants.updated_at','tenants.created_at','users.id as user_id','balance','debit','credit','reference_number','transaction_date','invoice_id','sub_categories.name as sub_cat'])
          ->where(['properties.provider_id'=>$p_id,'tenant_id'=>$tenant_id])->get();
          }
        

         

            
                $arr =array();
                foreach($models as $model) {
                    $name=$model->name;
                    $invoice=Invoice::find($model->invoice_id);
                     if($invoice){
                      $invoice_number=$invoice->invoice_number;
                     }else{
                       $invoice_number="Not Set";
                     }
                    $date=date('dS M,Y',strtotime($model->transaction_date));
                      
                    $make=$model->make;
                    $modeld=$model->model;
                    $type=$model->number;
                    $sub_cat=$model->sub_cat;
                    $ref_no=$model->reference_number;
                    $status=$model->status;
                    $credit=$model->credit;
                    $debit=$model->debit;
                    $balance=$model->balance;
                    $amount=($model->credit>0)? $model->credit:$model->debit;
                    $date_created=date('dS M,Y  H:i:s',strtotime($model->created_at));
                    


                    
                     //$number=$model->getStats($employee->id,"all");
                    $data =  array($invoice_number,$name,$date,$type,$sub_cat,$ref_no,$credit,$debit,$balance,$date_created);
                    array_push($arr, $data);
                    }
               $sheet->fromArray($arr,null,'A2',false,false)->prependRow(array(
                        'Invoice Number','Tenant Name','Transaction ','Unit','Unit Type','Ref Number','Credit','Debit','Balance','Date Entered'
                    )
                );
                
                $sheet->row(1,function($row){
                    $row->setFont(array(
                        'family'     => 'Calibri',
                        'bold'       =>  true
                    ));});

                $sheet->setOrientation($oreintation);
                 });

        })->export("xls");

    }


    public function getTenantsPDF(){
       if(Entrust::hasRole("Provider")){
          $p_id=Auth::User()->getProvider->id;
        
      PDF:: SetTopMargin (20);
      PDF::SetTitle('Tenants List');
      PDF::setPageOrientation("l");
      PDF::SetCreator(PDF_CREATOR);
      PDF::SetAlpha(1);
      PDF::SetAuthor('Isanya Hillary');
      PDF::Write(0,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------", '', 0, 'L', true, 0, false, false, 0);
      PDF::SetTitle(Auth::user()->getprovider->name);
      PDF::SetSubject('Enterprise');
      PDF::SetKeywords('TCPDF, PDF, example, test, guide');
       $properties=Property::where(['provider_id'=>Auth::user()->getprovider->id])->get();
      foreach($properties as $property):
         $models=Tenant::join('spaces','spaces.id','=','tenants.space_id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->join('deposits','tenants.id','=','deposits.tenant_id')
          ->where(['properties.provider_id'=>$p_id,'current_status'=>'Active','properties.id'=>$property->id])->take(350)->get();
      PDF::AddPage();
      // set default monospaced font
      PDF::Image('http://localhost/kenya/public/uploads/c.png', 135, 12, 20, 20, '', '', '', true, 72);
      $htm2="<h1 style='margin-bottom:0.7%;''></h2>";
      PDF::writeHTML($htm2, true, false, true, false, '');
      PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      PDF::SetAlpha(1);
      PDF::SetFont('times', '', 14);
      PDF::Ln();
      PDF::Write(0,Auth::user()->getprovider->name, '', 0, 'C', true, 0, false, false, 0);
      PDF::SetFont('times', 9);
      PDF::Write(0," Box ".Auth::User()->getProvider->postal_address.",".Auth::user()->getProvider->town, '', 0, 'C', true, 0, false, false, 0);
      PDF::Write(0,"Telephone: ".Auth::user()->getProvider->telephone, '', 0, 'C', true, 0, false, false, 0);
      
      
    PDF::Write(0,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------", '', 0, 'L', true, 0, false, false, 0);
    PDF::SetFont('times', 15);
      PDF::SetFont('times', 15);
      $html="<label style='margin-left:70%;'>Tenants  Payment For :<b> <i>".$property->title."</b>(".$property->subcategory->name.")</i></label>";
      PDF::writeHTML($html, true, false, true ,false, '');


      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::Ln();

$html ="
<style>table{border-radius:4px;border:1px solid green;}table td{text-align:left} table th #m{border-left:1px solid black;}table td #m{border-left:1px solid black;} th{text-align:left;background-color:#F2F2F2;font-weight:bold;font-size:14pts;border-bottom:1px solid black;border-right:1px solid black;}td{background-color:white;border-bottom:1px solid black}</style><table><thead>
  <tr><th>ID</th><th colspan='2'>Name</th><th>Unit</th><th>L-Start Date</th><th>L-End Date</th><th>M-Charge</th>";
   $html.="                                       
  <th>Bal</th>                                                                     
  </tr>
  </thead>
  <tbody>";
  $i=1;
  foreach ($models  as $key):
$name=$key->user->name;
$balanceModel=TenantPayment::where(['tenant_id'=>$key->tenant_id,'space_id'=>$key->space->id])->latest('id')->first();
$totals=TenantCharges::where('tenant_id',$key->tenant_id)->where('charge_name','!=','Deposit')->sum('amount');
      if($balanceModel){
                  $balance=$balanceModel->balance;
                }else{
                  $balance=0;
                }
               
$html.=
 
  "
  <tr>
  <td >".$i."</td>
  <td colspan='2'>".$name."</td>
  
  <td>".$key->space->number." </td>
    <td>".$key->entry_date." </td>
    <td>".$key->expected_end_date." </td>
     <td>".$totals."</td>
     <td>".$balance."</td>
     

  </tr> ";
 $i++;
  endforeach; 

  $html .=
  "</tbody> 
</table>";

// output the HTML content
PDF::writeHTML($html, true, false, true, false, '');
      PDF::Ln();

      $html="<label style='margin-left:70%;'><i><b><u>Keys</u> </b> </i> </label>";
  PDF::writeHTML($html, true, false, true ,false, '');

$html="<label style='margin-left:70%;'><i>M-Charge:  </i>Monthly Charges-Deposit </label>";
PDF::writeHTML($html, true, false, true ,false, '');

$html="<label style='margin-left:70%;'><i>Bal:  </i>Outstand Balance </label>";
PDF::writeHTML($html, true, false, true ,false, '');

$html="<label style='margin-left:70%;'><i>L-Start Date:  </i>Lease Start date</label>";
PDF::writeHTML($html, true, false, true ,false, '');

$html="<label style='margin-left:70%;'><i>L-End Date:  </i>Lease End date</label>";
PDF::writeHTML($html, true, false, true ,false, '');

      endforeach;

      
     
      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::Ln();
     PDF::ln();
      PDF::Output('tenants_charges.pdf');
           


       }else{
        return view('forbidden');
       }
    }


    public function getTenantsExcel($format){
      if(Entrust::hasRole("Provider")){

        $oreintation="landscape";
         Excel::create('records', function($excel) use($oreintation,$format) {
          $excel->sheet('Sheet1', function($sheet) use($oreintation,$format) {
         
            $p_id=Auth::User()->getProvider->id;
           $models=Tenant::join('spaces','spaces.id','=','tenants.space_id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->join('deposits','tenants.id','=','deposits.tenant_id')
          ->where(['properties.provider_id'=>$p_id,'current_status'=>'Active'])->take(15000)->get();

                $arr =array();
                foreach($models as $key) {
                    $name=$key->user->name;
                    $phone=$key->user->profile->telephone;
                    $id_number=$key->user->profile->id_number;
                    $balanceModel=TenantPayment::where(['tenant_id'=>$key->tenant_id,'space_id'=>$key->space->id])->latest('id')->first();
                   $totals=TenantCharges::where('tenant_id',$key->tenant_id)->where('charge_name','!=','Deposit')->sum('amount');
               if($balanceModel){
                  $balance=$balanceModel->balance;
                }else{
                  $balance=0;
                }
                $unit=$key->space->number;
                $title=$key->space->property->title;
                $email=$key->user->email;
                $data =array($name,$email,$id_number,$phone,$unit,$title,$totals,$balance);
                    array_push($arr, $data);
                    }
               $sheet->fromArray($arr,null,'A2',false,false)->prependRow(array(
                       'Tenant Name','Email','id Number','Telephone','Unit','Unit Type','Monthly Charges','Balance'
                    )
                );
                
                $sheet->row(1,function($row){
                    $row->setFont(array(
                        'family'     => 'Calibri',
                        'bold'       =>  true
                    ));});

                $sheet->setOrientation($oreintation);
                 });

        })->export($format);


      }else{
        return view('forbidden');
      }
    }


    public function getConactPDF(){
    if(Entrust::hasRole("Provider")){

       $p_id=Auth::User()->getProvider->id;
         
      PDF:: SetTopMargin (20);
      PDF::SetTitle('Tenants List');
      PDF::setPageOrientation("l");
      PDF::SetCreator(PDF_CREATOR);
      PDF::SetAlpha(1);
      PDF::SetAuthor('Isanya Hillary');
      PDF::Write(0,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------", '', 0, 'L', true, 0, false, false, 0);
      PDF::SetTitle(Auth::user()->getprovider->name);
      PDF::SetSubject('Enterprise');
      PDF::SetKeywords('TCPDF, PDF, example, test, guide');
      $properties=Property::where(['provider_id'=>Auth::user()->getprovider->id])->get();
      foreach($properties as $property):

        $id=Auth::User()->getProvider->id;
        $models=Tenant::join('emergency_contacts','tenants.id','=','emergency_contacts.tenant_id')
             ->join('spaces','spaces.id','=','tenants.space_id')
             ->join('properties','properties.id','=','spaces.property_id')
             ->join('users','users.id','=','tenants.user_id')
             ->select(['emergency_contacts.id','users.name','emergency_contacts.name as cname','properties.title','spaces.number','emergency_contacts.email as cemail','emergency_contacts.phone','properties.id as P_id','tenants.id as tenant_id','phone as cphone','emergency_contacts.postal_address as caddress'])
             ->where('tenants.current_status','=','Active')
             ->where('properties.id',$property->id)
             ->where('tenants.provider_id','=',$id)->take(150)->get();
              
              
      PDF::AddPage();
      // set default monospaced font
      PDF::Image('http://localhost/kenya/public/uploads/c.png', 135, 12, 20, 20, '', '', '', true, 72);
      $htm2="<h1 style='margin-bottom:0.7%;''></h2>";
      PDF::writeHTML($htm2, true, false, true, false, '');
      PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      PDF::SetAlpha(1);
      PDF::SetFont('times', '', 14);
      PDF::Ln();
      PDF::Write(0,Auth::user()->getprovider->name, '', 0, 'C', true, 0, false, false, 0);
      PDF::SetFont('times', 9);
      PDF::Write(0," Box ".Auth::User()->getProvider->postal_address.",".Auth::user()->getProvider->town, '', 0, 'C', true, 0, false, false, 0);
      PDF::Write(0,"Telephone: ".Auth::user()->getProvider->telephone, '', 0, 'C', true, 0, false, false, 0);
      PDF::Ln();
      PDF::SetFont('times', 15);
      $html="<label style='margin-left:20%;'><b>Property </b>:<i>".$property->title."</i>
      </label>";
      PDF::writeHTML($html, true, false, true ,false, '');


      PDF::SetFont('times', '', 11);
      PDF::Ln();
    

$html ="
<style>table{border-radius:4px;border:1px solid green;}table td{text-align:left} table th #m{border-left:1px solid black;}table td #m{border-left:1px solid black;} th{text-align:left;background-color:#F2F2F2;font-weight:bold;font-size:14pts;border-bottom:1px solid black;border-right:1px solid black;}td{background-color:white;border-bottom:1px solid black}</style><table><thead>
  <tr><th>ID</th><th colspan='2'>Tenant</th><th>Unit</th><th>C-Name</th><th>C-Email</th><th>C-Mobile</th>";
   $html.="                                       
  <th>C-Address</th>                                                                     
  </tr>
  </thead>
  <tbody>";
  $i=1;
  foreach ($models  as $key):
  $html.="
  <tr>
  <td >".$i."</td>
  <td colspan='2'>".$key->name."</td>
  <td>".$key->number."    </td>
  <td>".$key->cname." </td>
  <td>".$key->cemail." </td>
  <td>".$key->cphone."</td>
  <td>".$key->caddress."</td>
     

  </tr> ";
 $i++;
  endforeach; 

  $html .=
  "</tbody> 
</table>";

// output the HTML content
PDF::writeHTML($html, true, false, true, false, '');
      PDF::Ln();

  endforeach;
$html="<label style='margin-left:70%;'><i><b>Keys </b> </i> </label>";
  PDF::writeHTML($html, true, false, true ,false, '');
$html="<label style='margin-left:70%;'><i>M-Charge:  </i>Monthly Charges-Deposit </label>";
PDF::writeHTML($html, true, false, true ,false, '');

$html="<label style='margin-left:70%;'><i>Bal:  </i>Outstand Balance </label>";
PDF::writeHTML($html, true, false, true ,false, '');
      PDF::SetFont('times', 13);
     
      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::Ln();
     PDF::ln();
      PDF::Output('tenants_charges.pdf');

      }else{
        return view('forbidden');
      }

    }


    public function getLeaseExpiry(){
      $status=$_GET['status'];
       $p_id=Auth::User()->getProvider->id;
         
      PDF:: SetTopMargin (20);
      PDF::SetTitle('Tenants List');
      PDF::setPageOrientation("l");
      PDF::SetCreator(PDF_CREATOR);
      PDF::SetAlpha(1);
      PDF::SetAuthor('Isanya Hillary');
      PDF::Write(0,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------", '', 0, 'L', true, 0, false, false, 0);
      PDF::SetTitle(Auth::user()->getprovider->name);
      PDF::SetSubject('Enterprise');
      PDF::SetKeywords('TCPDF, PDF, example, test, guide');
      $properties=Property::where(['provider_id'=>Auth::user()->getprovider->id])->get();
      foreach($properties as $property):

        $id=Auth::User()->getProvider->id;
        
  
      $models=$this->getLeases($status,$property->id);
              
              
      PDF::AddPage();
      // set default monospaced font
      PDF::Image('http://localhost/kenya/public/uploads/c.png', 135, 12, 20, 20, '', '', '', true, 72);
      $htm2="<h1 style='margin-bottom:0.7%;''></h2>";
      PDF::writeHTML($htm2, true, false, true, false, '');
      PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      PDF::SetAlpha(1);
      PDF::SetFont('times', '', 14);
      PDF::Ln();
      PDF::Write(0,Auth::user()->getprovider->name, '', 0, 'C', true, 0, false, false, 0);
      PDF::SetFont('times', 9);
      PDF::Write(0," Box ".Auth::User()->getProvider->postal_address.",".Auth::user()->getProvider->town, '', 0, 'C', true, 0, false, false, 0);
      PDF::Write(0,"Telephone: ".Auth::user()->getProvider->telephone, '', 0, 'C', true, 0, false, false, 0);
      PDF::Ln();
      PDF::SetFont('times', 15);
      $html="<label style='margin-left:20%;'><b>".$property->title." </b>Lease Expirations </i>
      </label>";
      PDF::writeHTML($html, true, false, true ,false, '');


      PDF::SetFont('times', '', 11);
      PDF::Ln();
    

$html ="
<style>table{border-radius:4px;border:1px solid green;}table td{text-align:left} table th #m{border-left:1px solid black;}table td #m{border-left:1px solid black;} th{text-align:left;background-color:#F2F2F2;font-weight:bold;font-size:14pts;border-bottom:1px solid black;border-right:1px solid black;}td{background-color:white;border-bottom:1px solid black}</style><table><thead>
  <tr><th>ID</th><th colspan='2'>Tenant</th><th>Unit</th><th>Lease Start Date</th><th>Lease End Date</th><th>Status</th>";
   $html.="                                       
  <th>Balance</th>                                                                     
  </tr>
  </thead>
  <tbody>";
  $i=1;
  foreach ($models  as $key):

  $html.="
  <tr>
  <td >".$i."</td>
  <td colspan='2'>".$key->name."</td>
  <td>".$key->number."    </td>
  <td>".$key->entry_date." </td>
  <td>".$key->expected_end_date." </td>
  <td>".$key->current_status."</td>
  <td>".$key->current_status."</td>
     

  </tr> ";
 $i++;
  endforeach; 

  $html .=
  "</tbody> 
</table>";

// output the HTML content
PDF::writeHTML($html, true, false, true, false, '');
      PDF::Ln();

  endforeach;
$html="<label style='margin-left:70%;'><i><b>Keys </b> </i> </label>";
  PDF::writeHTML($html, true, false, true ,false, '');
$html="<label style='margin-left:70%;'><i>M-Charge:  </i>Monthly Charges-Deposit </label>";
PDF::writeHTML($html, true, false, true ,false, '');

$html="<label style='margin-left:70%;'><i>Bal:  </i>Outstand Balance </label>";
PDF::writeHTML($html, true, false, true ,false, '');
      PDF::SetFont('times', 13);
     
      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::Ln();
     PDF::ln();
      PDF::Output('tenants_charges.pdf');



      
      


      
    }


    public  function propertReports($id){
      $model=Property::find($id);

       PDF:: SetTopMargin (20);
      PDF::SetTitle('Tenants List');
      PDF::setPageOrientation("l");
      PDF::SetCreator(PDF_CREATOR);
      PDF::SetAlpha(1);
      PDF::SetAuthor('Isanya Hillary');
      PDF::Write(0,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------", '', 0, 'L', true, 0, false, false, 0);
      PDF::SetTitle(Auth::user()->getprovider->name);
      PDF::SetSubject('Enterprise');
      PDF::SetKeywords('TCPDF, PDF, example, test, guide');
      PDF::AddPage();
      // set default monospaced font
      PDF::Image('http://localhost/kenya/public/uploads/c.png', 135, 12, 20, 20, '', '', '', true, 72);
      $htm2="<h1 style='margin-bottom:0.7%;''></h2>";
      PDF::writeHTML($htm2, true, false, true, false, '');
      PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      PDF::SetAlpha(1);
      PDF::SetFont('times', '', 14);
      PDF::Ln();
      PDF::Write(0,Auth::user()->getprovider->name, '', 0, 'C', true, 0, false, false, 0);
      PDF::SetFont('times', 9);
      PDF::Write(0," Box ".Auth::User()->getProvider->postal_address.",".Auth::user()->getProvider->town, '', 0, 'C', true, 0, false, false, 0);
      PDF::Write(0,"Telephone: ".Auth::user()->getProvider->telephone, '', 0, 'C', true, 0, false, false, 0);
      PDF::Ln();
      PDF::SetFont('times', 15);
      PDF::SetFont('times', '', 13);
      PDF::Ln();

      $html="<label style='margin-left:70%;'><i><b>".$model->title." </b> </i> </label>";
      PDF::writeHTML($html, true, false, true ,false, '');


       PDF::SetFont('times', '', 11);
       PDF::Ln();
       $html="<label style='margin-left:70%;'><i><b><u> Property Information </u></b> </i> </label>";
       PDF::writeHTML($html, true, false, true ,false, '');



 
$html="<label style='margin-left:70%;'><i><b>Keys </b> </i> </label>";
  PDF::writeHTML($html, true, false, true ,false, '');
$html="<label style='margin-left:70%;'><i>M-Charge:  </i>Monthly Charges-Deposit </label>";
PDF::writeHTML($html, true, false, true ,false, '');

$html="<label style='margin-left:70%;'><i>Bal:  </i>Outstand Balance </label>";
PDF::writeHTML($html, true, false, true ,false, '');
      PDF::SetFont('times', 13);
     
      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::Ln();
     PDF::ln();
      PDF::Output('tenants_charges.pdf');



    }

    public function getLeases($status,$property_id){
      if($status=="All"){
        $p_id=Auth::User()->getProvider->id;
        $bookings=Tenant::join('spaces','spaces.id','=','tenants.space_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id'])
          ->where('properties.id',$property_id)
          ->where(['properties.provider_id'=>$p_id,'current_status'=>'Active'])
          ->take(150)
          ->get();

      }else{
          if($status=="monthly"){
             $p_id=Auth::User()->getProvider->id;
             $year=date('Y');
             $month=date('m');
        $bookings=Tenant::join('spaces','spaces.id','=','tenants.space_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id'])
          ->where(['properties.provider_id'=>$p_id])
          ->whereYear('expected_end_date','=',$year)
          ->where('properties.id',$property_id)
          ->whereMonth('expected_end_date','=',$month)
          ->take(150)
          ->get();

          }elseif($status=="year"){
            $p_id=Auth::User()->getProvider->id;
             $year=date('Y');
             $month=date('m');
            $bookings=Tenant::join('spaces','spaces.id','=','tenants.space_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id'])
          ->where(['properties.provider_id'=>$p_id])
           ->where('properties.id',$property_id)
          ->whereYear('expected_end_date','=',$year)
          ->take(150)
          ->get();
          }else{
            $p_id=Auth::User()->getProvider->id;
             $year=date('Y');
             $month=date('m');
        $bookings=Tenant::join('spaces','spaces.id','=','tenants.space_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id'])
          ->where(['properties.provider_id'=>$p_id,'current_status'=>$status])
           ->where('properties.id',$property_id)
           ->take(150)
          ->get();
          }
       
      }

      return $bookings;

    }


    public function getSpacesPDF()
    {
      if(Entrust::hasRole("Provider")){
         $p_id=Auth::User()->getProvider->id;
        $path=Storage::url("logo4.jpeg") ;
        $destinationPath = base_path();
        $path=$destinationPath.$path;
         
      PDF:: SetTopMargin (20);
      PDF::SetTitle('Tenants List');
      PDF::setPageOrientation("l");
      PDF::SetCreator(PDF_CREATOR);
      PDF::SetAlpha(1);
      PDF::SetAuthor('Isanya Hillary');
      PDF::Write(0,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------", '', 0, 'L', true, 0, false, false, 0);
      PDF::SetTitle(Auth::user()->getprovider->name);
      PDF::SetSubject('Enterprise');
      PDF::SetKeywords('TCPDF, PDF, example, test, guide');
      $properties=Property::where(['provider_id'=>Auth::user()->getprovider->id])->get();
      foreach($properties as $property):

        $id=Auth::User()->getProvider->id;

        
  
      $models=Space::join('properties','properties.id','=','spaces.property_id')->where(['provider_id'=>$id,'property_id'=>$property->id])
      ->select(['spaces.title','spaces.number','spaces.unit_price','spaces.status','spaces.id'])
      ->get();
              
              
      PDF::AddPage();
      // set default monospaced font
      PDF::Image($path, 130, 12, 45, 45, '', '', '', true, 72);
      $htm2="<h1 style='margin-bottom:2.0%;''></h2>";
      PDF::writeHTML($htm2, true, false, true, false, '');
      PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      PDF::SetAlpha(1);
      PDF::SetFont('times', '', 14);
      PDF::Ln();
      PDF::Ln();
      PDF::Ln();
       PDF::Ln();
        PDF::Ln();
      PDF::Write(0,Auth::user()->getprovider->name, '', 0, 'C', true, 0, false, false, 0);
      PDF::SetFont('times', 9);
      PDF::Write(0," Box ".Auth::User()->getProvider->postal_address.",".Auth::user()->getProvider->town, '', 0, 'C', true, 0, false, false, 0);
      PDF::Write(0,"Telephone: ".Auth::user()->getProvider->telephone, '', 0, 'C', true, 0, false, false, 0);
      PDF::Ln();
      PDF::SetFont('times', 15);
      $html="<label style='margin-left:20%;'><b>".$property->title." : </b>Space/Unit Reports </i>
      </label>";
      PDF::writeHTML($html, true, false, true ,false, '');


      PDF::SetFont('times', '', 11);
      PDF::Ln();
    

$html ="
<style>table{border-radius:4px;border:1px solid green;}table td{text-align:left} table th #m{border-left:1px solid black;}table td #m{border-left:1px solid black;} th{text-align:left;background-color:#F2F2F2;font-weight:bold;font-size:14pts;border-bottom:1px solid black;border-right:1px solid black;}td{background-color:white;border-bottom:1px solid black}</style><table><thead>
  <tr><th>ID</th><th colspan='2'>Name</th><th>Number</th><th>Monthly Rate</th><th>Status</th><th>No of Repairs</th>";
   $html.="                                       
  <th>No of Tenants</th>                                                                     
  </tr>
  </thead>
  <tbody>";
  $i=1;
  foreach ($models  as $key):
    $tenants=Tenant::where(['space_id'=>$key->id])->count();
  $reapir=Repair::where(['space_id'=>$key->id])->count();

  $html.="
  <tr>
  <td >".$i."</td>
  <td colspan='2'>".$key->title."</td>
  <td>".$key->number."    </td>
  <td>".$key->unit_price." </td>
  <td>".$key->status." </td>
  <td>".$reapir."</td>
  <td>".$key->tenants->count()."</td>
     

  </tr> ";
 $i++;
  endforeach; 

  $html .=
  "</tbody> 
</table>";

// output the HTML content
PDF::writeHTML($html, true, false, true, false, '');
      
      PDF::Ln();
      $html="<label style='margin-left:70%;'><i><b><u>Summary</u> </b> </i> </label>";
  PDF::writeHTML($html, true, false, true ,false, '');
$html="<label style='margin-left:70%;'>Empty Spaces: ".$key->where(['status'=>'Free','property_id'=>$property->id])->count()." </label>";
PDF::writeHTML($html, true, false, true ,false, '');

$html="<label style='margin-left:70%;'>Occupied Spaces: ".$key->where(['status'=>'Occupied','property_id'=>$property->id])->count()." </label>";
PDF::writeHTML($html, true, false, true ,false, '');

$html="<label style='margin-left:70%;'>On Notice Spaces: ".$key->where(['status'=>'OnNotice','property_id'=>$property->id])->count()." </label>";
PDF::writeHTML($html, true, false, true ,false, '');


$html="<label style='margin-left:70%;'>Total Spaces: ".$key->where(['property_id'=>$property->id])->count()." </label>";
PDF::writeHTML($html, true, false, true ,false, '');

PDF::Ln();
      PDF::Cell(0, 12, 'Page '.PDF::getAliasNumPage().' of '.PDF::getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

  endforeach;

      PDF::SetFont('times', 13);
     
      PDF::SetFont('times', '', 11);
     
      PDF::SetFont('times', '', 11);
      
      PDF::Output('spaces_reports.pdf');
      }else{

        return view("forbidden");
      }
    }


    public function getSpacesOtherFormats($format){
      
       if(Entrust::hasRole("Provider")){

        $oreintation="landscape";
         Excel::create('records', function($excel) use($oreintation,$format) {
          $excel->sheet('Sheet1', function($sheet) use($oreintation,$format) {
         
            $p_id=Auth::User()->getProvider->id;
            $models=Space::join('properties','properties.id','=','spaces.property_id')
       ->select(['spaces.title as space_name','spaces.number','spaces.unit_price','spaces.status','spaces.id','properties.title'])
       ->where(['properties.provider_id'=>$p_id])
       ->get();
                $arr =array();
                foreach($models as $key) {
                  $name=$key->space_name;
                  $tenants=Tenant::where(['space_id'=>$key->id])->count();
                  $reapir=Repair::where(['space_id'=>$key->id])->count();
                  $data =array($key->title,$name,$key->number,$key->status,$key->unit_price,$reapir,$tenants);
                    array_push($arr, $data);
                    }
               $sheet->fromArray($arr,null,'A2',false,false)->prependRow(array(
                       'Property','Name','Number','Status','Monthly Charges','No of Repairs','No of Tenants'
                    )
                );
                
                $sheet->row(1,function($row){
                    $row->setFont(array(
                        'family'     => 'Calibri',
                        'bold'       =>  true
                    ));});

                $sheet->setOrientation($oreintation);
                 });

        })->export($format);


      }else{
        return view('forbidden');
      }
}

public function getPlotOtherFormats($format){

  if(Entrust::hasRole("Provider")){

        $oreintation="landscape";
         Excel::create('records', function($excel) use($oreintation,$format) {
          $excel->sheet('Sheet1', function($sheet) use($oreintation,$format) {
         
            $p_id=Auth::User()->getProvider->id;
            $models=Plot::where(['provider_id'=>$p_id])->get();
              $arr =array();
                foreach($models as $key) {
                  
                  
                  $data =array($key->name,$key->area,$key->city,$key->state,$key->country,$key->plot_size,$key->plot_price,$key->plot_status,$key->contact_phone,$key->contact_email,$key->contact_phone_two,$key->contact_email_two);
                    array_push($arr, $data);
                    }
               $sheet->fromArray($arr,null,'A2',false,false)->prependRow(array(
                       'Name','Area','City','State/County','Country','Size','Selling Price','Status','Contact Phone','Contact Email','Alt Phone','Alt Email'
                    )
                );
                
                $sheet->row(1,function($row){
                    $row->setFont(array(
                        'family'     => 'Calibri',
                        'bold'       =>  true
                    ));});

                $sheet->setOrientation($oreintation);
                 });

        })->export($format);


      }else{
        return view('forbidden');
      }

}

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('backend::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('backend::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('backend::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function printInvoice($id){

      
        
       $model=Invoice::find($id);

       PDF:: SetTopMargin (20);
      PDF::SetTitle('Invice');
      PDF::setPageOrientation("l");
      PDF::SetCreator(PDF_CREATOR);
      PDF::SetAlpha(1);
      PDF::SetAuthor('Isanya Hillary');
      PDF::Write(0,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------", '', 0, 'L', true, 0, false, false, 0);
      PDF::SetTitle(Auth::user()->getprovider->name);
      PDF::SetSubject('Enterprise');
      PDF::SetKeywords('TCPDF, PDF, example, test, guide');
      PDF::AddPage();
      // set default monospaced font
      PDF::Image('http://localhost/kenya/public/uploads/c.png', 135, 12, 20, 20, '', '', '', true, 72);
      $htm2="<h1 style='margin-bottom:0.7%;''></h2>";
      PDF::writeHTML($htm2, true, false, true, false, '');
      PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      PDF::SetAlpha(1);
      PDF::SetFont('times', '', 14);
      PDF::Ln();
      PDF::Write(0,Auth::user()->getprovider->name."                                                                                                                                  INVOICE NO:".$model->invoice_number, '', 0, 'l', true, 0, false, false, 0);

      PDF::SetFont('times', 9);
    PDF::Write(0," Box ".Auth::User()->getProvider->postal_address.",\n".Auth::user()->getProvider->town."                                                                                                                                                               Date: ".date('F d,Y',strtotime($model->issue_date)), '', 0, 'l', true, 0, false, false, 0);
    PDF::Write(0,"Telephone: ".Auth::user()->getProvider->telephone."                                                                                                                              Date Due: ".date('F d,Y',strtotime($model->due_date)), '', 0, 'l', true, 0, false, false, 0);

      PDF::Ln();
      PDF::SetFont('times', 15);
      PDF::SetFont('times', '', 13);
      PDF::Ln();



      $html="<style> label #kid:margin-left:50%;</style><label id='kid'><i><b>Issued To:  </b> </i> </label>";
      PDF::writeHTML($html, true, false, true ,false, '');
    PDF::Write(0,$model->user->name, '10', 0, 'l', true, 0, false, false, 0);
     PDF::Write(7,$model->user->email, '10', 0, 'l', true, 0, false, false, 0);
     PDF::Write(7,$model->user->profile->telephone, '10', 0, 'l', true, 0,false, false, 0);
     PDF::Write(7,$model->user->profile->postal_address, '10', 0, 'l', true, 0, false, false, 0);





       PDF::SetFont('times', '', 11);
       PDF::Ln();
       $html="<label style='margin-left:70%;'><i><b><u> Property Information </u></b> </i> </label>";
       PDF::writeHTML($html, true, false, true ,false, '');



 
$html="<label style='margin-left:70%;'><i><b>Keys </b> </i> </label>";
  PDF::writeHTML($html, true, false, true ,false, '');
$html="<label style='margin-left:70%;'><i>M-Charge:  </i>Monthly Charges-Deposit </label>";
PDF::writeHTML($html, true, false, true ,false, '');

$html="<label style='margin-left:70%;'><i>Bal:  </i>Outstand Balance </label>";
PDF::writeHTML($html, true, false, true ,false, '');
      PDF::SetFont('times', 13);
     
      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::Ln();
     PDF::ln();
      PDF::Output('tenants_charges.pdf');

    }


    
}
