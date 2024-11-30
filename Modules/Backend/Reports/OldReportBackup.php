<?php

namespace Modules\Backend\Reports;

use Illuminate\Database\Eloquent\Model;
use App\Mymodel;
use PDF;
use Auth;
use Modules\Backend\Entities\Property;
use Modules\Backend\Entities\PropertyExpense;
use Modules\Backend\Entities\PropertyTransaction;
class MonthlySummary
{
    public static function generate($models,$data)
    {
    	
         $provider=Auth::user()->getProvider;
         $property=Property::find($data['property_id'])->first();
         

    	 PDF:: SetTopMargin (5);
           PDF::setPageOrientation("p");
           PDF::SetTitle("Invitation ");
           PDF::SetSubject('Enterprise');
           PDF::SetKeywords('TCPDF, PDF, example, test, guide');
           PDF::AddPage();
            PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        PDF::SetAlpha(1);
        PDF::SetFont('times', '', 10);
        $path=\Storage::url("logo2.png") ;
        $path2=\Storage::url("icta.jpeg") ;
        $tick=\Storage::url("tick.png") ;
    $destinationPath = base_path();
    $path=$destinationPath.$path;
    $path2=$destinationPath.$path2;
    $tick=$destinationPath.$tick;
     //dd($path);
      
        $html='
        <table width="100%" cellspacing="0" cellpadding="5%">
        <tr>
        <td align="left" valign="middle"
        width="98%">

         <table width="100%" cellspacing="0" cellpadding="5%">
        <tr>
        <td align="center" valign="middle"
        width="100%"><img src="'.$path.'"  width="100" height="40"></td>
        </tr>
        <tr>
        <td align="center" valign="middle"
        width="100%">'.$provider->name.',</td>
        </tr>
        <tr>
        <td align="center" valign="middle"
        width="100%"> Box '.$provider->postal_address.',</td>
        </tr>
         <tr>
        <td align="center" valign="middle"
        width="100%">'.$provider->town.'.</td>
        </tr>
         <tr>
        <td align="center" valign="middle"
        width="100%"> Mobile '.$provider->telephone.'</td>
        </tr>

        
        

        </table>
         </td>
        
    </tr></table>';
        PDF::writeHTML($html, true, false, true ,false, '');
        PDF::Ln();


          PDF::Write(0,ucwords($property->title)."-".$data['month'].','.$data['year'], '', 0, 'L', true, 0, false, false, 0);
PDF::Ln(); 

        $html="


        <style>table{border-radius:4px;border:1px solid black;}table td{text-align:left} table th #m{border-left:1px solid black;}table td #m{border-left:1px solid black;} 
        
        th{text-align:left;background-color:rgb(85,216,230);font-weight:normal;border-bottom:1px solid black;border-right:1px solid black;}
        #myhead{text-align:left;background-color:rgb(173,216,230);font-weight:bold;font-size:13.5pts;border-bottom:1px solid black;border-right:1px solid black;}

        td{background-color:white;border-bottom:1px solid black}</style>
        <table width='100%' cellspacing='0' cellpadding='5%'>
        <thead>
        <tr id='myhead'>
        <th width='10%' cellspacing='0' cellpadding='5%' ><b>Unit</b></th>
        <th width='10%' cellspacing='0' cellpadding='5%' ><b>Bal/BF</b></th>
        <th width='10%' cellspacing='0' cellpadding='5%' ><b>Invoiced</b></th>
        <th width='10%' cellspacing='0' cellpadding='5%' ><b>TotalBalance</b></th>
        <th width='10%' cellspacing='0' cellpadding='5%' ><b>Paid</b></th>
        <th width='10%' cellspacing='0' cellpadding='5%' ><b>Bal/CF</b></th>
    
        <th width='10%' cellspacing='0' cellpadding='5%' ><b>Remarks</b></th>

        ";


        $html.="
        </tr>
        </thead>
        <tbody>
        </tbody>
        ";
        $i=1;
        foreach($models  as $model):

              $a=$i;
         $b=2;
         $c=$a % $b;
         if($model->remarks=="Excess")
         {
            $rem="Overpaid";
         }else if($model->remarks=="Less")
         {
            $rem="Has Balance";
         }else{
            $rem="-";
         }
         $bal=($model->bal_carried_foward>0)?"-".$model->bal_carried_foward:abs($model->bal_carried_foward);

         
            $html.="<tr>

            <td>".$model->space->number."</td>
            <td>".number_format($model->bal_brought_forward)."</td>
            <td align='center'>".number_format($model->invoice_amount)."</td>
            <td >".number_format($model->outstanding_balance)."</td>
            <td>".number_format($model->amount_paid)."</td>
            <td>".number_format($bal)."</td>
            
            <td>".$rem."</td>
            
          </tr>";


        $i++;
        endforeach;
        for($i=1;$i<=4;$i++):

              $html.="<tr>

            <td></td>
            <td></td>
            <td align='center'></td>
            <td ></td>
            <td></td>
            <td></td>
            
            <td></td>
            
          </tr>";



        endfor;
            



        $sum_bal_forward=$models->sum('bal_brought_forward');
        $sum_invoiced=$models->sum('invoice_amount');
        $sum_balance=$models->sum('outstanding_balance');
        $sum_paid=$models->sum('amount_paid');
        $sum_carried=$models->sum('bal_carried_foward');
        $html.="
        <tr>

            <td><b>Total</b> </td>
            <td>".number_format($sum_bal_forward)."</td>
            <td align='center'>".number_format($sum_invoiced)."</td>
            <td >".number_format($sum_balance)."</td>
            <td>".number_format($sum_paid)."</td>
            <td>".number_format($sum_carried)."</td>
            
            <td>--</td>
            
          </tr>

        </table>";
        PDF::writeHTML($html, true, false, true ,false, '');

          
       
        PDF::Ln();
        PDF::Ln();
        PDF::SetLineStyle( array( 'width' =>4, 'color' => array(85,169,154)));
        PDF::Rect(0, 0, PDF::getPageWidth(), PDF::getPageHeight());
        $name="monthly_report".date('d-M-Y').".pdf";

        

        
        PDF::Ln();


        PDF::Output($name);
       $filename=$name;
       $invoiceFile=$name;
     $destinationPath = base_path() . '/storage/invoices';
    $invoice2 = $destinationPath."/".$invoiceFile; //Linux
    $fileNL = $destinationPath."/".$filename; //Linux
    PDF::Output($fileNL,'F');
    $paths=array($fileNL);
  
    $user=\Auth::user();
      $email=$user->email;

    }

