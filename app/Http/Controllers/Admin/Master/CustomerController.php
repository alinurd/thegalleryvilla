<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Customer;
use App\Models\Master\PageDetail;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $prefixRoute = 'admin.master.customer.';

    public function index()
    {
        $data['data'] = Customer::with('pageDetail')->get();
        $data['prefixRoute'] = $this->prefixRoute;
        $data['cbo']['pageDetail'] = PageDetail::select('id', 'title')->where('status',1)->get();
        $data['title'] = 'Customer';
        return view("admin.master.customer.index", $data);
    }

    public function create(Request $request)
    {
        $data = $request->only(['id', 'sort', 'status', 'title', 'description', 'image','title_id','page_datail_id']);
        $data = (object) $data;

        if($data->id == 0){
            $sort = Customer::where('sort',$data->sort)->count();
        } else {
            $sort = Customer::where('sort',$data->sort)->where('id','!=',$data->id)->count();
        }

        if($sort != 0){
            return response()->json(['status'=> 'error', 'message' => 'Sort sudah dipakai']);
        } else {
            if(!empty($data->image)) {
                $data->image = str_replace(url('/').'/', '', $data->image);
            }

            $dataSave = collect($data)->except(['id'])->toArray();
            if($data->id == 0){
                Customer::create($dataSave);
            } else {
                Customer::where('id', $data->id)->update($dataSave);
            }
            return response()->json(['status'=>'success', 'message' => 'Data Berhasil disimpan']);
        }
    }

    public function delete($id)
    {
        Customer::findOrFail($id)->delete();
        return redirect()->route($this->prefixRoute.'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function multi_delete(Request $req)
    {
        foreach (Customer::whereIn('id', $req->id)->get() as $row) {
            Customer::findOrFail($row['id'])->delete();
        }
        return redirect()->route($this->prefixRoute.'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function editstatus($id, Request $request)
    {
        Customer::where('id', $id)->update(['status'=>$request->sts]);
        return response()->json(['status' => 'success', 'message' => 'Status Berhasil diubah']);
    }

    public function edit($id)
    {
        $data = Customer::where('id',$id)->get();
        return response()->json(['status'=>'success','data'=>$data]);
    }
}