@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <br>
            <div class="card">
                <div class="card-header">{{ __('อัปโหลดรูปภาพ') }}</div>

                <div class="card-body">       
                <form action="upload" method="post" enctype="multipart/form-data">  
                    @csrf  
                    <div class="btn_giverate">
                        <label for="upload-photo" class="btn_blackdefault">รูปภาพ</label>
                        <input type="file" name="file" id="upload-photo" />
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">หมวดหมู่คลังรูปภาพ</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="catalogid">
                            @foreach ($catalog as $catalog)
                          <option value="{{$catalog->c_id}}">{{$catalog->c_name}}</option>
                            @endforeach
                        </select>
                      </div>
                   <br>
                    <button type="submit" class="btn btn-secondary">อัปโหลดรูปภาพ</button>
                </form>
                </div>
                
            </div>

            <br>
            <div class="card">
                <div class="card-header">{{ __('รายการรูปภาพ') }}</div>

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">รูปภาพ</th>
                        <th scope="col">ขนาด</th>
                        <th scope="col">นามสกุล</th>
                        <th scope="col">หมวดหมู่คลังรูปภาพ</th>
                        <th scope="col">แก้ไข/ลบ</th>
                      </tr>
                    </thead>

                    @foreach ($images as $item)

                    <tbody>
                      <tr>
                      
                        <td><img src="storage/images/{{$item->name}}" width="250"></td>
                        <td>{{$item->size/1000}} kb</td>
                        <td>{{$item->mime}}</td>
                        <td>
                            @php
                            $catalogname = DB::table('catalog')->where('c_id',$item->c_id)
                            ->get();
                            @endphp
                             @php
                             $catalog2 = $catalog2 = DB::table('catalog')->get();
                             @endphp
                            @foreach ($catalogname as $catalogname)
                            {{$catalogname->c_name}}
                            @endforeach
                            <br>
                            <div class="form-group">
                                <form action="updatecatalog" method="post">
                                @csrf
                                <input type="hidden" value="{{$item->id}}" name="photoid">
                                <select class="form-control" id="exampleFormControlSelect1" name="catalogid">
                                <option value="">เลือกหมวดหมู่</option>
                                    @foreach ($catalog2 as $catalog2)
                                  <option value="{{$catalog2->c_id}}">{{$catalog2->c_name}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-secondary" data-dismiss="modal">อัปเดต</button>
                                </form>
                              </div>
                        </td>
                        
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">แก้ไข</button>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">แก้ไขรูปภาพ</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="update" method="post" enctype="multipart/form-data">  
                                            @csrf  
                                        <input type="hidden" name="photoid" value="{{$item->id}}">
                                        <div class="btn_giverate">
                                            <label for="upload-photo" class="btn_blackdefault">รูปภาพ</label>
                                            <input type="file" name="file" id="upload-photo" />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                            <button type="submit" class="btn btn-primary">อัปโหลดรูปภาพ</button>
                                          </div>
                                      </form>
                                    </div>
                                   
                                  </div>
                                </div>
                              </div>


                            <form  method="get" action="{{url('delete/'.$item->id)}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="_token" value="{{csrf_token() }}">
                                <button type="sumbit" class="btn btn-danger">ลบ</button>
                            </form>

                        </td>
                      </tr>
                    </tbody>

                    @endforeach

                  </table>

            </div>
        </div>
    </div>
</div>
@endsection
