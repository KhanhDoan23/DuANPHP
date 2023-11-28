<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiSanPham;
class LoaiSanPhamController extends Controller
{
    public function ThemMoiLoaiSp()
    {
        return view('loai-san-pham/them-moi');
    }
    public function XuLyThemMoiLoai(Request $request)
    {
        $LoaiSp= new LoaiSanPham();
        $LoaiSp->ten_loai    = $request->ten_loai;
        $LoaiSp->save();
        return redirect()->route('loai-san-pham.danh-sach')->with('thong_bao','Thêm Thành Công');

    }

    public function DanhSachLoaiSp(){
        $dsLoaiSp=LoaiSanPham::all();
        return view('loai-san-pham/danh-sach',compact('dsLoaiSp'));
    }
    public function XoaLoaiSp($id){
        $LoaiSp = LoaiSanPham::find($id);
        if(empty($LoaiSp))
        {
         return "Loai San Pham Khong ton tai";
        }
        $LoaiSp->delete();
        return redirect()->route('loai-san-pham.danh-sach')->with('thong_bao','Xóa Thành Công');
 
     }
 
     public function CapNhatLoaiSp($id){
         $dsLoaiSp = LoaiSanPham::find($id);
         return view('loai-san-pham/cap-nhat',compact('dsLoaiSp'));
         
     }
 
     public function XuLyCapNhatLoaiSp(Request $request, $id)
     {
  
         $LoaiSp = LoaiSanPham::find($id);
         if (empty($LoaiSp)) {
             return "Loại sản phẩm Không Tồn Tại";
         }
         $LoaiSp->ten_loai    = $request->ten_loai;
         $LoaiSp->save();
 
         return redirect()->route('loai-san-pham.danh-sach')->with('thong_bao','Cập nhật loại sản phẩm thành công');
     }

}