    public static  function generateBreakdown($models,$data,$Advance,$property)
    {

         $provider=Auth::user()->getProvider;
         $expenses=PropertyExpense::where(['property_id'=>$property->id,'month'=>$data['month'],'year'=>$data['year']])->get();
         $other_posible=array("Advance","Loan","Monthly Remitance");
         $advances=PropertyTransaction::where(['property_id'=>$property->id,'month'=>$data['month'],'year'=>$data['year'],'is_reserved'=>0])
         ->whereIn("Description",$other_posible)
         ->get();
          


         

         

         PDF:: SetTopMargin (5);
           PDF::setPageOrientation("l");
           PDF::SetTitle("Payment");
           PDF::SetSubject('Enterprise');
           PDF::SetKeywords('TCPDF, PDF, example, test, guide');
           PDF::AddPage('l');
            PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        PDF::SetAlpha(1);
        PDF::SetFont('times', '', 10);
        $path=\Storage::url("logo2.png") ;
        $path2=\Storage::url("icta.jpeg") ;
        $tick=\Storage::url("tick.png") ;
    $destinationPath = base_path();
    $path=$destinationPath.$path;
    $path2=$destinationPath.$path2;
    $tick=$destinationPath.$tick;
     //dd($path);
      
        $html='
        <table width="100%" cellspacing="0" cellpadding="5%">
        <tr>
        <td align="left" valign="middle"
        width="98%">

         <table width="100%" cellspacing="0" cellpadding="5%">
        <tr>
        <td align="center" valign="middle"
        width="100%"><img src="'.$path.'"  width="100" height="40"></td>
        </tr>
        <tr>
        <td align="center" valign="middle"
        width="100%">'.$provider->name.',</td>
        </tr>
        <tr>
        <td align="center" valign="middle"
        width="100%"> Box '.$provider->postal_address.',</td>
        </tr>
         <tr>
        <td align="center" valign="middle"
        width="100%">'.$provider->town.'.</td>
        </tr>
         <tr>
        <td align="center" valign="middle"
        width="100%"> Mobile '.$provider->telephone.'</td>
        </tr>

        
        

        </table>
         </td>
        
    </tr></table>';
        PDF::writeHTML($html, true, false, true ,false, '');
        PDF::Ln();


          PDF::Write(0,ucwords($property->title)."-".$data['month'].','.$data['year'], '', 0, 'L', true, 0, false, false, 0);
PDF::Ln(); 

        $html="


        <style>table{border-radius:4px;border:1px solid black;}table td{text-align:left} table th #m{border-left:1px solid black;}table td #m{border-left:1px solid black;} 
        
        th{text-align:left;background-color:rgb(85,216,230);font-weight:normal;border-bottom:1px solid black;border-right:1px solid black;}
        #myhead{text-align:left;background-color:rgb(173,216,230);font-weight:bold;font-size:13.5pts;border-bottom:1px solid black;border-right:1px solid black;}

        td{background-color:white;border-bottom:1px solid black}</style>
        <table width='100%' cellspacing='0' cellpadding='5%'>
        <thead>
        <tr id='myhead'>
        <th ><b>Unit</b></th>
        <th   ><b>Status</b></th>
        <th cellspacing='0'  ><b>Pre Bal</b></th>
        <th cellspacing='0' cellpadding='5%' ><b>Invoiced</b></th>
        <th cellspacing='0' cellpadding='5%' ><b>T Bal</b></th>
        <th cellspacing='0' cellpadding='5%' ><b>Paid</b></th>
        <th  cellspacing='0' cellpadding='5%' ><b>New Bal</b></th>
    
        <th  cellspacing='0' cellpadding='5%' ><b>Deposit</b></th>
         <th  cellspacing='0' cellpadding='5%' ><b>Rent</b></th>
          <th  cellspacing='0' cellpadding='5%' ><b>Water</b></th>
         
         <th  cellspacing='0' cellpadding='5%' ><b>Garbage</b></th>
       
          <th  cellspacing='0' cellpadding='5%' ><b>Repair</b></th>
          
            <th  cellspacing='0' cellpadding='5%' ><b>Others </b></th>
            <th  cellspacing='0' cellpadding='5%' ><b>Agent </b></th>
            <th  cellspacing='0' cellpadding='5%' ><b>LA</b></th>
            <th  cellspacing='0' cellpadding='5%' ><b>DC</b></th>
            <th  cellspacing='0' cellpadding='5%' ><b>LN</b></th>
            ";


        $html.="
        </tr>
        </thead>
        <tbody>
        </tbody>
        ";
        $i=1;
        $t_prev_balance=0;
        $t_invoiced=0;
        $t_nbalance=0;
        $t_paid=0;
        $t_balance=0;
        $t_deposit=0;
        $t_rent=0;
        $t_wat=0;
        $t_ele=0;
        $t_gab=0;
        $t_rep=0;
        $t_charge=0;
        $t_agent=0;
        $t_land=0;
        $t_direct=0;
        $t_net=0;
        foreach($models  as $model):
             $t_prev_balance= $t_prev_balance+$model->pre_balance;
             $t_invoiced=$t_invoiced+$model->invoice_amount;
            $t_nbalance=$t_nbalance+$model->new_balance;
            $t_paid=$t_paid+$model->amount_paid;
            $t_balance=$t_balance+$model->balance;
            $t_deposit=$t_deposit+$model->deposit;
            $t_rent=$t_rent+$model->rent;
            $t_wat=$t_wat+$model->water_bill;
            $t_ele=$t_ele+$model->electricity_bill;
            $t_gab=$t_gab+$model->gabbage_bill;
            $t_rep=$t_rep+$model->repair_cost;
            $t_charge=$t_charge+$model->other_changes;
            $t_agent=$t_agent+$model->agent_commision;
            $t_land=$t_land+$model->landload_amount;
            $t_direct=$t_direct+$model->direct_amount;
            $t_net=$t_net+$model->net_pay;

            
         
            $html.="<tr>

            <td>".$model->number."</td>
            <td>".$model->space_status."</td>
            <td align='center'>".number_format($model->pre_balance)."</td>
            <td >".number_format($model->invoice_amount)."</td>
            <td>".number_format($model->new_balance)."</td>
            <td>".number_format($model->amount_paid)."</td>
            
            
            <td>".$model->balance."</td>
            <td>".$model->deposit."</td>
            <td>".$model->rent."</td>
             <td>".$model->water_bill."</td>
            
              <td>".$model->gabbage_bill."</td>
              <td>".$model->repair_cost."</td>
              

              <td>".$model->other_changes."</td>
              <td>".$model->agent_commision."</td>
              <td>".$model->landload_amount."</td>
              <td>".$model->direct_amount."</td>
              <td>".$model->net_pay."</td>
           
            
          </tr>";


        $i++;
        endforeach;
        for($i=1;$i<=4;$i++):

              $html.="<tr>

            <td></td>
            <td></td>
            <td align='center'></td>
            <td ></td>
            <td></td>
            <td></td>
            
            <td></td>
            <td ></td>
            <td></td>
            
            
            <td></td>
            <td></td>
            <td ></td>
            <td></td>
            <td></td>
            
            <td></td>
              <td></td>
              <td></td>
            
          </tr>";



        endfor;


              $html.="<tr>

          <td><strong>Total</strong></td>
            <td><strong>Total</strong></td>
            <td align='center'><strong>".number_format($t_prev_balance)."</strong></td>
           <td><strong>".number_format($t_invoiced)."</strong></td>
            <td><strong>".number_format($t_nbalance)."</strong></td>
            <td><strong>".number_format($t_paid)."</strong></td>
            
           <td><strong>".number_format($t_balance)."</strong></td>
            <td><strong>".number_format($t_deposit)."</strong></td>
             <td><strong>".number_format($t_rent)."</strong></td>
            <td><strong>".number_format($t_wat)."</strong></td>
           
            <td><strong>".number_format($t_gab)."</strong></td>
             <td><strong>".number_format($t_rep)."</strong></td>
            <td><strong>".number_format($t_charge)."</strong></td>
            <td><strong>".number_format($t_agent)."</strong></td>
            <td><strong>".number_format($t_land)."</strong></td>
             <td><strong>".number_format($t_direct)."</strong></td>
            <td><strong>".number_format($t_net)."</strong></td>
            
          </tr>";

            



       
        $html.="
       

        </table>";
        PDF::writeHTML($html, true, false, true ,false, '');


          PDF::Ln(); 
          PDF::Ln(); 
          PDF::Ln(); 

        $html="


        <style>table{border-radius:4px;border:1px solid black;}table td{text-align:left} table th #m{border-left:1px solid black;}table td #m{border-left:1px solid black;} 
        
        th{text-align:left;background-color:rgb(85,216,230);font-weight:normal;border-bottom:1px solid black;border-right:1px solid black;}
        #myhead{text-align:left;background-color:rgb(173,216,230);font-weight:bold;font-size:13.5pts;border-bottom:1px solid black;border-right:1px solid black;}

        td{background-color:white;border-bottom:1px solid black}</style>
        <table width='100%' cellspacing='0' cellpadding='5%'>
        <thead>
        <tr id='myhead'>
        <th width='40%' cellspacing='0' cellpadding='5%' ><b>Expense Name</b></th>
        <th width='30%' cellspacing='0' cellpadding='5%' ><b>Expense Date</b></th>
        <th width='30%' cellspacing='0' cellpadding='5%' ><b>Expense Amount</b></th>";


        $html.="
        </tr>
        </thead>
        <tbody>
        </tbody>
        ";
        $i=1;
        $expense_sum=0;
        foreach($expenses  as $model):

              $a=$i;
         $expense_sum=$expense_sum+$model->amount;

         
            $html.="<tr>

            <td>".$model->expense_name."</td>

            <td>".$model->expense_date."</td>
            <td>".number_format($model->amount)."</td>
            </tr>";
            $i++;
        endforeach;
        for($i=1;$i<=1;$i++):

              $html.="<tr>

            <td></td>
            <td></td>
             <td></td>
             </tr>";
           endfor;
          $html.="
        <tr>
           <td></td>
            <td cellspacing='0' cellpadding='5%'><b>Total</b> </td>
            <td >".number_format($expense_sum)."</td>
            
          </tr>

        </table>";
        PDF::writeHTML($html, true, false, true ,false, '');

        PDF::Ln(); 
          PDF::Ln(); 

        $html="


        <style>table{border-radius:4px;border:1px solid black;}table td{text-align:left} table th #m{border-left:1px solid black;}table td #m{border-left:1px solid black;} 
        
        th{text-align:left;background-color:rgb(85,216,230);font-weight:normal;border-bottom:1px solid black;border-right:1px solid black;}
        #myhead{text-align:left;background-color:rgb(173,216,230);font-weight:bold;font-size:13.5pts;border-bottom:1px solid black;border-right:1px solid black;}

        td{background-color:white;border-bottom:1px solid black}</style>
        <table width='100%' cellspacing='0' cellpadding='5%'>
        <thead>
        <tr id='myhead'>
        <th width='40%' cellspacing='0' cellpadding='5%' ><b>Type</b></th>
          <th width='40%' cellspacing='0' cellpadding='5%' ><b>Description</b></th>
        <th width='30%' cellspacing='0' cellpadding='5%' ><b>Date</b></th>
        <th width='30%' cellspacing='0' cellpadding='5%' ><b>Amount</b></th>";


        $html.="
        </tr>
        </thead>
        <tbody>
        </tbody>
        ";
        $i=1;
        $advance_sum=0;
        foreach($advances  as $model):

              $a=$i;
         $advance_sum=$advance_sum+$model->credit;

         
            $html.="<tr>

            <td>".$model->Description."</td>
             <td>".$model->other_details."</td>

            <td>".$model->tran_date."</td>
            <td>".number_format($model->credit)."</td>
            </tr>";
            $i++;
        endforeach;
        for($i=1;$i<=1;$i++):

              $html.="<tr>

            <td></td>
            <td></td>
             <td></td>
              <td></td>
             </tr>";
           endfor;
          $html.="
        <tr>
           <td></td>
           <td></td>
            <td cellspacing='0' cellpadding='5%'><b>Total</b> </td>
            <td >".number_format($advance_sum)."</td>
            
          </tr>

        </table>";
        PDF::writeHTML($html, true, false, true ,false, '');

          
       
        PDF::Ln();
   $adavance=$Advance;

        $html='
        <table width="100%" cellspacing="0" cellpadding="5%">
        <tr>
        <td align="left" valign="middle" width="1%"></td>
        <td align="left" valign="middle" width="90%">
        <ol>
        <li>Total Collection:<strong>'.number_format($t_paid).'</strong></li>
        <li>Agent Commission:<strong>'.number_format($t_agent).'</strong></li>
        <li>Amount Due :<strong>'.number_format($t_land).'</strong></li>
         <li>Other Expenses :<strong>'.number_format($expense_sum).'</strong></li>
         <li>Advance :<strong>'.number_format($advance_sum).'</strong></li>
          <li>Direct :<strong>'.number_format($t_direct).'</strong></li>
           <li>Adv+Direct+Other Expenses :<strong>'.number_format($advance_sum+$t_direct+$expense_sum).'</strong></li>
          <li>Total Remittance :<strong>'.number_format($t_net-$advance_sum-$expense_sum).'</strong></li>
       
        </ol>
        </td>
       
        </tr>
        </table>';
        PDF::writeHTML($html, true, false, true ,false, '');
        PDF::Ln();
        



        PDF::Ln();


      





        PDF::SetLineStyle( array( 'width' =>4, 'color' => array(85,169,154)));
        PDF::Rect(0, 0, PDF::getPageWidth(), PDF::getPageHeight());
        $name="monthly_report".date('d-M-Y').".pdf";

        

        
        PDF::Ln();


        PDF::Output($name);
       $filename=$name;
       $invoiceFile=$name;
     $destinationPath = base_path() . '/storage/invoices';
    $invoice2 = $destinationPath."/".$invoiceFile; //Linux
    $fileNL = $destinationPath."/".$filename; //Linux
    PDF::Output($fileNL,'F');
    $paths=array($fileNL);
  
    $user=\Auth::user();
      $email=$user->email;

    }

