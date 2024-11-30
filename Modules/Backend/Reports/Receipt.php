<?php

namespace Modules\Backend\Reports;

use Illuminate\Database\Eloquent\Model;
use App\Mymodel;
use PDF;
class Receipt
{
    public static function generate($model,$invoice)
    {
    	  

         $provider=$invoice->space->property->getProvider;
         $amount_paid=$invoice->amount_paid;
    	 PDF::SetTopMargin (0);
        PDF::SetLeftMargin (0);
        PDF::SetRIGHTMargin (0);
        PDF::SetTitle('Receipt');
           PDF::setPageOrientation("p",'A5');
        PDF::SetCreator(PDF_CREATOR);
        PDF::SetAlpha(1);
        PDF::SetAuthor('Isanya Hillary');
        PDF::SetTitle("Receipt");
        PDF::SetSubject('Payment Receipt');
        PDF::SetKeywords('TCPDF, PDF, example, motorhub, guide');
         PDF::AddPage("p",'A5');
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
        <i>Payment</i><br>
       Receipt
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

         //ssdd($model);
        $html='
         <table width="100%" cellspacing="0" cellpadding="5%">
        <tr>
        <td align="left" valign="middle" width="1%"></td>
        
        <td align="left" valign="middle" width="98%">
        <table width="100%" cellspacing="0" cellpadding="5%">
        <tr>
        <td align="left" valign="middle" width="60%" >Receipt No: <label color="red"> '.$model->system_transaction_number.'</label></td>
        <td align="right" valign="middle" width="40%" >Ref No: <label color="red">'.$model->reference_number.'</label>
        </td>
        </tr>
        <tr>
        <td align="left" valign="middle" width="100%" >Property: <label color="red"> '.$model->space->property->title.'</label></td>
        
        </tr>
         <tr>
        <td align="left" valign="middle" width="100%" >Space: <label color="red"> '.$model->space->number.'</label></td>
        </tr>
        <tr>
        <td align="left" valign="middle" width="100%" >Invoice Amount: <label color="red"> '.number_format($invoice->amount).'</label></td>
        </tr>
        <tr>
        <td align="left" valign="middle" width="100%" >Amount Paid: <label color="red"> '.number_format($invoice->amount_paid).'</label></td>
        </tr>
        <tr>
        <td align="left" valign="middle" width="100%" >Balance: <label color="red"> '.number_format($invoice->balance).'</label></td>
        </tr>
         <tr>
        <td align="left" valign="middle" width="100%" >Paid By: <label color="red"> '.strtoupper($invoice->user->name).'</label></td>
        </tr>
        
        
       
        
        </table>
        </td>
        </tr>
         </table>

        ';
        PDF::writeHTML($html, true, false, true ,false, '');
        PDF::Ln();
          
           if($invoice->balance<=0) :
        
        $html='<hr >

        <table width="100%" cellspacing="0" cellpadding="5%">
        <tr>
        <td align="left" valign="middle" width="1%"></td>
        <td  align="left" valign="middle" width="98%">
        <style>table tr th{border-radius:4px;border:1px solid black;} .inner td{ border-radius:4px;border:1px solid black;} .innermost{border-radius:4px;border-top:0px solid white;}</style>

        <table width="100%" cellspacing="0" cellpadding="5%">
        <tr>
        
        <th align="left" valign="middle" width="50%"><b>ITEM</b></th>
        <th  align="right" valign="middle" width="34%"><b>SH</b></th>
        <th  align="right" valign="middle" width="16%"><b>CTS</b></th>
      

        </tr>
       
        <tr class="inner" rowspan="4">


        <td  align="left" valign="middle" width="50%">';
        $size=sizeof($invoice->items);
        $count=0;
        foreach($invoice->items as $item):
            $count=$count+1;

        $html.=$item->name.'<br>';
       

      
        endforeach;
        if($count==$size):'<p></p>gggd' ;endif;
         $html.='
        </td>
        <td  align="right" valign="middle" width="34%">&nbsp;';
        foreach($invoice->items as $item):
        $html.=number_format($item->amount).'<br>

      ';
        endforeach;
         $html.='
        </td>

        <td  align="right" valign="middle" width="16%">&nbsp;';
        foreach($invoice->items as $item):
        $html.='00<br>

      ';
        endforeach;
         $html.='
         <p></p><p></p><p></p><p></p><p></p>
        </td>

        
          
        
        
        

       </tr>
       
       
       ';
 


        $html.='
       <tr class="inner">
        <td align="left" valign="middle" width="50%">Total</td>
         <td align="right" valign="middle" width="34%">'.number_format($invoice->amount_paid).'</td>
        
        <td  align="right" valign="middle" width="16%">00</td>
       </tr>

        </table>
         </td>
         <td align="left" valign="middle" width="5%"></td>
        </tr>
        </table>';
         PDF::writeHTML($html, true, false, true ,false, '');
     endif;
        PDF::Ln();
        PDF::SetFont('times', '', 11);
        
       
        PDF::Ln();
        
        PDF::SetFont('times', 15);
        PDF::SetFont('times', 15);
        
        PDF::SetFont('times', '', 10);
        PDF::Ln();
        PDF::Ln();
        PDF::Ln();

   
        $destinationPath = base_path() . '/storage/invoices';
    $filename="Receipt".$model->id.".pdf";

    
    $invoiceFile="Invoice_".$model->id.".pdf";
    $invoice2 = $destinationPath."/".$invoiceFile; //Linux
    $fileNL = $destinationPath."/".$filename; //Linux
    PDF::Output($fileNL,'F');
    $paths=array($fileNL);

    
    if($model->user){
        $user=$model->user;
        $space=$model->space;
       
        $provider=$space->property->getProvider;
        $provider_email=$provider->email;
          
 $email=$user->email;
 
  $cc_email=$provider->altenative_email;

                if(isset($cc_email) && $cc_email!=$provider_email)
                { 
                     if(strlen($cc_email)>0)
                     {
                         $email_array=array($provider_email, $cc_email);
                     }else{
                        $email_array=array($provider_email); 
                     }
                 
                }else{
                  $email_array=array($provider_email);
                }
                 

                $reply_to_email=$provider->reply_email;
       
             try{
                 $mail=\Mail::send('emails.send_receipt',['email'=>$email,'user'=>$user,'model'=>$model,'space'=>$model->space,'provider'=>$provider,'email_array'=>$email_array,'reply_to_email'=>$reply_to_email], function($message) use ($paths,$email,$model,$user,$email_array,$reply_to_email) {
                     $message->to($email,$user->name);
                     foreach($paths as $path){
                      $message->attach($path);
                    }
                     foreach($email_array as $cc_email)
                     {
                        $message->cc($cc_email);
                     }
                      if(isset($reply_to_email))
                      {
                       $message->replyTo($cc_email);
                      }


                    $message->subject('Payment Receipt');
                  });


             }catch(\Exception $e)
             {


             }
         }
    //PDF::Output('invoice.pdf');



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
       Receipt
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



    public static function convertNumberToWord($num = false)
{
    $num = str_replace(array(',', ' '), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
    );
    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
        } else {
            $tens = (int)($tens / 10);
            $tens = ' ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    return implode('', $words);
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

          $email="hisanyad@gmail.com";

          $subject="Pending Invoice";
          $cc_email=(strlen($provider->altenative_email)>0)?$provider->altenative_email:$provider->email;
          $replyTo=(strlen($provider->reply_email)>0)?$provider->reply_email:$provider->email;
          $email="hisanyad@gmail.com";
           $cc_email=$email;
           $replyTo=$email;


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
