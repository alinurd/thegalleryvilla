<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\PageDetail;
use Illuminate\Http\Request;

class PageDetailController extends Controller
{
    protected $prefixRoute = 'admin.master.page-detail.';
    public function index()
    {
        $data['data'] = PageDetail::get();
        $data['prefixRoute'] = $this->prefixRoute;
        $data['title'] = 'PageDetails';
        return view("admin.master.page-detail.index", $data);
    }

    public function create(Request $request)
    { 

        $data = $request->only(['id', 'sort', 'status', 'image',
                                    'title', 
                                    'about', 
                                    'location', 
                                    'facility', 
                                    'event_type', 
                                    'pin_point', 
                                    'address', 
                                ]);
                                $latitude  = $request->latitude;
    $longitude = $request->longitude;
    $pinPoint  = $request->pin_point;

    if (!empty($latitude) && !empty($longitude)) {
    $pinPoint = "https://www.google.com/maps?q={$latitude},{$longitude}";
    } elseif (!empty($pinPoint)) {
        $latitude  = null;
        $longitude = null;
    }
$data = array_merge($data, [
    'latitude'  => $latitude,
    'longitude' => $longitude,
    'pin_point' => $pinPoint,
]);
        $data = (object) $data;

        if($data->id == 0){
            $sort = PageDetail::where('sort',$data->sort)->count();
        } else {
            $sort = PageDetail::where('sort',$data->sort)->where('id','!=',$data->id)->count();
        }

        if($sort != 0){
            return response()->json(['status'=> 'error', 'message' => 'Sort sudah dipakai']);
        } else {
            if(!empty($data->image)) {
                $data->image = str_replace(url('/').'/', '', $data->image);
            }

            $dataSave = collect($data)->except(['id'])->toArray();
            if($data->id == 0){
                PageDetail::create($dataSave);
            } else {
                PageDetail::where('id', $data->id)->update($dataSave);
            }
            return response()->json(['status'=>'success', 'message' => 'Data Berhasil disimpan']);
        }
    }

    public function delete($id)
    {
        PageDetail::findOrFail($id)->delete();
        return redirect()->route($this->prefixRoute.'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function multi_delete(Request $req)
    {
        foreach (PageDetail::whereIn('id', $req->id)->get() as $row) {
            PageDetail::findOrFail($row['id'])->delete();
        }
        return redirect()->route($this->prefixRoute.'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function editstatus($id, Request $request)
    {
        PageDetail::where('id', $id)->update(['status'=>$request->sts]);
        return response()->json(['status' => 'success', 'message' => 'Status Berhasil diubah']);
    }

    public function edit($id)
    {
        $data = PageDetail::where('id',$id)->get();
        return response()->json(['status'=>'success','data'=>$data]);
    }
}