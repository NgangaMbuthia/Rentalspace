<?php

namespace Modules\Hotels\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Controllers\Controller ;
use Entrust;
use Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use DB;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Session;
use Modules\Hotels\Entities\HotelType;
use Modules\Hotels\Entities\Supplier;
use App\User;
use Modules\UserManagement\Entities\Profile;
use Modules\Hotels\Entities\RoomType;
use Modules\Hotels\Entities\BedType;
use Modules\Hotels\Entities\SupplierAmenty;
use Modules\Hotels\Entities\Hotel;
use Modules\Hotels\Entities\HotelAmentitities;
use Modules\Hotels\Entities\HotelGallery;
use Modules\Backend\Entities\Upload;
use PDF;

class HotelController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if(Entrust::can("manage-hotels")){
            $data['page_title']="List Of Hotels";
         return view('hotels::hotels.hotel_index',$data);
        }else{
            return view("forbidden");
        }
        
    }

    public function adminView(){
         if(Entrust::hasRole("Admin")){
            $data['page_title']="List Of Hotels";
         return view('hotels::hotels.admin_index',$data);
        }else{
            return view("forbidden");
        }

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
    if(Entrust::can("manage-hotels") || Entrust::can("manage-hotel-rooms")){
        $data['page_title']="Create Hotel";
        $data['url']=url()->current();
         if($request->isMethod("post")){
            $data=$request->all();
                 DB::beginTransaction();
            // dd($data);
            try{
             $model=new Hotel();
             $model->supplier_id=Auth::user()->supplier->id;
             $model->hotel_name=ucfirst($data['hotel_name']);
             $model->hotel_code=substr(number_format(time() * rand(),0,'',''),0,6);
             $model->hotel_type=$data['hotel_type'];
             $model->hotel_email=$data['hotel_email'];
             $model->hotel_telephone=Helper::processNumber($data['hotel_telephone']);
             $model->hotel_logitude=$data['hotel_logitude'];
             $model->hotel_latitude=$data['hotel_latitude'];
             $model->hotel_city=ucfirst($data['hotel_city']);
             $model->hotel_state=ucfirst($data['hotel_state']);
             $model->hotel_country=ucfirst($data['hotel_country']);
             $model->postal_address=$data['postal_address'];
             $model->hotel_check_in_time=date('H:i:s',strtotime($data['hotel_check_in_time']));
             $model->hotel_check_out_time=date('H:i:s',strtotime($data['hotel_check_out_time']));
             $model->hotel_start=$data['hotel_start'];
             $model->description=$data['description'];
             $model->hotel_status="Approved";
             $model->hotel_profile="Complete";
             $model->save();
             

               if($model){
                //create hotel amentities
                $this->createHotelAmentities($model,$data['amenities']);
                $this->createHotelGallery($model,$data['images']);
                DB::commit();
                Session::flash("success_msg","Hotel Added Successfully");
                return redirect('/hotels/hotel/index');
               }
           }catch(\Exception $e){
                    Helper::sendEmailToSupport($e);
                Session::flash("danger_msg","Error Occured while Processing Your Request.System Admin notified");
                 return redirect()->back();
                 }
             }
$data['amentities']=SupplierAmenty::where(['supplier_id'=>auth::user()->supplier->id,'category'=>'Hotel Amentity'])->orwhere(['category'=>'Both'])->get();
        $data['hotel_types']=HotelType::orderBy('name')->get();
        $data['model']=new Hotel();
        $data['available_amentities']=array();
         
             return view('hotels::hotels.create_hotel',$data);
         }else{
            return view("forbidden");
         }
       
    }

    public function createHotelAmentities($hotel,$amentities){
      $user_id=auth::user()->id;
      $models=HotelAmentitities::where(['hotel_id'=>$hotel->id,'user_id'=>$user_id,'supplier_id'=>$hotel->supplier_id])->get();
       foreach($models as $deleteKey){
        $deleteKey->delete();
       }

        foreach($amentities as $key=>$value){
            $model=new HotelAmentitities();
            $model->user_id=$user_id;
            $model->supplier_id=$hotel->supplier_id;
            $model->hotel_id=$hotel->id;
            $model->amentity_id=$value;
            $model->save();
        }
        return true;
}

