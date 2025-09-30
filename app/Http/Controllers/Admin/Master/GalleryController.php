<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Gallery;
use App\Models\Master\PageDetail;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    protected $prefixRoute = 'admin.master.gallery.';
    public function index()
    {
        $data['data'] = Gallery::with('pageDetail')->get();
         $data['prefixRoute'] = $this->prefixRoute;
        $data['cbo']['pageDetail'] = PageDetail::select('id', 'title')->get();
        $data['title'] = 'Photo Gallery';
        return view("admin.master.gallery.index", $data);
    }

    public function create(Request $request)
    { 

        $data = $request->only(['id', 'sort', 'status', 'image',
                                    'title', 
                                    'page_datail_id', 
                                    'description', 
                                    'type', 
                                    'link', 
                                    'media', 
                                ]);
        $data = (object) $data;

        if($data->id == 0){
            $sort = Gallery::where('sort',$data->sort)->count();
        } else {
            $sort = Gallery::where('sort',$data->sort)->where('id','!=',$data->id)->count();
        }

        if($sort != 0){
            return response()->json(['status'=> 'error', 'message' => 'Sort sudah dipakai']);
        } else {
            if(!empty($data->image)) {
                $data->image = str_replace(url('/').'/', '', $data->image);
            }

            $dataSave = collect($data)->except(['id'])->toArray();
            if($data->id == 0){
                Gallery::create($dataSave);
            } else {
                Gallery::where('id', $data->id)->update($dataSave);
            }
            return response()->json(['status'=>'success', 'message' => 'Data Berhasil disimpan']);
        }
    }

    public function delete($id)
    {
        Gallery::findOrFail($id)->delete();
        return redirect()->route($this->prefixRoute.'index')->withSuccess('Data Berhasil dihapus!');
    }
   public function deleteMedia($id, $media=0)
{
    $upd = [];

    if ($media == 1) { 
        $upd['link'] = null;
        $upd['media'] = null;
    } elseif ($media == 2) { 
        $upd['image'] = null;
    } elseif ($media == 0) { 
        $upd['link'] = null;
        $upd['media'] = null;
        $upd['image'] = null;
    }

    Gallery::where('id', $id)->update($upd);

    return redirect()
        ->route($this->prefixRoute . 'index')
        ->withSuccess('Media berhasil dihapus!');
}


    public function multi_delete(Request $req)
    {
        foreach (Gallery::whereIn('id', $req->id)->get() as $row) {
            Gallery::findOrFail($row['id'])->delete();
        }
        return redirect()->route($this->prefixRoute.'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function editstatus($id, Request $request)
    {
        Gallery::where('id', $id)->update(['status'=>$request->sts]);
        return response()->json(['status' => 'success', 'message' => 'Status Berhasil diubah']);
    }

    public function edit($id)
    {
        $data = Gallery::where('id',$id)->get();
        return response()->json(['status'=>'success','data'=>$data]);
    }
}