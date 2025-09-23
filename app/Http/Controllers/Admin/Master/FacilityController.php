<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Facility;
use App\Models\Master\PageDetail;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    protected $prefixRoute = 'admin.master.facility.';
    public function index()
    {
        $data['data'] = Facility::with('pageDetail')->get();
         $data['prefixRoute'] = $this->prefixRoute;
        $data['cbo']['pageDetail'] = PageDetail::select('id', 'title')->get();
        $data['title'] = 'Facility';
        return view("admin.master.facility.index", $data);
    }

    public function create(Request $request)
    { 

        $data = $request->only(['id', 'sort', 'status', 'image',
                                    'title', 
                                    'page_datail_id', 
                                    'description', 
                                ]);
        $data = (object) $data;

        if($data->id == 0){
            $sort = Facility::where('sort',$data->sort)->count();
        } else {
            $sort = Facility::where('sort',$data->sort)->where('id','!=',$data->id)->count();
        }

        if($sort != 0){
            return response()->json(['status'=> 'error', 'message' => 'Sort sudah dipakai']);
        } else {
            if(!empty($data->image)) {
                $data->image = str_replace(url('/').'/', '', $data->image);
            }

            $dataSave = collect($data)->except(['id'])->toArray();
            if($data->id == 0){
                Facility::create($dataSave);
            } else {
                Facility::where('id', $data->id)->update($dataSave);
            }
            return response()->json(['status'=>'success', 'message' => 'Data Berhasil disimpan']);
        }
    }

    public function delete($id)
    {
        Facility::findOrFail($id)->delete();
        return redirect()->route($this->prefixRoute.'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function multi_delete(Request $req)
    {
        foreach (Facility::whereIn('id', $req->id)->get() as $row) {
            Facility::findOrFail($row['id'])->delete();
        }
        return redirect()->route($this->prefixRoute.'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function editstatus($id, Request $request)
    {
        Facility::where('id', $id)->update(['status'=>$request->sts]);
        return response()->json(['status' => 'success', 'message' => 'Status Berhasil diubah']);
    }

    public function edit($id)
    {
        $data = Facility::where('id',$id)->get();
        return response()->json(['status'=>'success','data'=>$data]);
    }
}