public function createHotelGallery($hotel,$images){
     
     $user_id=auth::user()->id;
     $models=HotelGallery::where(['hotel_id'=>$hotel->id,'user_id'=>$user_id,
        'supplier_id'=>$hotel->supplier_id])->get();
     foreach($models as $deleteKey){
        $deleteKey->delete();
       }
       $images=explode(',', $images);
        
       foreach($images as $key=>$value){
          if(!empty($value)){
        $model=HotelGallery::where(['hotel_id'=>$hotel->id,'user_id'=>$user_id,'supplier_id'=>$hotel->supplier_id,'image_id'=>$value])->first();
             if(!$model){
                $model=new HotelGallery();
             }
            $model->user_id=$user_id;
            $model->supplier_id=$hotel->supplier_id;
            $model->hotel_id=$hotel->id;
            $model->image_id=$value;
            $model->save();
          }

       }
       return true;

}

public function fetchHotels(){
    $models=Hotel::where(['supplier_id'=>Auth::user()->supplier->id]);
    return Datatables::of($models)->addColumn('action',function($model){
           
              $edit_url=url("/hotels/hotel/update/".$model->id);
               $delete_url=url("/hotels/hotel/delete/".$model->id);
               $index_url=url("/hotels/hotel/index");

                $audit_url=url('/system/audit?id='.$model->id."&type=Modules\Hotels\Entities\Hotel");

           return '  <div class="dropdown">
                      <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Action
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="'.$edit_url.'">Edit</a></li>
                        <li><a href="'.$edit_url.'">View </a></li>
                        <li><a href="'.$edit_url.'">Bookings </a></li>
                        <li data-title="Delete Hotel" data-name="Hotel" class="delete-record"   data-redirect-to="'.$index_url.'"  data-href="'.$delete_url.'" ><a href="#">Delete</a></li>

                       
                        <li><a href="'.$audit_url.'">Audit Trail</a></li>

                        
                      </ul>
                    </div> ';
   })->make(true);
}

public function fetchAllHotels(){
    if(Entrust::hasRole("Admin")){
        $models=Hotel::join('service_suppliers','service_suppliers.id','=','hotels.supplier_id');
        return Datatables::of($models)->make(true);


    }else{
        return json_encode("Access Denied");
    }
}
public function CreateProfile(Request $request){
     if(Entrust::can("manage-hotels") || Entrust::can("manage-hotel-rooms")){
        $data['page_title']="Create Hotel";
        $data['url']=url()->current();
        $id=Hotel::where(['supplier_id'=>Auth::user()->supplier->id])->first()->id;
        $model=Hotel::where(['id'=>$id,'supplier_id'=>Auth::user()->supplier->id])->first();
         if(!$model){
            return view("not_found");
         }
         if($request->isMethod("post")){
            $data=$request->all();
                 DB::beginTransaction();
            
            try{
             $longitude=$data['hotel_logitude'];
              if(!$longitude==""){
             $model->hotel_logitude=$data['hotel_logitude'];
              }
              $latitude=$data['hotel_latitude'];

              if(!$latitude==""){
                $model->hotel_latitude=$data['hotel_latitude'];
              }
             $model->supplier_id=Auth::user()->supplier->id;
             $model->hotel_name=ucfirst($data['hotel_name']);
             $model->hotel_code=substr(number_format(time() * rand(),0,'',''),0,6);
             $model->hotel_type=$data['hotel_type'];
             $model->hotel_email=$data['hotel_email'];
             $model->hotel_telephone=Helper::processNumber($data['hotel_telephone']);
             $model->hotel_city=ucfirst($data['hotel_city']);
             $model->hotel_state=ucfirst($data['hotel_state']);
             $model->hotel_country=ucfirst($data['hotel_country']);
             $model->postal_address=$data['postal_address'];
             $model->hotel_check_in_time=date('H:i:s',strtotime($data['hotel_check_in_time']));
             $model->hotel_check_out_time=date('H:i:s',strtotime($data['hotel_check_out_time']));
             $model->hotel_start=$data['hotel_start'];
             $model->description=$data['description'];
             $model->hotel_status="Approved";
             $model->hotel_profile="Complete";
             $model->save();
             

               if($model){
                //create hotel amentities
                $this->createHotelNewAmentities($model,$data['amenities']);
                $this->createHotelGallery($model,$data['images']);
                DB::commit();
                Session::flash("success_msg","Hotel Added Successfully");
                return redirect('/home');
               }
           }catch(\Exception $e){
                   // Helper::sendEmailToSupport($e);
                Session::flash("danger_msg","Error Occured while Processing Your Request.System Admin notified");
                 dd($e);
                 return redirect()->back();
                 }
             }


             $data['amentities']=$amentity_list=SupplierAmenty::where(['supplier_id'=>auth::user()->supplier->id,'category'=>'Hotel Amentity'])->orwhere(['category'=>'Both'])->get();
             if(sizeof($amentity_list)<1){
                $data['amentities']=config('app.system_amentities');
             }else{
                 
                $amentity_list2=array();
                foreach($amentity_list as $amen){
                 $amentity_list2[]  =$amen->name;
                }
                $data['amentities']=$amentity_list2;
             }






        $data['hotel_types']=HotelType::orderBy('name')->get();
        $data['model']=$model;
        $my_list=$model->amentities;
         $list=array();
         foreach($my_list as $key){
              if($key->amentity){
                $list[]=$key->amentity->name;
              }
            
         }
        $data['available_amentities']=$list;
        $data['action']="Update Hotel Details";
         

        return view('hotels::hotels.new_hotel',$data);
         }else{
            return view("forbidden");
         }

}

