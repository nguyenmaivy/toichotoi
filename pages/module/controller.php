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
    
    function suasanpham($data){
        $this->conn->constructor();
        $strSQL="UPDATE `sanpham` SET `TenSP`='".$data->TenSP."',`SoLuongSP`='".$data->SoLuongSP."',`GiaSP`='".$data->GiaSP."',`MaTH`='".$data->MaTH."',`MaDM`='".$data->TenDM."'
        WHERE MaSP ='".$data->MaSP."'";
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
    function taotaikhoan($data){
        $strSQL = "INSERT INTO `account` (`TenND`, `SĐT`, `MaQuyen`, `Status`, `CreTime`, `Password`) 
           VALUES ('" . $data['username_register'] . "', '" . $data['user1_register'] . "', 'KH', 'Đang hoạt động',NOW(), '".$data['password_register']."')";
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
        $strSQL ="SELECT * FROM `nhacungcap` WHERE 1";
        $result = $this->conn->excuteSQL($strSQL);
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
        $strSQL="INSERT INTO `chitietphieunhap`(`maPhieuNhap`, `maSP`, `soLuong`, `donGia`) 
        VALUES ('".$data->maPhieuNhap."','".$data->maSP."','".$data->soLuong."','".$data->donGia."')";
        $result=$this->conn->excuteSQL($strSQL);
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
}
