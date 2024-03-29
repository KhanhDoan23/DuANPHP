<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NhaCungCap;
use App\Models\SanPham;

class HoaDonNhap extends Model
{
    use HasFactory;
    
    protected $table="hoa_don_nhap";

    public function nha_cung_cap(){
        return $this->belongsto(NhaCungCap::class);
    }
    public function chi_tiet_hoa_don_nhap(){
        return $this->hasMany(ChiTietHoaDonNhap::class);
    }
    
}