public function updateHotel($id,Request $request){
     if(Entrust::can("manage-hotels") || Entrust::can("manage-hotel-rooms")){
        $data['page_title']="Create Hotel";
        $data['url']=url()->current();
        $model=Hotel::where(['id'=>$id,'supplier_id'=>Auth::user()->supplier->id])->first();
         if(!$model){
            return view("not_found");
         }
         if($request->isMethod("post")){
            $data=$request->all();
                 DB::beginTransaction();
            // dd($data);
            try{
             
             $model->supplier_id=Auth::user()->supplier->id;
             $model->hotel_name=ucfirst($data['hotel_name']);
             $model->hotel_code=substr(number_format(time() * rand(),0,'',''),0,6);
             $model->hotel_type=$data['hotel_type'];
             $model->hotel_email=$data['hotel_email'];
             $model->hotel_telephone=Helper::processNumber($data['hotel_telephone']);
             $model->hotel_logitude=$data['hotel_logitude'];
             $model->hotel_latitude=$data['hotel_latitude'];
             $model->hotel_city=ucfirst($data['hotel_city']);
             $model->hotel_state=ucfirst($data['hotel_state']);
             $model->hotel_country=ucfirst($data['hotel_country']);
             $model->postal_address=$data['postal_address'];
             $model->hotel_check_in_time=date('H:i:s',strtotime($data['hotel_check_in_time']));
             $model->hotel_check_out_time=date('H:i:s',strtotime($data['hotel_check_out_time']));
             $model->hotel_start=$data['hotel_start'];
             $model->description=$data['description'];
             $model->hotel_status="Approved";
             $model->hotel_profile="Complete";
             $model->save();
             

               if($model){
                //create hotel amentities
                $this->createHotelAmentities($model,$data['amenities']);
                $this->createHotelGallery($model,$data['images']);
                DB::commit();
                Session::flash("success_msg","Hotel Added Successfully");
                return redirect('/hotels/hotel/index');
               }
           }catch(\Exception $e){
                    Helper::sendEmailToSupport($e);
                Session::flash("danger_msg","Error Occured while Processing Your Request.System Admin notified");
                 return redirect()->back();
                 }
             }
$data['amentities']=SupplierAmenty::where(['supplier_id'=>auth::user()->supplier->id,'category'=>'Hotel Amentity'])->orwhere(['category'=>'Both'])->get();
        $data['hotel_types']=HotelType::orderBy('name')->get();
        $data['model']=$model;
        $my_list=$model->amentities;
         $list=array();
         foreach($my_list as $key){
            $list[]=$key->amentity_id;
         }

        $data['available_amentities']=$list;
        $data['action']="Update Hotel Details";
        return view('hotels::hotels.create_hotel',$data);
         }else{
            return view("forbidden");
         }

}

