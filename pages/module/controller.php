<?php
include 'connect.php';
class sanpham
{
    private $conn;
    function __construct()
    {
        $this->conn = new connect;
    }
    function danhsachsp()
    {
        $this->conn->constructor();
        $strSQL = "SELECT *
                   FROM sanpham
                   INNER JOIN thuonghieu ON sanpham.MaTH = thuonghieu.MaTH
                   INNER JOIN danhmucsp ON sanpham.MaDM = danhmucsp.MaDM
                   WHERE `TrangThai`='1'";
        $result = $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function sanpham($masp)
    {
        $this->conn->constructor();
        $strSQL = "SELECT * FROM `sanpham` WHERE MaSP='" . $masp . "'";
        $result = $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function timsanpham($ten){
        $this->conn->constructor();
        $strSQL = "SELECT * FROM `sanpham` WHERE `TenSP`LIKE '%".$ten."%'";
        $result = $this->conn->excuteSQL($strSQL);
        // $result['CountRow']=mysqli_num_rows($result);
        $this->conn->disconnect();
        return $result;
    }
    function search($ten){
        $this->conn->constructor();
        $strSQL = "SELECT *
                   FROM sanpham
                   INNER JOIN thuonghieu ON sanpham.MaTH = thuonghieu.MaTH
                   WHERE LIKE '%".$ten."%'";
        $result = $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function xoasanpham($masp){
        $this->conn->constructor();
        $strSQL = "UPDATE `sanpham` SET `TrangThai`='0' WHERE  MaSP='" . $masp . "'";
        $result = $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function dssanpham(){
        $this->conn->constructor();
        $strSQL="SELECT * FROM `sanpham` WHERE 1";
        $result=$this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    
    function suasanpham($masp,$giaban,$gianhap){
        $this->conn->constructor();
        $strSQL="UPDATE `sanpham` SET `GiaSP`=$giaban, GiaNhap=$gianhap
        WHERE MaSP =$masp";
        $result=$this->conn->excuteSQL($strSQL);
        return $result;
    }
    function UpdateAnh($masp,$linkanh){
        $this->conn->constructor();
        $strSQL="UPDATE `sanpham` SET`HinhAnh`='".$linkanh."' WHERE MaSP='".$masp."'";
        $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
    }
    function ThemSP($data){
        $this->conn->constructor();
        $strSQL="SELECT COUNT(*) AS total FROM sanpham;";
        $result=$this->conn->excuteSQL($strSQL);
        $row=mysqli_fetch_assoc($result);
        $masp=$row['total'];
        $strSQL="INSERT INTO `sanpham`(`MaSP`, `TenSP`, `SoLuongSP`, `GiaSP`, `MaTH`, `MaDM`, `TrangThai`,`HinhAnh`) 
        VALUES ('".$masp."','".$data->TenSP."','".$data->SoLuongSP."','".$data->GiaSP."','".$data->MaTH."','".$data->TenDM."','1','".$data->HinhAnh."')";
        $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
}
class banhang
{
    private $conn;
    function __construct()
    {
        $this->conn = new connect;
    }
    function ngay($date)
    {
        $this->conn->constructor();
        $strSQL = "SELECT * 
        FROM chitietdonhang
        LEFT JOIN sanpham ON chitietdonhang.MaSP = sanpham.MaSP
        LEFT JOIN donhang ON donhang.MaDonHang=chitietdonhang.MaDonHang
        WHERE  donhang.NgayDatHang='" . $date . "'";
        $result = $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function timdonhang($madon)
    {
        $this->conn->constructor();
        $strSQL = "SELECT * 
        FROM chitietdonhang
        LEFT JOIN sanpham ON chitietdonhang.MaSP = sanpham.MaSP
        LEFT JOIN donhang ON donhang.MaDonHang=chitietdonhang.MaDonHang
        WHERE  donhang.MaDonHang='" . $madon . "'";

        $result = $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function timtheoSDT($sdt){
        $this->conn->constructor();
        $strSQL="SELECT * FROM `donhang` WHERE `MTaiKhoan`='".$sdt."'";
        $result=$this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function timtheoID($id){
        $this->conn->constructor();
        $strSQL="SELECT * FROM `donhang` WHERE `MaDonHang`='".$id."'";
        $result=$this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function khoangtime($from,$to){
        $this->conn->constructor();
        $strSQL = "SELECT * 
        FROM chitietdonhang
        LEFT JOIN sanpham ON chitietdonhang.MaSP = sanpham.MaSP
        LEFT JOIN donhang ON donhang.MaDonHang=chitietdonhang.MaDonHang
        WHERE NgayDatHang BETWEEN '" . $from . "' AND '" . $to . "'";
        // echo $strSQL;
        $result = $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
}
class taikhoan
{
    private $conn;
    function __construct()
    {
        $this->conn = new connect;
    }
    function timtk($sdt)
    {
        $this->conn->constructor();
        $strSQL = "SELECT * FROM `taikhoan` WHERE SDT='" . $sdt . "' AND TrangThai='active' ";
        $result = $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function themtk($data)
    {
        $this->conn->constructor();
        $strSQL = "INSERT INTO `taikhoan`(`UserName`, `MatKhau`, `SDT`, `TenNhomQuyen`, `TrangThai`, `DiaChi`) 
            VALUES ('" . $data->UserName . "','" . $data->MatKhau . "','" . $data->SDT . "','KH', 'active','".$data->DiaChi."')";
        $result = $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function xoatk($sdt)
    {
        $this->conn->constructor();
        $strSQL = "UPDATE `taikhoan` SET `TrangThai`='deleted' WHERE SDT='".$sdt."' ";
        $result = $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function suatk($data)
    {
        $this->conn->constructor();
        $strSQL = "UPDATE `taikhoan` 
        SET `UserName`='" . $data->UserName . "',`MatKhau`='" . $data->MatKhau . "'WHERE SDT='" . $data->SDT . "'";
        $result = $this->conn->excuteSQL($strSQL);
        return $result;
    }
    function suaquyen($data){
        $this->conn->constructor();
        $strSQL="UPDATE `taikhoan` SET `TenNhomQuyen`='".$data->quyen."' WHERE `SDT`='".$data->user1_register."'";
        $result=$this->conn->excuteSQL($strSQL);
        return $result;
    }
    function dstaikhoan(){
        $this->conn->constructor();
        $strSQL = "SELECT * FROM `taikhoan` WHERE TrangThai='active' AND TenNhomQuyen='KH'";
        $result=$this->conn->excuteSQL($strSQL);
        return $result;
    }
}
class thuonghieu {
    private $conn;
    function __construct()
    {
        $this->conn = new connect;
    }
    function dsthuonghieu(){
        $this->conn->constructor();
        $strSQL ="SELECT * FROM `thuonghieu` WHERE 1";
        $result = $this->conn->excuteSQL($strSQL);
        return $result;
    }
}
class danhmuc {
    private $conn;
    function __construct()
    {
        $this->conn = new connect;
    }
    function dsdanhmuc(){
        $this->conn->constructor();
        $strSQL ="SELECT * FROM `danhmucsp` WHERE 1";
        $result = $this->conn->excuteSQL($strSQL);
        return $result;
    }
}
class phieunhap{
    private $conn;
    function __construct(){
        $this->conn=new connect;
    }
    function CountRow(){
        $this->conn->constructor();
        $strSQL="SELECT COUNT(*) as total FROM phieunhap;";
        $result=$this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function LuuPhieuNhap($data){
        $this->conn->constructor();
        $strSQL="INSERT INTO `phieunhap`(`maPhieuNhap`, `maNhanVien`, `maNhaCC`, `ngayLap`, `tongTien`) 
        VALUES ('".$data->maPhieuNhap."','".$data->maNhanVien."','".$data->maNhaCC."',NOW(),'".$data->tongTien."')";
        $result=$this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function TimPhieuNhap($id){
        $this->conn->constructor();
        $strSQL="SELECT * 
        FROM PhieuNhap
        JOIN chitietphieunhap ON PhieuNhap.maPhieuNhap = chitietphieunhap.maPhieuNhap
        JOIN sanpham ON chitietphieunhap.maSP = sanpham.MaSP
        JOIN nhacungcap on PhieuNhap.maNhaCC=nhacungcap.MaNCC
        WHERE PhieuNhap.maPhieuNhap='".$id."';";
        $result=$this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function LuuChiTiet($data){
        $this->conn->constructor();
        $sanpham=new sanpham;
        $resultSP=$sanpham->sanpham($data->maSP);
        $rowSP=mysqli_fetch_assoc($resultSP);
        $strSQL="INSERT INTO `chitietphieunhap`(`maPhieuNhap`, `maSP`, `soLuong`, `donGia`) 
        VALUES ('".$data->maPhieuNhap."','".$data->maSP."','".$data->soLuong."','".$data->donGia."')";
        $result=$this->conn->excuteSQL($strSQL);
        $strSQL="UPDATE `sanpham` SET `SoLuongSP`='".($rowSP['SoLuongSP']+$data->soLuong)."' WHERE `MaSP`='".$data->maSP."'";
        $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function DSPhieuNhap(){
        $this->conn->constructor();
        $strSQL="SELECT * 
        FROM PhieuNhap
        JOIN nhacungcap on PhieuNhap.maNhaCC=nhacungcap.MaNCC";
        $result=$this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
}
class donhang{
    private $conn;
    private $madonhang;
    function __construct(){
        $this->conn=new connect;
    }
    function setHoadon($data) {
        $this->conn->constructor();
        $strSQL="SELECT COUNT(*) as total FROM donhang;";
        $result=$this->conn->excuteSQL($strSQL);
        $row=mysqli_fetch_assoc($result);
        $this->madonhang=$row['total']+1;
        $strSQL = "INSERT INTO `donhang` (`MaDonHang`, `NgayDatHang`, `DiaChiGiaoHang`, `TrangThaiDonHang`, `TongGiaTriDonHang`, `MTaiKhoan`, `MaNhanVien`) 
        VALUES ('" . ($this->madonhang) . "', NOW(), '" . $data->diachi . "', '0', '" . $data->tong . "', '" . $data->SDT . "', '')";
        $result=$this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    
    function setChiTietDonHang($data){
        $this->conn->constructor();
        $strSQL="SELECT COUNT(*) as total FROM chitietdonhang;";
        $result=$this->conn->excuteSQL($strSQL);
        $row=mysqli_fetch_assoc($result);
        $strSQL="INSERT INTO `chitietdonhang`(`MaChiTietDonHang`, `SoLuong`, `GiaCa`, `MaDonHang`, `MaSP`) 
        VALUES ('".($row['total']+1)."','".$data->soluong."','".$data->GiaSP."','".($this->madonhang)."','".$data->MaSP."')";
        $result=$this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function thongkethang(){
        $this->conn->constructor();
        $strSQL="SELECT 
        (MONTH(NgayDatHang)) AS 'month', SUM(TongGiaTriDonHang) as 'total'
        FROM
            donhang
        WHERE TrangThaiDonHang = '1'
        GROUP BY NgayDatHang";
        $result=$this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
}
class nhacungcap {
    private $conn;
    function __construct()
    {
        $this->conn = new connect;
    }
    function dsnhacc(){
        $this->conn->constructor();
        $strSQL ="SELECT * FROM `nhacungcap` WHERE `TrangThai`='1'";
        $result = $this->conn->excuteSQL($strSQL);
        return $result;
    }
    function suanhacc($data){
        $this->conn->constructor();
        $strSQL="UPDATE `nhacungcap` SET `TenNCC`='".$data->TenNCC."',`DiaChi`='".$data->DiaChi."',`Email`='".$data->Email."',`SoDienThoai`='".$data->SoDienThoai."' 
        WHERE MaNCC ='".$data->MaNCC."'";
        $result=$this->conn->excuteSQL($strSQL);
        return $result;
    }
    function search($ten){
        $this->conn->constructor();
        $strSQL = "SELECT *
                   FROM nhacungcap
                   WHERE LIKE '%".$ten."%'";
        $result = $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function nhaCC($mancc)
    {
        $this->conn->constructor();
        $strSQL = "SELECT * FROM `nhacungcap` WHERE MaNCC='" . $mancc . "'";
        $result = $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function themncc($data){
        $this->conn->constructor();
        $strSQL="SELECT COUNT(*) as total FROM nhacungcap";
        $result = $this->conn->excuteSQL($strSQL);
        $row=mysqli_fetch_array($result);
        $macc= $row['total']+1;
        $strSQL = "INSERT INTO `nhacungcap`(`MaNCC`, `TenNCC`, `DiaChi`, `Email`, `SoDienThoai`, `TrangThai`) VALUES ('".$macc."','".$data->TenNCC."','".$data->DiaChi."','".$data->Email."','".$data->SoDienThoai."', '1')";
        $result = $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function xoanhacc($mancc){
        $this->conn->constructor();
        $strSQL = "UPDATE `nhacungcap` SET `TrangThai`='0' WHERE  MaNCC='" . $mancc . "'";
        $result = $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
}