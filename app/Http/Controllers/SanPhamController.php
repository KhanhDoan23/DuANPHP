<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\LoaiSanPham;
use App\Models\HinhAnh;
use App\Http\Requests\ThemMoiSanPhamRequest;


class SanPhamController extends Controller
{
    public function ThemMoiSp(){
        $dsLoaiSp=LoaiSanPham::all();
        return view('san-pham.them-moi',compact('dsLoaiSp'));
    }

    public function xuLyThemMoiSp(ThemMoiSanPhamRequest $request){

        
        $sanPham= new SanPham();
        $sanPham->ten     = $request->ten;
        $sanPham->loai_san_pham_id =$request->ten_loai;
        $sanPham->gia    = $request->gia;
        $sanPham->mo_ta     = $request->mo_ta;
        // $sanPham->so_luong    = $request->so_luong;
        $sanPham->mau= $request->mau;
        $sanPham->man_hinh    = $request->man_hinh;
        $sanPham->camera= $request->camera;
        $sanPham->he_dieu_hanh    = $request->he_dieu_hanh;
        $sanPham->chip= $request->chip;
        $sanPham->ram= $request->ram;
        $sanPham->dung_luong    = $request->dung_luong;
        $sanPham->pin= $request->pin;
        $sanPham->save();

        if(!empty($request->img)){
        $files=$request->img;
        foreach($files as $file ){
        $ha = new HinhAnh();
        $ha->san_pham_id = $sanPham -> id;
        $ha->url=$file->store('images');
        $ha->save();
        }
        }
        return redirect()->route('san-pham.danh-sach')->with('thong_bao','Thêm Thành Công');
    }

    public function DanhSachSp(){
        $dsSanPham = SanPham::all();
        $ha=HinhAnh::all();
       
        return view('san-pham/danh-sach',compact('dsSanPham','ha'));
    }

    public function XoaSp($id)
    {
        $sanPham = SanPham::find($id);
        $ha = HinhAnh::all();
        if(empty($sanPham))
        {
            return redirect()->route('san-pham.danh-sach')->with('error','sản phẩm không tồn tại');
        }
        foreach($ha as $HA){
            if($HA->san_pham_id == $sanPham->id ){
                $HA->delete();
            }
        }
        $sanPham->delete();
        
        return redirect()->route('san-pham.danh-sach')->with('thong_bao','Xóa Thành Công');

    }

    public function CapNhatSp($id){
        $dsSanPham = SanPham::find($id);
        $dsLoaiSp = LoaiSanPham::all();
        $ha=HinhAnh::all()->where('san_pham_id',$dsSanPham->id);
        return view('san-pham/cap-nhat',compact('dsSanPham','dsLoaiSp','ha'));
    }

    public function xuLyCapNhatSp(Request $request, $id)
    {
        // Lay thong tin sinh vien theo id
        $sanPham = SanPham::find($id);
        $ha=HinhAnh::all();
        if (empty($sanPham)) {
            return redirect()->route('san-pham.danh-sach')->with('error','sản phẩm không tồn tại');
        }
        $sanPham->ten     = $request->ten;
        $sanPham->loai_san_pham_id =$request->ten_loai;
        $sanPham->gia    = $request->gia;
        $sanPham->mo_ta     = $request->mo_ta;
        // $sanPham->so_luong    = $request->so_luong;
        $sanPham->mau= $request->mau;
        $sanPham->man_hinh    = $request->man_hinh;
        $sanPham->camera= $request->camera;
        $sanPham->he_dieu_hanh    = $request->he_dieu_hanh;
        $sanPham->chip= $request->chip;
        $sanPham->ram= $request->ram;
        $sanPham->dung_luong    = $request->dung_luong;
        $sanPham->pin= $request->pin;
        $sanPham->save();
        

        return redirect()->route('san-pham.danh-sach')->with('thong_bao','Cập Nhật Sản Phẩm Thành Công');
     
    }

    public function Search(Request $request)
    {

    }

    public function XemAnh($id)
    {
        $dsSanPham = SanPham::find($id);
        $ha=HinhAnh::all()->where('san_pham_id',$dsSanPham->id);
        return view('san-pham/xem-anh',compact('ha','dsSanPham'));
    }   

    public function CapNhatAnh($id)
    {
        $dsSanPham = SanPham::find($id);
        $ha=HinhAnh::all()->where('san_pham_id',$dsSanPham->id);
        
        return view('san-pham/sua-anh',compact('ha','dsSanPham'));
    }    

    public function XuLyCapNhatAnh(Request $request, $id)
    {
        

        $sanPham = SanPham::find($id);
        if(!empty($request->img)){
        $files=$request->img;
        foreach($files as $file ){
        $ha = new HinhAnh();
        $ha->san_pham_id = $sanPham -> id;
        $ha->url=$file->store('images');
        $ha->save();
        }
        }
        return redirect()->route('san-pham.cap-nhat-anh',['id' => $sanPham->id])->with('thong_bao','Thêm Thành Công');
    }
    
    public function XoaAnh($id)
    {
        
        $ha = HinhAnh::find($id);
        $sanPham = SanPham::all()->where('id',$ha->san_pham_id)->first();
        $ha->delete();  
        return redirect()->route('san-pham.cap-nhat-anh',['id' => $sanPham->id])->with('thong_bao','Xóa Thành Công');
    }
}
