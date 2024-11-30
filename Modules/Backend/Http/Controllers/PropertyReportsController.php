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
use App\Http\Middleware\AccountSetUp;

class PropertyReportsController extends Controller
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


    public function getProperiesPdf(){
       if(Entrust::hasRole("Provider"))
       { $models=Property::join('categories','categories.id','=','properties.category_id')
                ->join('sub_categories','sub_categories.id','=','properties.subcategory_id')
                ->select(['properties.title','properties.id','categories.name','sub_categories.name as subcat','type','town','location'])
                ->where(['properties.provider_id'=>Auth::User()->getProvider->id])
                ->get();
                
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
      $html="<label style='margin-left:70%;'><l>List of Properties under your account</b></i></label>";
      PDF::writeHTML($html, true, false, true ,false, '');


      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::Ln();

$html ="
<style>table{border-radius:4px;border:1px solid green;}table td{text-align:left} table th #m{border-left:1px solid black;}table td #m{border-left:1px solid black;} th{text-align:left;background-color:#F2F2F2;font-weight:bold;font-size:14pts;border-bottom:1px solid black;border-right:1px solid black;}td{background-color:white;border-bottom:1px solid black}</style><table><thead>
  <tr><th>ID</th><th colspan='2'>Name</th><th>Category</th><th>Type</th><th>Purpose</th><th>Town</th>";
   $html.="                                       
  <th>No of Units</th>                                                                     
  </tr>
  </thead>
  <tbody>";
  $i=1;
  $count=0;
  foreach ($models  as $key):

    $count=$count+$key->spaces->count();


               
$html.=
 
  "
  <tr>
  <td >".$i."</td>
  <td colspan='2'>".$key->title."</td>
  
  <td>".$key->name." </td>
    <td>".$key->subcat." </td>
    <td>".$key->type." </td>
    <td>".$key->town." </td>
    <td>".$key->spaces->count()." </td>
     

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

$spaces=Space::join('properties','properties.id','=','spaces.property_id')
        ->where(['provider_id'=>$p_id,'spaces.status'=>'Occupied'])->count();
$vacant_spaces=Space::join('properties','properties.id','=','spaces.property_id')
        ->where(['provider_id'=>$p_id,'spaces.status'=>'Free'])->count();



$html="<label style='margin-left:70%;'><i>Total Units Vacant:  </i>".$vacant_spaces."</label>";
    PDF::writeHTML($html, true, false, true ,false, '');
     $html="<label style='margin-left:70%;'><i>Total units Occupied:  </i>".$spaces."</label>";
      PDF::writeHTML($html, true, false, true ,false, '');
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


    public function getProperiesOtherFormats($format){

        if(Entrust::hasRole("Provider")){
         $oreintation="landscape";
         Excel::create('records', function($excel) use($oreintation,$format) {
          $excel->sheet('Sheet1', function($sheet) use($oreintation,$format) {
         
            $p_id=Auth::User()->getProvider->id;
            $models=Property::join('categories','categories.id','=','properties.category_id')
                ->join('sub_categories','sub_categories.id','=','properties.subcategory_id')
                ->select(['properties.title','properties.id','categories.name','sub_categories.name as subcat','type','town','location'])
                ->where(['properties.provider_id'=>Auth::User()->getProvider->id])
                ->get();

                $arr =array();
                foreach($models as $key) {
                    $name2=$key->title;
                   
                $data =array($name2,$key->name,$key->subcat,$key->type,$key->town,$key->location);
                    array_push($arr, $data);
                    }
               $sheet->fromArray($arr,null,'A2',false,false)->prependRow(array(
                       'Property Name','Category','Type','Purpose','Town','LocationS'
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


    public function getManagersPdf(){
        if(Entrust::hasRole("Provider"))
       { 
        $models=Property::join('categories','categories.id','=','properties.category_id')
                ->join('sub_categories','sub_categories.id','=','properties.subcategory_id')
                ->select(['properties.title','properties.id','categories.name','sub_categories.name as subcat','manager_phone','managed_by','Manager_email','manager_postal'])
                ->where(['properties.provider_id'=>Auth::User()->getProvider->id])
                ->get();
                
          $p_id=Auth::User()->getProvider->id;
        
      PDF:: SetTopMargin (20);
      PDF::SetTitle('Manager List');
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
      $html="<label style='margin-left:70%;'><l>List of Properties Managers</b></i></label>";
      PDF::writeHTML($html, true, false, true ,false, '');


      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::Ln();

$html ="
<style>table{border-radius:4px;border:1px solid green;}table td{text-align:left} table th #m{border-left:1px solid black;}table td #m{border-left:1px solid black;} th{text-align:left;background-color:#F2F2F2;font-weight:bold;font-size:14pts;border-bottom:1px solid black;border-right:1px solid black;}td{background-color:white;border-bottom:1px solid black}</style><table><thead>
  <tr><th>ID</th><th colspan='2'>Property</th><th>Category</th><th>Manager</th><th>Email</th><th>Telephone</th>";
   $html.="                                       
  <th>Postal Address</th>                                                                     
  </tr>
  </thead>
  <tbody>";
  $i=1;
  $count=0;
  foreach ($models  as $key):

    $count=$count+$key->spaces->count();


               
$html.=
 
  "
  <tr>
  <td >".$i."</td>
  <td colspan='2'>".$key->title."</td>
  
  <td>".$key->name." </td>
    
    <td>".$key->managed_by." </td>
    <td>".$key->Manager_email." </td>
     <td>".$key->manager_phone." </td>
    <td>".$key->manager_postal." </td>
     

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

$spaces=Space::join('properties','properties.id','=','spaces.property_id')
        ->where(['provider_id'=>$p_id,'spaces.status'=>'Occupied'])->count();
$vacant_spaces=Space::join('properties','properties.id','=','spaces.property_id')
        ->where(['provider_id'=>$p_id,'spaces.status'=>'Free'])->count();



$html="<label style='margin-left:70%;'><i>Total Units Vacant:  </i>".$vacant_spaces."</label>";
    PDF::writeHTML($html, true, false, true ,false, '');
     $html="<label style='margin-left:70%;'><i>Total units Occupied:  </i>".$spaces."</label>";
      PDF::writeHTML($html, true, false, true ,false, '');
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
    public function index()
    {
        return view('backend::index');
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
}
