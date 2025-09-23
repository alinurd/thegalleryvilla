<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $prefixRoute = 'admin.master.category.';

    public function index()
    {
        $data['data'] = Category::get();
        $data['prefixRoute'] = $this->prefixRoute;
        $data['title'] = 'Categorys';
        return view("admin.master.category.index", $data);
    }

    public function create(Request $request)
    {
        $data = $request->only(['id', 'sort', 'status', 'title', 'description', 'image','title_id']);
        $data = (object) $data;

        if($data->id == 0){
            $sort = Category::where('sort',$data->sort)->count();
        } else {
            $sort = Category::where('sort',$data->sort)->where('id','!=',$data->id)->count();
        }

        if($sort != 0){
            return response()->json(['status'=> 'error', 'message' => 'Sort sudah dipakai']);
        } else {
            if(!empty($data->image)) {
                $data->image = str_replace(url('/').'/', '', $data->image);
            }

            $dataSave = collect($data)->except(['id'])->toArray();
            if($data->id == 0){
                Category::create($dataSave);
            } else {
                Category::where('id', $data->id)->update($dataSave);
            }
            return response()->json(['status'=>'success', 'message' => 'Data Berhasil disimpan']);
        }
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route($this->prefixRoute.'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function multi_delete(Request $req)
    {
        foreach (Category::whereIn('id', $req->id)->get() as $row) {
            Category::findOrFail($row['id'])->delete();
        }
        return redirect()->route($this->prefixRoute.'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function editstatus($id, Request $request)
    {
        Category::where('id', $id)->update(['status'=>$request->sts]);
        return response()->json(['status' => 'success', 'message' => 'Status Berhasil diubah']);
    }

    public function edit($id)
    {
        $data = Category::where('id',$id)->get();
        return response()->json(['status'=>'success','data'=>$data]);
    }
}