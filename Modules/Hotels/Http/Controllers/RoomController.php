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
use Illuminate\Support\Facades\Input;
use Modules\Hotels\Entities\HotelType;
use Modules\Hotels\Entities\Supplier;
use App\User;
use Modules\UserManagement\Entities\Profile;
use Modules\Hotels\Entities\RoomType;
use Modules\Hotels\Entities\BedType;
use Modules\Hotels\Entities\SupplierAmenty;
use Modules\Hotels\Entities\Hotel;
use Modules\Hotels\Entities\HotelRoom;
use Modules\Hotels\Entities\HotelRoomGallery;
use Modules\Hotels\Entities\HotelRoomAmentity;
use PDF;


class RoomController extends Controller
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
        if(Entrust::can("manage-hotel-rooms")){
            $data['page_title']="Hotel Rooms";
          return view('hotels::rooms.index',$data);  
      }else{
        return view("forbidden");
      }
        
    }


    public function getAdminRooms(){
    if(Entrust::hasRole("Admin"))
    {
        $data['page_title']="Hotel Rooms";
          return view('hotels::rooms.admin_index',$data);  
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



        if(Entrust::can("manage-hotel-rooms")){
            $data['page_title']="Create Hotel Room";
            $data['url']=url()->current();

             if($request->isMethod("post")){
                $data=$request->all();
                DB::beginTransaction();

                $number=$data['no_of_similar_rooms'];
                $room_code=substr(number_format(time() * rand(),0,'',''),0,9);
               


                for($i=1;$i<=$number;$i++)
                {
                     $room_number=$data['room_start_key'].$i;
                $room=HotelRoom::where(['user_id'=>auth::user()->id,'supplier_id'=>auth::user()->supplier->id,'room_name'=>$data['room_name'],'hotel_id'=>$data['hotel_id'],'room_number'=>$room_number])->first();
                  if(!$room){
                    $room=new HotelRoom();
                    $room->room_code=$room_code;
                    $room->room_number=$room_number;
                   }
                 

               
                $room->user_id=auth::user()->id;
                $room->supplier_id=auth::user()->supplier->id;
                $room->hotel_id=$data['hotel_id'];
                $room->room_name=$data['room_name'];
                $room->bed_type=$data['bed_type'];
                $room->room_size=$data['room_size'];
                $room->room_capacity=$data['room_capacity'];
                $room->occupants=$data['occupants'];
                $room->room_start_key=$data['room_start_key'];
                $room->currency=$data['currency'];
                $room->room_description=$data['room_description'];
                $room->local_price_off_peak_night=$data['local_price_off_peak_night'];
                $room->no_of_similar_rooms=$data['no_of_similar_rooms'];
                
                $room->no_of_bathrooms=$data['no_of_bathrooms'];
                $room->save();

                 }
            
             $images=$data['images'];
             $this->createRoomImages($room->room_code,$data);
             $this->createRoomAmentities($room->room_code,$data);
             DB::commit();
             Session::flash("success_msg",$number." Rooms Added successfully");
             return redirect('/hotels/rooms/index');
             }

           $data['bed_types']=BedType::where(['supplier_id'=>auth::user()->supplier->id])->get();
            $data['room_name']=RoomType::where(['supplier_id'=>auth::user()->supplier->id])->get();
            $data['amentities']=$amentity_list=SupplierAmenty::where(['supplier_id'=>auth::user()->supplier->id,'category'=>'Room Amentity'])->orwhere(['category'=>'Both','supplier_id'=>auth::user()->supplier->id])->get();
            $data['available_amentities']=array();
            $data['model']=new HotelRoom();
            $data['hotels']=Hotel::where(['supplier_id'=>auth::user()->supplier->id])->get();
            $data['currencies']=config('app.system_currency');

           
            return view('hotels::rooms.create',$data);

        }else{
            return view("forbidden");
        }
        
    }


    public function createRoomImages($hotel_code,$data){
        //dd($hotel_code);
        $amentities=$data['images'];

        $models=HotelRoomGallery::where(['hotel_id'=>$data['hotel_id'],'supplier_id'=>auth::user()->supplier->id,'user_id'=>auth::user()->id,'room_code'=>$hotel_code])->get();
            foreach($models as $deleteKey){
                $deleteKey->delete();
            }
            

            $images=explode(',',$amentities);
             foreach($images as $key=>$value){
                 if(!empty($value)){
                    try{
                    $model=new HotelRoomGallery();
                    $model->user_id=auth::user()->id;
                    $model->supplier_id=auth::user()->supplier->id;
                    $model->room_code=$hotel_code;
                    $model->hotel_id=$data['hotel_id'];
                    $model->image_id=$value;
                    $model->save();
                    }catch(\Exception $e)
                    {
                         Helper::sendEmailToSupport($e);
                         return false;

                    }
                    
                 }
             }
       return true;
     }


     public function createRoomAmentities($hotel_code,$data){
         
          $amentities=$data['amenities'];

        $models=HotelRoomAmentity::where(['hotel_id'=>$data['hotel_id'],'supplier_id'=>auth::user()->supplier->id,'user_id'=>auth::user()->id,'room_code'=>$hotel_code])->get();
            foreach($models as $deleteKey){
                $deleteKey->delete();
            }
        foreach($amentities as $key=>$value){
                if(!empty($value)){
                    try{
                    $model=new HotelRoomAmentity();
                    $model->user_id=auth::user()->id;
                    $model->supplier_id=auth::user()->supplier->id;
                    $model->room_code=$hotel_code;
                    $model->hotel_id=$data['hotel_id'];
                    $model->amentity_id=$value;
                    $model->save();
                    }catch(\Exception $e)
                    {
                         Helper::sendEmailToSupport($e);
                         return false;

                    }
                    
                 }
        }

        return true;

     }

     public function fetchRooms(){
        $models=HotelRoom::join('hotels','hotels.id','=','hotel_rooms.hotel_id')->where(['hotel_rooms.supplier_id'=>auth::user()->supplier->id]);
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
                        <li data-title="Delete Hotel" data-name="Hotel" class="delete-record"   data-redirect-to="'.$index_url.'"  data-href="'.$delete_url.'" ><a href="#">Delete</a></li>

                       
                        <li><a href="'.$audit_url.'">Audit Trail</a></li>

                        
                      </ul>
                    </div> ';
   })->make(true);
     }

     public function fetchAdminRooms(){
         $models=HotelRoom::join('service_suppliers','service_suppliers.id','=','hotel_rooms.supplier_id')->select('hotel_rooms.id','room_name','room_capacity','bed_type','name','currency','local_price_off_peak_night','occupants');
        return Datatables::of($models)->make(true);

     }

     public function RoomReport(Request $request){
         if(Entrust::can("manage-hotel-rooms")){

            if($request->isMethod("post")){
                $data=$request->all();
                $type=$data['report_type'];
                 if($type=="Pdf"){
                    $this->generatePdf($data);
                    return redirect()->back();

                 }else
                 {
                     $this->generateExcel($data);
                     return redirect()->back();
                  }
              }
            $data['url']=url()->current();
            $data['hotels']=Hotel::where(['supplier_id'=>auth::user()->supplier->id])->get();
            $data['bed_types']=HotelRoom::where(['supplier_id'=>auth::user()->supplier->id])->select('bed_type')->distinct()->get();
            $data['room_names']=HotelRoom::where(['supplier_id'=>auth::user()->supplier->id])->select('room_name')->distinct()->get();
             $data['status']=HotelRoom::where(['supplier_id'=>auth::user()->supplier->id])->select('current_status')->distinct()->get();

               return view('hotels::rooms.room_reports',$data);

         }else{
            return "<h5 class='text-center' style='color:red'><strong>Access Denied</strong></h5>";
         }

     }

     public function generatePdf($data){
         $action=$data['action'];
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
       $query=HotelRoom::join('hotels','hotels.id','=','hotel_rooms.hotel_id')->where(['hotel_rooms.supplier_id'=>auth::user()->supplier->id]);
        if(Input::has('hotel_name')){
           $query=$query->where(['hotels.hotel_name'=>Input::get('hotel_name')]);
         }
         if(Input::has('room_name')){
            $query=$query->where(['room_name'=>Input::get('room_name')]);
         }
          if(Input::has('bed_type')){
            $query=$query->where(['bed_type'=>Input::get('bed_type')]);
         }

          if(Input::has('current_status')){
            $query=$query->where(['current_status'=>Input::get('current_status')]);
         }
         $query=$models=$query->take(500)->get();
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
      $html="<label style='margin-left:70%;'>List of Rooms Under ".auth::user()->supplier->name."</label>";
      PDF::writeHTML($html, true, false, true ,false, '');


      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::Ln();

$html ="
<style>table{border-radius:4px;border:1px solid green;}table td{text-align:left} table th #m{border-left:1px solid black;}table td #m{border-left:1px solid black;} th{text-align:left;background-color:#F2F2F2;font-weight:bold;font-size:11pts;border-bottom:1px solid black;border-right:1px solid black;}td{background-color:white;border-bottom:1px solid black}</style><table><thead>
  <tr><th>ID</th><th colspan='2'>Hotel</th><th>Room Name</th><th>Number</th><th>Bed Type</th><th>Occupants</th><th>Capacity</th><th>Curency</th><th>Price</th>";
   $html.="                                       
  <th>Status</th>                                                                     
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
  <td>".$key->room_name." </td>
  <td>".$key->room_number." </td>
  <td>".$key->bed_type." </td>
  <td>".$key->occupants."</td>
  <td>".$key->room_capacity."</td>
  <td>".$key->currency."</td>
  <td>".$key->local_price_off_peak_night."</td>
  <td>".$key->current_status."</td>
     

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
        PDF::Output('rooms_list.pdf');
    }else{
    $destinationPath = base_path() . '/storage/rooms/report';
    $filename=str_slug(auth::user()->supplier->name).".pdf";
    $fileNL = $destinationPath."/".$filename; //Linux
    PDF::Output($fileNL,'F');
    $paths=array($fileNL);
    $email=auth::user()->email;
                 $mail=\Mail::send('emails.send_report',['email'=>$email ], function($message) use ($paths,$email) {
                     $message->to($email, "Room List Report");
                   foreach($paths as $path){
                    $message->attach($path);
                   }
                   $message->subject('Room List Report');
                   });
                  Session::flash("success_msg","Report Genarated Successfully");
             

    }

     }

     public function generateExcel($data){
      $action=$data['action'];
          if($action=="Genarate"){
            $oreintation="landscape";
              $format="Xls";
         \Excel::create('records', function($excel) use($oreintation,$format,$data) {
          $excel->sheet('Sheet1', function($sheet) use($oreintation,$format,$data) {
             $query=HotelRoom::join('hotels','hotels.id','=','hotel_rooms.hotel_id')->where(['hotel_rooms.supplier_id'=>auth::user()->supplier->id]);
        if(Input::has('hotel_name')){
           $query=$query->where(['hotels.hotel_name'=>Input::get('hotel_name')]);
         }
         if(Input::has('room_name')){
            $query=$query->where(['room_name'=>Input::get('room_name')]);
         }
          if(Input::has('bed_type')){
            $query=$query->where(['bed_type'=>Input::get('bed_type')]);
         }

          if(Input::has('current_status')){
            $query=$query->where(['current_status'=>Input::get('current_status')]);
         }
         $query=$models=$query->take(1000)->get();
               $arr =array();
                  foreach($models as $key) {
                     $name=$key->hotel_name;
                     $code=$key->hotel_code;
                     $phone=$key->room_name;
                     $email=$key->room_code;
                     $number=$key->room_number;
                     $type=$key->bed_type;
                     $star=$key->hotel_start;
                     $city=$key->hotel_city;
                     $state=$key->hotel_state;
                     $country=$key->hotel_country;
                     $postal_address=$key->postal_address;
                     $room_size=$key->room_size;
                     $capacity=$key->room_capacity;
                     $occupants=$key->occupants;
                     $bath=$key->no_of_bathrooms;
                     $currency=$key->currency;
                     $price=$key->local_price_off_peak_night;
                     $status=$key->current_status;
                     $views=($key->room_views!=null)?$key->room_views:"0";
                     $likes=($key->room_likes!=null)?$key->room_likes:"0";
                     $data =array($name,$code,$phone,$email,$number,$type,$room_size,$capacity,$occupants,$bath,$currency,$price,$status,$views,$likes);
                    array_push($arr, $data);
                    }
               $sheet->fromArray($arr,null,'A2',false,false)->prependRow(array(
                       'Hotel Name','Hotel Code','Room Name','Room Code','Room Number','Bed Type','Room Size','Capacity','Occupants','No of Bathrooms','Currency','Price Per Night','Status','No of Views','No of Likes',
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
         \Excel::create($name,function($excel) use($oreintation,$format,$data) {
          $excel->sheet('Sheet1', function($sheet) use($oreintation,$format,$data) {
             $query=HotelRoom::join('hotels','hotels.id','=','hotel_rooms.hotel_id')->where(['hotel_rooms.supplier_id'=>auth::user()->supplier->id]);
        if(Input::has('hotel_name')){
           $query=$query->where(['hotels.hotel_name'=>Input::get('hotel_name')]);
         }
         if(Input::has('room_name')){
            $query=$query->where(['room_name'=>Input::get('room_name')]);
         }
          if(Input::has('bed_type')){
            $query=$query->where(['bed_type'=>Input::get('bed_type')]);
         }

          if(Input::has('current_status')){
            $query=$query->where(['current_status'=>Input::get('current_status')]);
         }
         $query=$models=$query->take(1000)->get();
               $arr =array();
                  foreach($models as $key) {
                     $name=$key->hotel_name;
                     $code=$key->hotel_code;
                     $phone=$key->room_name;
                     $email=$key->room_code;
                     $number=$key->room_number;
                     $type=$key->bed_type;
                     $star=$key->hotel_start;
                     $city=$key->hotel_city;
                     $state=$key->hotel_state;
                     $country=$key->hotel_country;
                     $postal_address=$key->postal_address;
                     $room_size=$key->room_size;
                     $capacity=$key->room_capacity;
                     $occupants=$key->occupants;
                     $bath=$key->no_of_bathrooms;
                     $currency=$key->currency;
                     $price=$key->local_price_off_peak_night;
                     $status=$key->current_status;
                     $views=($key->room_views!=null)?$key->room_views:"0";
                     $likes=($key->room_likes!=null)?$key->room_likes:"0";
                     $data =array($name,$code,$phone,$email,$number,$type,$room_size,$capacity,$occupants,$bath,$currency,$price,$status,$views,$likes);
                    array_push($arr, $data);
                    }
               $sheet->fromArray($arr,null,'A2',false,false)->prependRow(array(
                       'Hotel Name','Hotel Code','Room Name','Room Code','Room Number','Bed Type','Room Size','Capacity','Occupants','No of Bathrooms','Currency','Price Per Night','Status','No of Views','No of Likes',
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
          $email=Auth::user()->email;
          $exl_path=base_path() . '/storage/exports/'.$name.'.xls';
                  $paths=array($exl_path);
                  $mail=\Mail::send('emails.send_report',['email'=>$email ], function($message) use ($paths,$email) {
                     $message->to($email, "Room List Report");
                   foreach($paths as $path){
                    $message->attach($path);
                   }
                   $message->subject('Room List Report');
                   });
                  Session::flash("success_msg","Room List Report Emailed Successfully");
                  return redirect()->back();

                 }

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
