@extends('admin.layouts.app', ['title' => $title])

@section('content')
<div class="card shadow">
    <div class="card-body pl-0 pr-0">
        <div class="row p-2">
            <div class="col-12">
                <h3><b>{{$title}}</b></h3>
            </div>
        </div>
        <x-table-btn>
            <x-slot name="thead">
                <tr>
                    <th>
                        <div class="form-check form-check-primary">
                            <input type="checkbox" class="form-check-input" id="customCheckAll" style="cursor: pointer" />
                            <label class="form-check-label" for="customCheckAll"></label>
                        </div>
                    </th>
                    <th>No</th>
                    <th>Page Detail</th> 
                    <th>Gallery Type</th> 
                    <th>Gallery</th> 
                    <th>Sort</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </x-slot>
            <x-slot name="tbody">
                @foreach ($data as $x => $item)
                <tr>
                    <td>
                        <div class="form-check form-check-primary">
                            <input type="checkbox" class="form-check-input delete-checkbox"
                                id="customCheck{{ $item->id }}" value="{{ $item->id }}" style="cursor: pointer" />
                            <label class="form-check-label" for="customCheck{{ $item->id }}"></label>
                        </div>
                    </td>
                    <td>{{ $x + 1 }}</td>
                    <td>
                        @if($item->page_datail_id)
                        @if($item->type==1)
                        <span class=""></span>
                        @elseif ($item->pageDetail->image && $item->type != 1)
                            <img src="{{ asset($item->image) }}" alt="unknown" width="40" height="40">
                        @else
                            <img src="{{ asset('assets/img/noimage.jpg') }}" style="height: 80px;" alt="Featured Image"> 
                        @endif
                        {{ $item->pageDetail->title }}
                        @else
                         unknown
                        @endif
                    </td>
                    <td class="text-center">  
                        @if($item->type == 1)
                            <span class="badge rounded-pill  bg-info">{{ $item->media ?? 'Unknown' }}</span>
                        @elseif($item->image)
                            <span class="badge rounded-pill  bg-primary">Image</span>
                        @else
                        <span class="badge rounded-pill  bg-secondary">unknown</span>
                    @endif
                </td>
                <td>{{ $item->title }}</td>
                    <td>{{ $item->sort }}</td>
                    <td>
                        <label class="switch">
                            <input type="checkbox" class="switch-input"
                                id="status{{ $item->id }}"
                                onchange="actionChangeStatusItem('{{ route($prefixRoute.'status', $item->id) }}', '{{ $item->id }}')"
                                @if ($item->status == 1) checked @endif />
                            <span class="switch-toggle-slider">
                                <span class="switch-on"></span>
                                <span class="switch-off"></span>
                            </span>
                        </label>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i data-feather="list"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="btnEditItem('{{ route($prefixRoute.'edit', $item->id) }}', '{{ $item->id }}')"><i data-feather="edit"></i> Edit</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="btnDeleteItem('{{ route($prefixRoute.'delete', $item->id) }}', '{{ $item->title }}')"><i data-feather="trash"></i> Delete</a></li>

                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="btnDeleteItem('{{ route($prefixRoute.'delete_media', $item->id) }}', 'Media {{ $item->title }}')"><i data-feather="trash-2"></i> Delete Media</a></li>

                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </x-slot>
        </x-table-btn>
    </div>
</div>

@include($prefixRoute.'._modal', ['prefixRoute' => $prefixRoute, 'title'=>$title, 'cbo'=>$cbo])
@endsection

@push('js')
    @include($prefixRoute.'_scripts')
@endpush