    public static function genareEmailPDF($model,$email)
    {
      
    	$provider=$model->provider;
    	 $title="<fieldset style='color:red;'>Fisical year </fieldset>";
        PDF::SetTopMargin (0);
           PDF::SetLeftMargin (0);
           PDF::SetRIGHTMargin (0);

    PDF::SetTitle('Sample Output');
    PDF::setPageOrientation("p");
    PDF::SetCreator(PDF_CREATOR);
    PDF::SetAlpha(1);
    PDF::SetAuthor('Isanya Hillary');
    PDF::SetTitle("invoice");
    PDF::SetSubject('Equipment List');
    PDF::SetKeywords('TCPDF, PDF, example, motorhub, guide');
    PDF::AddPage();
        PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        //PDF::SetAlpha(1);
        PDF::SetFont('times', '', 10);
        $city=(isset($model->user->profile->city))?$model->user->profile->city:"Nairobi";
        $country=(isset($model->user->profile->country))?$model->user->profile->country:"Kenya";
        $description=(isset($model->description))?$model->description:'Rent Payment for Space Number '.$model->space->number.' at '.$model->space->property->title.' <br> Period :'.date("F,Y",strtotime($model->issue_date));

        // dd($provider);
       
        PDF::SetFont('times', '', 14);
        $html='
        <style>table{border-radius:4px;border:1px solid white;}table td{text-align:left} table th #m{border-left:1px solid #85929e;;}table td #m{border-left:1px solid black;} th{text-align:left;background-color: #85929e ;font-weight:bold;font-size:15pts;border-bottom:1px solid white;border-right:1px solid #85929e ;}td{background-color:white;border-bottom:1px solid black} td #test{font-size:8pts;} th #winney{font-weight:normal}</style>
        <table width="110%"  cellspacing="0" cellpadding="5%">
        <tr rowspan="3">
        <th align="left" valign="middle"
        width="40%" margin="10%;20%;">
        <br><br><br>
        <i>'.$provider->name.'</i><br>
       Invoice
       <br>
      </th>
        <th  id="winney" align="left" valign="middle"
        width="30%">
        <br><br>
        '.$provider->telephone.'<br>
        <small>'.$provider->email.'</small><br>
        qoooetu.com
        </th>
        <th  align="left" valign="middle"
        width="30%">
        <br><br><small>
        '.$provider->postal_address.'<br>'.$provider->building.'<br>
        '.$provider->street.','.$provider->town.'<br>
        '.$provider->user->profile->country.'</small>
        </th>
        </tr></table>';
        PDF::writeHTML($html, true, false, true ,false, '');
        PDF::Ln();
       
        $html='
        <table width="100%" cellspacing="0" cellpadding="5%">
        <tr>
        <td align="left" valign="middle" width="40%" >&nbsp;&nbsp;&nbsp;&nbsp;<label color="#abb2b9">Billed To</label><br>
        <table width="100%" cellspacing="0" cellpadding="5%">
        <tr>
        <td align="left" valign="middle" width="3%"></td>
        <td align="left" valign="middle" width="97%">'.$model->user->name.'</td>
        </tr>
        <tr>
        <td align="left" valign="middle" width="3%"></td>
        <td align="left" valign="middle" width="97%">'.$model->user->profile->postal_address.'</td>
        </tr>
         <tr>
        <td align="left" valign="middle" width="3%"></td>
        <td align="left" valign="middle" width="97%">'.$city.',<b>'.$country.'</b></td>
        </tr>
        <tr>
        <td align="left" valign="middle" width="3%"></td>
        <td align="left" valign="middle" width="97%">'.$model->user->profile->telephone.'</td>
        </tr>
        </table>
        </td>

        <td align="left" valign="middle" width="30%" >&nbsp;&nbsp;&nbsp;&nbsp;<label color="#abb2b9">Invoice Number</label><br>
        <table width="100%" cellspacing="0" cellpadding="5%">
        <tr rowspan="2">
        <td align="left" valign="middle" width="3%"></td>
        <td align="left" valign="middle" width="97%">'.$model->invoice_number.'</td>
        </tr>
        <tr>
        <td align="left" valign="middle" width="3%"></td>
        <td align="left" valign="middle" width="97%"></td>
        </tr>
         <tr>
        <td align="left" valign="middle" width="3%"></td>
        <td align="left" valign="middle" width="97%">Date of Issue</td>
        </tr>
        <tr>
        <td align="left" valign="middle" width="3%"></td>
        <td align="left" valign="middle" width="97%">'.date('dS,M,Y',strtotime($model->issue_date)).'</td>
        </tr>
        </table>
        </td>
        
       <td align="right" valign="middle" width="30%" >&nbsp;&nbsp;&nbsp;&nbsp;<label color="#abb2b9">Invoice Total</label><br>
        <table width="100%" cellspacing="0" cellpadding="5%">
        <tr rowspan="2">
        <td align="left" valign="middle" width="3%"></td>
        <td align="right" valign="middle" width="97%">KES '.number_format($model->amount,2).'</td>
        </tr>
        
        </table>
        </td>
        </tr>
        </table>';
        PDF::writeHTML($html, true, false, true ,false, '');
        PDF::Ln();
        
        $html='<hr >

        <table width="100%" cellspacing="0" cellpadding="5%">
        <tr>
        <td align="left" valign="middle" width="1%"></td>
        <td  align="left" valign="middle" width="98%">
        <style>table tr th{border-radius:4px;border:1px solid black;} .inner td{ border-radius:4px;border:1px solid black;} .innermost{border-radius:4px;border-top:0px solid white;}</style>

        <table width="100%" cellspacing="0" cellpadding="5%">
        <tr>
        <th align="center" valign="middle" width="60%"><b>Description</b></th>
        <th  align="center" valign="middle" width="14%"><b>UnitPrice</b></th>
        <th  align="center" valign="middle" width="10%"><b>Quantity</b></th>
        <th  align="center" valign="middle" width="16%"><b>SubTotal</b></th>

        </tr>
        <tr class="inner" rowspan="4">
        <td align="left" valign="middle" width="60%">'.$description.'<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p align="center">('.$model->status.')</p><p></p><p></p><p></p><p></p><p></p><p></p><p></p></td>
        <td  align="right" valign="middle" width="14%">'.number_format($model->amount,2).'</td>
        <td  align="center" valign="middle" width="10%">1</td>
        <td  align="right" valign="middle" width="16%">'.number_format($model->amount,2).'</td>
       </tr>
       
        
       <tr class="inner">
        <td align="left" valign="middle" width="84%">Total Payable Amount</td>
        
        <td  align="right" valign="middle" width="16%">'.number_format($model->amount,2).'</td>
       </tr>

        </table>
         </td>
         <td align="left" valign="middle" width="5%"></td>
        </tr>
        </table>';
         PDF::writeHTML($html, true, false, true ,false, '');
        PDF::Ln();
        PDF::SetFont('times', '', 11);
        PDF::Write(0,"  Note", '', 0, 'L', true, 0, false, false, 0);
         
        $html='
        <table width="100%" cellspacing="0" cellpadding="5%">
        <tr>
        <td align="left" valign="middle" width="1%"></td>
        <td align="left" valign="middle" width="90%">
        <ol>
        <li>This Invoice is due 1 week('.date("d-M-Y",strtotime($model->due_date)).') from date of issue</li>
        <li>All Payments Must be done through the system</li>
        <li>For any enquiry,please reach our accounts office at '.$provider->telephone.'</li>
        </ol>
        </td>
       
        </tr>
        </table>';
        PDF::writeHTML($html, true, false, true ,false, '');
        PDF::Ln();
        
        PDF::SetFont('times', 15);
        PDF::SetFont('times', 15);
        
        PDF::SetFont('times', '', 10);
        PDF::Ln();
        PDF::Ln();
        PDF::Ln();

        $destinationPath = base_path() . '/storage/invoices';
    $filename=$model->user_id.".pdf";
    
    $invoiceFile="Invoice_".$model->invoice_number.".pdf";
    $invoice2 = $destinationPath."/".$invoiceFile; //Linux
    $fileNL = $destinationPath."/".$filename; //Linux
    PDF::Output($fileNL,'F');
    $paths=array($fileNL);
    if($model->user){
        $user=$model->user;

          $email="hisanyad@gmail.com";
           $mail=\Mail::send('emails.send_invoice',['email'=>$email,'user'=>$user,'model'=>$model,'space'=>$model->space,'provider'=>$model->provider], function($message) use ($paths,$email,$model,$user) {
     $message->to($email, "Invoice ".$model->invoice_number);
     foreach($paths as $path){
      $message->attach($path);
    }
    $message->subject('Invoice');
  });
    }
   
}
}