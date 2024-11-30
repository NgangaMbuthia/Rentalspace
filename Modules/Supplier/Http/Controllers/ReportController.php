<?php

namespace Modules\Supplier\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller ;
use Entrust;
use Auth;
use Modules\Supplier\Entities\Director;
use Modules\Supplier\Entities\Supplier;
use Modules\Supplier\Entities\ProviderSupplier;
use DB;
use Excel;
use PDF;
use App\Http\Middleware\AccountSetUp;
class ReportController extends Controller
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
       
         $models=ProviderSupplier::join('suppliers','suppliers.id','=','provider_suppliers.supplier_id')
             ->where(['provider_id'=>$p_id])->take(150)->get();
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
      $html="<label style='margin-left:70%;'><i>Registered Supplier</i></label>";
      PDF::writeHTML($html, true, false, true ,false, '');


      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::Ln();

$html ="
<style>table{border-radius:4px;border:1px solid green;}table td{text-align:left} table th #m{border-left:1px solid black;}table td #m{border-left:1px solid black;} th{text-align:left;background-color:#F2F2F2;font-weight:bold;font-size:14pts;border-bottom:1px solid black;border-right:1px solid black;}td{background-color:white;border-bottom:1px solid black}</style><table><thead>
  <tr><th>ID</th><th colspan='2'>Supplier Name</th><th>Supplier Number</th><th>Telephone</th><th>Email Address</th><th>City/Town</th>";
   $html.="                                       
  <th>Main Commodity</th>                                                                     
  </tr>
  </thead>
  <tbody>";
  $i=1;
  foreach ($models  as $key):

               
$html.=
 
  "
  <tr>
  <td >".$i."</td>
  <td colspan='2'>".$key->legal_name."</td>
  
  <td>".$key->reg_number." </td>
    <td>".$key->telephone." </td>
    <td>".$key->email." </td>
     <td>".$key->city."</td>
     <td>".$key->core_commodity."</td>
     

  </tr> ";
 $i++;
  endforeach; 

  $html .=
  "</tbody> 
</table>";

// output the HTML content
      PDF::writeHTML($html, true, false, true, false, '');
      PDF::Ln();
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

    public function listreport($format){
         if(Entrust::hasRole("Provider")){

        $oreintation="landscape";
         Excel::create('records', function($excel) use($oreintation,$format) {
          $excel->sheet('Sheet1', function($sheet) use($oreintation,$format) {
         
            $p_id=Auth::User()->getProvider->id;
             $models=ProviderSupplier::join('suppliers','suppliers.id','=','provider_suppliers.supplier_id')
             ->where(['provider_id'=>$p_id])->get();

                $arr =array();
                foreach($models as $key) {
                   
                
                $data =array($key->legal_name,$key->trading_name,$key->reg_number,$key->vat,$key->telephone,$key->alt_phone,
                    $key->email,$key->country_of_origin,$key->city,$key->location,$key->core_commodity,$key->service_type);
                    array_push($arr, $data);
                    }
               $sheet->fromArray($arr,null,'A2',false,false)->prependRow(array(
                       'Legal Name','Trading Name','Registration Number','VAT','Telephone','Altenative Phone','Email Address','Country','City','Location','Core Commodity','Service Type',
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
        return view('supplier::create');
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
        return view('supplier::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('supplier::edit');
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
