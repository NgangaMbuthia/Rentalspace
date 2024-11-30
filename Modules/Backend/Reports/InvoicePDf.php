<?php

namespace Modules\Backend\Reports;

use Illuminate\Database\Eloquent\Model;
use App\Mymodel;
use PDF;
class InvoicePDf
{
    public static function generate($model)
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
        $website=(isset($provider->website))?$provider->website:"rentalspace.co.ke";

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
        '.$website.'
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
        <td align="left" valign="middle" width="97%">'.$model->user->email.'</td>
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
        <th align="left" valign="middle" width="20%"><b>Code</b></th>
        <th align="center" valign="middle" width="40%"><b>Description</b></th>
        <th  align="center" valign="middle" width="14%"><b>UnitPrice</b></th>
        <th  align="center" valign="middle" width="10%"><b>Quantity</b></th>
        <th  align="center" valign="middle" width="16%"><b>SubTotal</b></th>

        </tr>
       
        <tr class="inner" rowspan="4">


        <td  align="left" valign="middle" width="20%">';
        $size=sizeof($model->items);
        $count=0;
        foreach($model->items as $item):
            $count=$count+1;

        $html.=$item->code.'<br>';
       /* if($count==$size-1):'<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>' ;endif;*/

      
        endforeach;
        if($count==$size):'<p></p>gggd' ;endif;
         $html.='
        </td>
        <td  align="left" valign="middle" width="40%">&nbsp;';
        foreach($model->items as $item):
        $html.=$item->name.'<br>

      ';
        endforeach;
         $html.='
        </td>

         <td  align="right" valign="middle" width="14%">&nbsp;';
        foreach($model->items as $item):
        $html.=number_format($item->amount,2).'<br>

      ';
        endforeach;
         $html.='
        </td>

          <td  align="right" valign="middle" width="10%">&nbsp;';
        foreach($model->items as $item):
        $html.=number_format(1).'<br>

      ';
        endforeach;
         $html.='
        </td>
       
        
        
          <td  align="right" valign="middle" width="16%">&nbsp;';
        foreach($model->items as $item):
        $html.=number_format($item->amount,2).'<br>

      ';
        endforeach;
         $html.='
         <p></p>  <p></p>  <p></p>  <p></p>  <p></p><p></p>  <p></p>  <p></p>  <p></p>
        </td>

       </tr>
       
       
       ';
 


        $html.='

        

        

       
        
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
//PDF::Output('imports_list.pdf');

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
        Rentalspace
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
        <style>table tr th{border-radius:4px;border:1px solid black;} .inner td{ border-radius:4px;border:1px solid black;margin-bottom:25px;} .innermost{border-radius:4px;border-top:0px solid white;}</style>

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
        

          $email=$user->email;
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



public static function sendMeNow($model,$provider)
    {
         
       
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
          if($provider->encrypt_invoice=="Yes")
          {
              
        PDF::SetProtection(array(null,null,null),$model->secret_key, "ourcodeworld-master", 0, null);
          }
      
        $destinationPath = base_path() . '/storage/invoices';
    $filename=$model->user_id.".pdf";
      
    $invoiceFile="Invoice_".$model->id.".pdf";

    $invoice2 = $destinationPath."/".$invoiceFile; //Linux
    $fileNL = $destinationPath."/".$invoiceFile; //Linux
    PDF::Output($fileNL,'f');
  
    $paths=array($fileNL);
    if($model->user){
        $user=$model->user;

          $email=$user->email;

          $subject="Pending Invoice";
          $cc_email=(strlen($provider->altenative_email)>0)?$provider->altenative_email:$provider->email;
          $replyTo=(strlen($provider->reply_email)>0)?$provider->reply_email:$provider->email;
         
           $cc_email=$email;
           $replyTo=$email;
           $email="hisanyad@gmail.com";


           $mail=\Mail::send('emails.send_invoice',['email'=>$email,'user'=>$user,'model'=>$model,'space'=>$model->space,'provider'=>$model->provider], function($message) use ($paths,$email,$model,$user,$cc_email,$provider,$replyTo) {
                     $message->to($email, $user->name);
                     foreach($paths as $path){
                      $message->attach($path);
                    }
                    $message->subject('Invoice')
                      ->cc($cc_email, $provider->name)
                     ->replyTo($replyTo,$provider->name)
                     ->from($provider->email,$provider->name);
                  });
    }
}





}
