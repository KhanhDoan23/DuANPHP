@extends('trangchu')
@section('content')
<div class="table-responsive">
<a href="{{route('loai-san-pham.them-moi')}}"><button type="submit" class="btn btn-info">Thêm mới</button></a>
        <table class="table table-striped table-sm " border="1">
        <h3>Danh Sách Loại Sản Phẩm</h3> 
       
          <thead>
            <tr class = "table-dark">
                <th>ID</th>
                <th>Tên Loại</th>
                <th style="width: 150px;text-align:center;">Thao Tác</th>
            </tr>
          </thead>
          <tbody>
            @foreach($dsLoaiSp as $LoaiSp)
            <tr>
                <td>{{ $LoaiSp->id }}</td>
                <td>{{ $LoaiSp->ten_loai}}</td>
                <td> <a href="{{route('loai-san-pham.cap-nhat',['id'=>$LoaiSp->id])}}"><button type="submit" class="btn btn-success">Sửa</button></a> | <a href="{{route('loai-san-pham.xoa', ['id'=>$LoaiSp->id] ) }}"><button type="button" style="height: 33px; width: 50px;" class="btn btn-danger btn-sm px-3"><i class="glyphicon glyphicon-remove"></i></button></a></td>
            <tr>
             
            @endforeach
            </tbody>  
</table>
@endsection