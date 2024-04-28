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
                   INNER JOIN nhacungcap ON sanpham.MaNCC = nhacungcap.MaNCC
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
        $result['CountRow']=mysqli_num_rows($result);
        $this->conn->disconnect();
        return $result;
    }
    function search($ten){
        $this->conn->constructor();
        $strSQL = "SELECT *
                   FROM sanpham
                   INNER JOIN thuonghieu ON sanpham.MaTH = thuonghieu.MaTH
                   INNER JOIN nhacungcap ON sanpham.MaNCC = nhacungcap.MaNCC
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
    
    function suasanpham($data){
        $this->conn->constructor();
        $strSQL="UPDATE `sanpham` SET `TenSP`='".$data->TenSP."',`SoLuongSP`='".$data->SoLuongSP."',`GiaSP`='".$data->GiaSP."',`MaTH`='".$data->MaTH."',`MaDM`='".$data->TenDM."',`MaNCC`='".$data->TenNCC."' 
        WHERE MaSP ='".$data->MaSP."'";
        $result=$this->conn->excuteSQL($strSQL);
        return $result;
    }
    function capnhatanh(){
        $this->conn->constructor();
        $strSQL="";
        $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
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
        $strSQL = "SELECT * FROM `taikhoan` WHERE SDT='" . $sdt . "'";
        $result = $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function themtk($data)
    {
        $this->conn->constructor();
        $strSQL = "INSERT INTO `taikhoan`(`UserName`, `MatKhau`, `SDT`, `TenNhomQuyen`, `TrangThai`) 
            VALUES ('" . $data->username_register . "','" . $data->password_register . "','" . $data->user1_register . "','KH', 'show')";
        $result = $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function xoatk($sdt)
    {
        $this->conn->constructor();
        $strSQL = "DELETE FROM `taikhoan` WHERE SDT='" . $sdt . "'";
        $result = $this->conn->excuteSQL($strSQL);
        $this->conn->disconnect();
        return $result;
    }
    function suatk($data)
    {
        $this->conn->constructor();
        $strSQL = "UPDATE `taikhoan` 
        SET `UserName`='" . $data->username_register . "',`MatKhau`='" . $data->password_register . "',`TrangThai`='" . $data->status_account . "'
        WHERE SDT='" . $data->user1_register . "'";
        $result = $this->conn->excuteSQL($strSQL);
        return $result;
    }
    function suaquyen($data){
        $this->conn->constructor();
        $strSQL="UPDATE `taikhoan` SET `TenNhomQuyen`='".$data->quyen."' WHERE `SDT`='".$data->user1_register."'";
        $result=$this->conn->excuteSQL($strSQL);
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
    
}