public function Gallery(){
     if(Entrust::can("manage-hotels") || Entrust::can("manage-hotel-rooms")){
        $data['page_title']="My Gallery";
        $data['images']=Upload::where(['user_id'=>Auth::User()->id])->orderBy('created_at','desc')->get();
        return view('hotels::hotels.my_gallery',$data);

    }else{
        return view("forbidden");
    }

}

public function DeleteHotel($id){
        if(Entrust::can("manage-hotels") || Entrust::can("manage-hotel-rooms")){
         $model=Hotel::where(['id'=>$id,'supplier_id'=>auth::user()->supplier->id])->first();
         if($model){
             try{
                $model->delete();
                Session::flash("success_msg","Hotel Deleted Successfully");
              }catch(\Exception $e){
                Helper::sendEmailToSupport($e);
                Session::flash("danger_msg","Error Occured while Processing Your Request.System Admin notified about the error");
                 }

         }else{
            Session::flash("danger_msg","access Denied.Resorce not Found this Server.");
         }

     }else{
        Session::flash("danger_msg","access Denied.You do not have permission to delete this Resorce on this Server.");
     }
}

public function createHotelNewAmentities($hotel,$amentities){
    $user_id=auth::user()->id;
    $models=SupplierAmenty::where(['user_id'=>$user_id,'supplier_id'=>$hotel->supplier_id])->get();
     
       foreach($models as $deleteKey){
        $deleteKey->delete();
       }
foreach($amentities as $key){
       $model=SupplierAmenty::where(['user_id'=>$user_id,'supplier_id'=>$hotel->supplier_id,'name'=>$key])->first();
        if(!$model){
          $model=new SupplierAmenty();  
        }
        $model->name=ucwords($key);
        $model->category="Both";
        $model->supplier_id=auth::user()->supplier->id;
        $model->user_id=auth::user()->id;
        $model->save();
          if($model){
            $model2=new HotelAmentitities();
            $model2->amentity_id=$model->id;
            $model2->user_id=$model->user_id;
            $model2->supplier_id=$model->supplier_id;
            $model2->hotel_id=$hotel->id;
            $model2->save();
        }
     }

     return true;
}




    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    public function HotelsReport(Request $request){
          if(Entrust::can("manage-hotels")){
            $data['url']=url()->current();
             if($request->isMethod("post"))
             {
               $data=$request->all();
               $hotel_type=$data['hotel_type'];
               $hotel_city=$data['hotel_city'];
               $action=$data['action'];
               $type=$data['report_type'];
                switch ($type) {
                    case 'Pdf':
                        $this->GenaratePdf($hotel_type,$hotel_city,$action);
                        break;
                    
                    default:
                        $this->GenarateExcel($hotel_type,$hotel_city,$action);
                        break;
                }

                return redirect()->back();


               






             }







            $data['hotel_types']=Hotel::where(['supplier_id'=>Auth::user()->supplier->id])->select('hotel_type')->distinct()->get();
            $data['states']=Hotel::where(['supplier_id'=>Auth::user()->supplier->id])->select('hotel_state')->distinct()->get();
            return view('hotels::hotels.hotel_report',$data);

          }else{
            return "Access Denied";
          }

     }

     public function GenaratePdf($type,$state,$action){
         


      PDF:: SetTopMargin (20);
      PDF::SetTitle('Hotel List');
      PDF::setPageOrientation("l");
      PDF::SetCreator(PDF_CREATOR);
      PDF::SetAlpha(1);
      PDF::SetAuthor('Isanya Hillary');
      PDF::Write(0,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------", '', 0, 'L', true, 0, false, false, 0);
      PDF::SetTitle(Auth::user()->supplier->name);
      PDF::SetSubject('Enterprise');
      PDF::SetKeywords('TCPDF, PDF, example, test, guide');
       //dd(Auth::user()->supplier->id);
       if($type=="All"){
          if($state=="All"){
            $models=Hotel::where(['supplier_id'=>Auth::user()->supplier->id])->get();
             
            }else{
            $models=Hotel::where(['supplier_id'=>Auth::user()->supplier->id,'hotel_state'=>$state])->get();
            }
           }else{

            if($state=="All"){
              $models=Hotel::where(['supplier_id'=>Auth::user()->supplier->id,'hotel_type'=>$type])->get();
              }else
               {
                $models=Hotel::where(['supplier_id'=>Auth::user()->supplier->id,'hotel_state'=>$state,'hotel_type'=>$type])->get();
                }
           }
       
       PDF::AddPage();
      // set default monospaced font
      PDF::Image('http://localhost/kenya/public/uploads/c.png', 135, 12, 20, 20, '', '', '', true, 72);
      $htm2="<h1 style='margin-bottom:0.7%;''></h2>";
      PDF::writeHTML($htm2, true, false, true, false, '');
      PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      PDF::SetAlpha(1);
      PDF::SetFont('times', '', 14);
      PDF::Ln();
      PDF::Ln();
     PDF::Ln();
     
      
      
    PDF::Write(0,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------", '', 0, 'L', true, 0, false, false, 0);
    PDF::SetFont('times', 15);
      PDF::SetFont('times', 15);
      $html="<label style='margin-left:70%;'>Hotel list</label>";
      PDF::writeHTML($html, true, false, true ,false, '');


      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::Ln();

$html ="
<style>table{border-radius:4px;border:1px solid green;}table td{text-align:left} table th #m{border-left:1px solid black;}table td #m{border-left:1px solid black;} th{text-align:left;background-color:#F2F2F2;font-weight:bold;font-size:14pts;border-bottom:1px solid black;border-right:1px solid black;}td{background-color:white;border-bottom:1px solid black}</style><table><thead>
  <tr><th>ID</th><th colspan='2'>Name</th><th>Telephone</th><th>Type</th><th>Rating</th><th>City</th><th>State</th>";
   $html.="                                       
  <th>Country</th>                                                                     
  </tr>
  </thead>
  <tbody>";
  $i=1;
  foreach ($models  as $key):

               
$html.=
 
  "
  <tr>
  <td >".$i."</td>
  <td colspan='2'>".$key->hotel_name."</td>
  
  <td>".$key->hotel_telephone." </td>
    <td>".$key->hotel_type." </td>
    <td>".$key->hotel_start." </td>
     <td>".$key->hotel_city."</td>
     <td>".$key->hotel_state."</td>
       <td>".$key->hotel_country."</td>
     

  </tr> ";
 $i++;
  endforeach; 

  $html .=
  "</tbody> 
</table>";

// output the HTML content
 PDF::SetFont('times', '', 10);
PDF::writeHTML($html, true, false, true, false, '');
      PDF::Ln();

      
     
      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::Ln();
     PDF::ln();
      if($action=="Genarate"){
        PDF::Output('tenants_charges.pdf');
    }else{
    $destinationPath = base_path() . '/storage/hotels/report';
    $filename=str_slug(auth::user()->supplier->name).".pdf";
    $fileNL = $destinationPath."/".$filename; //Linux
    PDF::Output($fileNL,'F');
    $paths=array($fileNL);
    $email=auth::user()->email;
                 $mail=\Mail::send('emails.send_report',['email'=>$email ], function($message) use ($paths,$email) {
                     $message->to($email, "Hotel List Report");
                   foreach($paths as $path){
                    $message->attach($path);
                   }
                   $message->subject('Hotel List Report');
                   });
                  Session::flash("success_msg","Report Emailed Successfully");
             

    }
     
      }


      public function GenarateExcel($type,$state,$action){
          if($action=="Genarate"){
            $oreintation="landscape";
              $format="Xls";
         \Excel::create('records', function($excel) use($oreintation,$format,$type,$state) {
          $excel->sheet('Sheet1', function($sheet) use($oreintation,$format,$type,$state) {
            
              if($type=="All"){
          if($state=="All"){
            $models=Hotel::where(['supplier_id'=>Auth::user()->supplier->id])->get();
             
            }else{
            $models=Hotel::where(['supplier_id'=>Auth::user()->supplier->id,'hotel_state'=>$state])->get();
            }
           }else{

            if($state=="All"){
              $models=Hotel::where(['supplier_id'=>Auth::user()->supplier->id,'hotel_type'=>$type])->get();
              }else
               {
                $models=Hotel::where(['supplier_id'=>Auth::user()->supplier->id,'hotel_state'=>$state,'hotel_type'=>$type])->get();
                }
           }
               $arr =array();
              
                foreach($models as $key) {
                     
                     $name=$key->hotel_name;
                     $code=$key->hotel_code;
                     $phone=$key->hotel_telephone;
                     $email=$key->hotel_email;
                     $type=$key->hotel_type;
                     $star=$key->hotel_start;
                     $city=$key->hotel_city;
                     $state=$key->hotel_state;
                     $country=$key->hotel_country;
                     $postal_address=$key->postal_address;
                     
                    
                   
                $data =array($name,$code,$phone,$type,$email,$star,$city,$state,$country,$postal_address);
                    array_push($arr, $data);
                    }
               $sheet->fromArray($arr,null,'A2',false,false)->prependRow(array(
                       'Hotel Name','Hotel Code','Telephone','Type','Email Address','Rating','City','State','Country','Postal Address'
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
                    
                }
                else{
                $name=str_slug(Auth::user()->supplier->name);

                $oreintation="landscape";
              $format="Xls";
         \Excel::create($name, function($excel) use($oreintation,$format,$type,$state) {
          $excel->sheet('Sheet1', function($sheet) use($oreintation,$format,$type,$state) {
            
              if($type=="All"){
          if($state=="All"){
            $models=Hotel::where(['supplier_id'=>Auth::user()->supplier->id])->get();
             
            }else{
            $models=Hotel::where(['supplier_id'=>Auth::user()->supplier->id,'hotel_state'=>$state])->get();
            }
           }else{

            if($state=="All"){
              $models=Hotel::where(['supplier_id'=>Auth::user()->supplier->id,'hotel_type'=>$type])->get();
              }else
               {
                $models=Hotel::where(['supplier_id'=>Auth::user()->supplier->id,'hotel_state'=>$state,'hotel_type'=>$type])->get();
                }
           }
               $arr =array();
              
                foreach($models as $key) {
                     
                     $name=$key->hotel_name;
                     $code=$key->hotel_code;
                     $phone=$key->hotel_telephone;
                     $email=$key->hotel_email;
                     $type=$key->hotel_type;
                     $star=$key->hotel_start;
                     $city=$key->hotel_city;
                     $state=$key->hotel_state;
                     $country=$key->hotel_country;
                     $postal_address=$key->postal_address;
                     
                    
                   
                $data =array($name,$code,$phone,$type,$email,$star,$city,$state,$country,$postal_address);
                    array_push($arr, $data);
                    }
               $sheet->fromArray($arr,null,'A2',false,false)->prependRow(array(
                       'Hotel Name','Hotel Code','Telephone','Type','Email Address','Rating','City','State','Country','Postal Address'
                    )
                );
                
                $sheet->row(1,function($row){
                    $row->setFont(array(
                        'family'     => 'Calibri',
                        'bold'       =>  true
                    ));});

                $sheet->setOrientation($oreintation);
                 });

        })->store("xls");
          $email=auth::user()->email;
          $exl_path=base_path() . '/storage/exports/'.$name.'.xls';
                  $paths=array($exl_path);
                  $mail=\Mail::send('emails.send_report',['email'=>$email ], function($message) use ($paths,$email) {
                     $message->to($email, "Hotel List Report");
                   foreach($paths as $path){
                    $message->attach($path);
                   }
                   $message->subject('Hotel List Report');
                   });
                  Session::flash("success_msg","Report Emailed Successfully");
                  return redirect()->back();

                 }
 }

 public function getGallery(){
      if(Entrust::can("manage-hotels")){
        $data['page_title']="Hotel Images";
        $data['images']=HotelGallery::where(['supplier_id'=>auth::user()->supplier->id,'user_id'=>auth::user()->id])->get();
        return view('hotels::hotels.hotel_gallery',$data);


      }else{
        return view("forbidden");
      }

 }










    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('hotels::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('hotels::edit');
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
