

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>
    <!--[if gte mso 9]><xml>
     <o:OfficeDocumentSettings>
      <o:AllowPNG/>
      <o:PixelsPerInch>96</o:PixelsPerInch>
     </o:OfficeDocumentSettings>
    </xml><![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <title><?=config('app.name')?>Mail Template</title>
    
    
</head>
<body style="width: 100% !important;min-width: 100%;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100% !important;margin: 0;padding: 0;background-color: #FFFFFF">
<table bgcolor="#cccccc" border="0" cellpadding="0" cellspacing="1" width="600px" style="margin: 0px auto;">
<tbody><tr bgcolor="#ffffff">
<td>
<table bgcolor="#33414f" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td>
<div style="width:100%;text-align:center;padding-bottom:30px">
<div style="text-align:right;margin-top:10px;margin-right:10px">

</div>
<h1 style="font-family:'Open Sans',sans-serif;font-size:26px;color:#ffffff;font-weight:300">Dear {{$user->name}}</h1>
<p style="font-family:'Open Sans',sans-serif;font-size:16px;color:#ffffff;font-weight:300;padding-left:10px;padding-right:10px">
  You have a new pending invoice  of <b>KES: <?=number_format($model->amount);?></b> with invoice number<b> <?=$model->invoice_number;?></b> that is due <b> <?=$model->due_date?></b>




</p>
</div>
</td>
</tr>
</tbody></table>
</td>
</tr>
<tr bgcolor="#ffffff">
<td>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td>
<div style="width:100%;padding-bottom:30px;text-align:center;border-bottom:1px solid #000000;padding-top:1px">

  <p style="font-family:'Open Sans',sans-serif;font-size:12px;color:#27323e;font-weight:300;margin-left:35px;margin-right:35px">
 You can access your personal account on 
 <a href="<?=url('/login')?>"><?=config('app.name')?></a> using the following details:<br>

<b>Email address:</b> <?=$user->email?><br>
<b>Password: </b> <?=$user->profile->id_number?>

<br>
</p>




<p style="font-family:'Open Sans',sans-serif;font-size:18px;color:#27323e;font-weight:300">
<p style="font-family:'Open Sans',sans-serif;font-size:16px;font-weight:300;">
<br/><br/>
Below is the Summarized details of the invoice</p>

<center>
<table border="1" cellpadding="0" cellspacing="0" width="85%">
      <thead>
 <tr>
  <th  valign="top">
  <center> ID</center>
  </th>
  
  <th valign="top">
 <center>Item</center> 
  </th>
  <th valign="top">
 <center>Space</center> 
  </th>
   <th  valign="top">
  <center> Property</center>
  </th>
   <th  valign="top">
   <center>UnitPrice</center>
  </th>
  <th  valign="top">
  <center> SubTotal</center>
  </th>
 </tr>
 </thead>
 <tbody>
  <tr>
  <td  valign="top">
   1
  </td>
  
  <td  valign="top">
  Monthly Rent
  </td>
  <td  valign="top">
  <?=$space->number;?>
  </td>
   <td  valign="top">
    <?=$space->property->title;?>
  </td>
   <td  valign="top">
   <?=number_format($model->amount)?>
  </td>
  <td  valign="top" align="right">
   <?=number_format($model->amount)?>
  </td>
 </tr>
 
 
  
   
   
 </tbody>
   
</table>



<div style="width:100%;padding-bottom:30px;text-align:center;padding-top:1px">


<p style="font-family:'Open Sans',sans-serif;font-size:18px;color:#27323e;font-weight:300">
Kindly Pay the requested amount in time to avoid late penalties.

</p>
<div style="text-align:left;margin-top:40px;margin-left:20px;font-family:'Open Sans',sans-serif;font-size:12px;color:#27323e;font-weight:300">
Regards,
<div style="font-weight:600"> <?=$provider->name?> .</div>
</div>



  <tr>
<td>
<table bgcolor="#33414f" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td>
  <p>
 <small style="float: right;padding-top:2%;">Powered By <?=config('app.name')?></small>
</p>

</td>
</tr>
</tbody></table>
</td>
</tr>
  
 


</tr>
   
<br>
<br>
</p>

</div>
</td>
</tr>
</tbody>




</body></html>
