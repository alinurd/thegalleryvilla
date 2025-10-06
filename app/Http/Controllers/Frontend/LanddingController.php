<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Master\Banner;
use App\Models\Master\Customer;
use App\Models\Master\Facility;
use App\Models\Master\PageDetail;
use Illuminate\Support\Str;

class LanddingController extends Controller
{
    public function index()
    {
        $data['banner'] = Banner::where('status', 1)->orderby('sort', 'asc')->get();
        $data['customer'] = Customer::where('status', 1)->orderby('sort', 'asc')->get();


        $data['pageDetail'] = PageDetail::with([
            'facilities' => function ($q) {
            $q->where('status', 1);
        },
        'galleries' => function ($q) {
            $q->where('status', 1);
        },
        'customers' => function ($q) {
            $q->where('status', 1);
        },
    ])
            ->where('status', 1)
            ->orderBy('sort', 'asc')
            ->get()
            ->map(function ($page) {
                return [
                    'slug' => Str::slug($page->title),
                    'name' => $page->title,
                    'facilities' => $page->facilities->map(function ($facility) {
                        return [
                            'name' => $facility->title,
                            'image' => $facility->image,
                        ];
                    })->values()->toArray(),
                    'galleries' => $page->galleries->map(function ($gallery) {
                        return [
                            'title' => $gallery->title,
                            'link' => $gallery->link,
                            'media' => $gallery->media,
                            'image' => $gallery->image,
                            'description' => $gallery->description,
                        ];
                    })->values()->toArray(),
                    'customers' => $page->customers->map(function ($customer) {
                        return [
                            'name' => $customer->name,
                            'review' => $customer->review,
                            'photo' => $customer->photo,
                        ];
                    })->values()->toArray(),
                ];
            })->toArray();

        return view('frontend.index', $data);
    }

    public function about()
    {
                $data['PageDetail'] = PageDetail::where('status', 1)->orderby('sort', 'asc')->get();


        return view('frontend.pages.about.index', $data);
    }
    public function facility()
    {
        $data['pageDetail'] = PageDetail::with([
            'facilities' => function ($q) {
            $q->where('status', 1);
        }, 
    ]) 
            ->where('status', 1)
            ->orderBy('sort', 'asc')
            ->get()
            ->map(function ($page) {
                return [
                    'slug' => Str::slug($page->title),
                    'name' => $page->title,
                    'facilities' => $page->facilities->map(function ($facility) {
                        return [
                            'name' => $facility->title,
                            'image' => $facility->image,
                        ];
                    }) ->values()->toArray(),
                ];
            })->toArray();

        return view('frontend.pages.facility.index', $data);
    }
    public function gallery()
    {
        $data['pageDetail'] = PageDetail::with([
            'facilities' => function ($q) {
            $q->where('status', 1);
        },
        'galleries' => function ($q) {
            $q->where('status', 1);
        },
        'customers' => function ($q) {
            $q->where('status', 1);
        },
    ])
            ->where('status', 1)
            ->orderBy('sort', 'asc')
            ->get()
            ->map(function ($page) {
                return [
                    'slug' => Str::slug($page->title),
                    'name' => $page->title,
                    'galleries' => $page->galleries->map(function ($gallery) {
                        return [
                            'title' => $gallery->title,
                            'link' => $gallery->link,
                            'media' => $gallery->media,
                            'image' => $gallery->image,
                            'description' => $gallery->description,
                        ];
                    }) ->values()->toArray(),
                ];
            })->toArray();

        return view('frontend.pages.gallery.index', $data);
    }
    public function booking()
    {

        return view('frontend.pages.booking.index');
    }
    public function contact()
    {

        return view('frontend.pages.contact.index');
    }
}
