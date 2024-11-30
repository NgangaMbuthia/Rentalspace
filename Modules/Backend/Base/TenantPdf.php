<?php

namespace Modules\Backend\Base;

use Illuminate\Database\Eloquent\Model;
use App\User;
use PDF;
use Auth;
use Modules\Backend\Entities\TenantCharges;
class TenantPdf 
{
    public static function generate($models,$property)
    {
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
      
      
    PDF::Write(0,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------", '', 0, 'L', true, 0, false, false, 0);
    PDF::SetFont('times', 15);
      PDF::SetFont('times', 15);
      $html="<label style='margin-left:70%;'><l>Tenants List For: <b>".$property->title." </b></i></label>";
      PDF::writeHTML($html, true, false, true ,false, '');


      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::Ln();

$html ="
<style>table{border-radius:4px;border:1px solid green;}table td{text-align:left} table th #m{border-left:1px solid black;}table td #m{border-left:1px solid black;} th{text-align:left;background-color:#F2F2F2;font-weight:bold;font-size:14pts;border-bottom:1px solid black;border-right:1px solid black;}td{background-color:white;border-bottom:1px solid black}</style><table><thead>
  <tr><th>ID</th><th colspan='2'>Name</th><th>Unit</th><th>Start Date</th><th>End Date</th><th>Deposit</th><th>Rent</th>";
   $html.="                                       
  <th>Status</th>                                                                     
  </tr>
  </thead>
  <tbody>";
  $i=1;
  $count=0;
  foreach ($models  as $key):
$deposit=TenantCharges::where(['tenant_id'=>$key->id,'charge_name'=>'Deposit'])->sum('amount');

$rent=TenantCharges::where(['tenant_id'=>$key->id,'charge_name'=>'Rent'])->sum('amount');
    


               
$html.=
 
  "
  <tr>
  <td >".$i."</td>
   <td>".$key->name." </td>
   <td>".$key->number." </td>
  <td>".$key->entry_date." </td>
  <td>".$key->expected_end_date." </td>
  <td>".$deposit." </td>
  <td>".$rent." </td>
 <td>".$key->current_status." </td>
   
     

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

$html="<label style='margin-left:70%;'><i>Total Properies:  </i>".sizeof($models)." </label>";
PDF::writeHTML($html, true, false, true ,false, '');

$html="<label style='margin-left:70%;'><i>Total Units:  </i>".$count."</label>";
PDF::writeHTML($html, true, false, true ,false, '');


      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::Ln();
     PDF::ln();
      PDF::Output('tenants_charges.pdf');
    }
    
}
