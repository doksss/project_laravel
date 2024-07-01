<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDOException;

class HotelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $hotels = DB::table('hotels')->get();
        $hotels = Hotel::all(); //pake Eloquent ORM
        $type = Type::all();
        return view('frontend.hotel-list', ['data' => $hotels, 'type'=>$type]); //ke folder index.blade.php dan mengirim data dengan key 'data' valuenya hotels
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Hotel::find($id);
        $type = Type::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('hotel.getEditForm', ['data' => $data, 'type' => $type])->render()
        ), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type = Type::all();
        return view('hotel.create', ['type' => $type]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Hotel();
        $data->name = $request->get('hotel_name');
        $data->address = $request->get('hotel_address'); //ambil name dari textfieldnya
        $data->nomor_telepon = $request->get('hotel_phone'); //ambil name dari textfieldnya
        $data->hotel_type = $request->get('hotel_type');
        $data->email = $request->get('hotel_email');
        $data->save();

        //confirmation
        return redirect()->route('hotels.index')->with('status', 'Hooray ! your data is successfully recorded!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $type = Type::all();
        $data = Hotel::find($id);
        return view('hotel.edit', ['data' => $data, 'type' => $type]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Hotel::find($id);
        $data->name = $request->get('hotel_name');
        $data->address = $request->get('hotel_address'); //ambil name dari textfieldnya
        $data->nomor_telepon = $request->get('hotel_phone'); //ambil name dari textfieldnya
        $data->hotel_type = $request->get('hotel_type');
        $data->email = $request->get('hotel_email');
        $data->update();
        return redirect()->route('hotels.index')->with('status', 'Yesss! your data is successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $this->authorize('delete-permission', $user);
        try {
            $data = Hotel::find($id);
            $data->delete();
            return redirect()->route('hotels.index')->with('status', 'Yesss! your data is successfully Deleted!');
        } catch (PDOException $ex) {
            $msg = "Failed to delete data!, Make sure there is no related data before deleting it!";
            return redirect()->route('hotels.index')->with('status', $msg);
        }
    }
    public function availableHotelRoom()
    {
        $data = Hotel::join('products as p', 'hotels.id', '=', 'p.hotel_id')
            ->select('hotels.id', 'hotels.name', DB::raw('sum(p.available_room)as room'))
            ->groupBy('hotels.id', 'hotels.name')
            ->get();
        // dd($data);
        return view('hotel.availableRoom', compact('data'));
    }
    public function averagePriceHotel()
    {
        $data = Hotel::leftjoin('products as p', 'hotels.id', '=', 'p.hotel_id')
            ->join('types as t', 'hotels.hotel_type', '=', 't.id')
            ->select('t.name as type_name', 'hotels.name', DB::raw('AVG(p.price)as avg_price'))
            ->groupBy('t.name', 'hotels.name')
            ->get();
        // dd($data);
        return view('hotel.avgPriceByHotelType', compact('data'));
    }
    public function showInfo()
    {
        return response()->json(array(
            'status' => 'oke',
            'msg' => "<div class='alert alert-info'>
             Did you know? <br>This message is sent by a Controller.'</div>"
        ), 200);
    }
    public function uploadLogo(Request $request)
    {
        $hotel_id = $request->hotel_id;
        $hotel = Hotel::find($hotel_id);
        return view('hotel.formUploadLogo', compact('hotel'));
    }
    public function simpanLogo(Request $request)
    {
        $file = $request->file("file_logo");
        $folder = 'logo';
        $filename = $request->hotel_id . ".jpg";
        $file->move($folder, $filename);
        return redirect()->route('hotels.index')->with('status', 'logo terupload');
    }

    public function uploadPhoto(Request $request)
    {
        $hotel_id = $request->hotel_id;
        $hotel = Hotel::find($hotel_id);
        return view('hotel.formUploadPhoto', compact('hotel'));
    }
    
    public function simpanPhoto(Request $request)
    {
        $file = $request->file("file_photo");
        $folder = 'images';
        $filename = time() . "_" . $file->getClientOriginalName();
        $file->move($folder, $filename);
        $hotel = Hotel::find($request->hotel_id);
        $hotel->image = $filename;
        $hotel->save();
        return redirect()->route('hotels.index')->with('status', 'photo terupload');
    }
}
