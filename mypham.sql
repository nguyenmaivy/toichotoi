-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2024 at 04:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database:  mypham 
--

-- --------------------------------------------------------

--
-- Table structure for table  chitietdonhang 
--

CREATE TABLE chitietdonhang (
  MaChiTietDonHang varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  SoLuong int(20) NOT NULL,
  GiaCa int(20) NOT NULL,
  MaDonHang varchar(15) NOT NULL,
  MaSP varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table  danhmucsp 
--

CREATE TABLE danhmucsp (
  MaDM varchar(15) NOT NULL,
  TenDanhMuc varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table danhmucsp 
--

INSERT INTO  danhmucsp  ( MaDM ,  TenDanhMuc ) VALUES
('1', 'ChamSocDa'),
('2', 'Trang Điểm'),
('3', 'Chăm sóc cơ thể');

-- --------------------------------------------------------

--
-- Table structure for table  dichvukhuyenmai 
--

CREATE TABLE  dichvukhuyenmai  (
   MaDVKM  varchar(15) NOT NULL,
   TenDV  varchar(20) NOT NULL,
   ThoiGianBatDau  date NOT NULL,
   ThoiGianKetThuc  date NOT NULL,
   Loai  varchar(20) NOT NULL,
   TrangThai  tinyint(1) NOT NULL,
   MaDonHang  varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table  donhang 
--

CREATE TABLE  donhang  (
   MaDonHang  varchar(15) NOT NULL,
   NgayDatHang  date NOT NULL,
   DiaChiGiaoHang  varchar(20) NOT NULL,
   TrangThaiDonHang  tinyint(1) NOT NULL,
   TongGiaTriDonHang  int(20) NOT NULL,
   maTaiKhoan varchar(15)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table  nhacungcap 
--

CREATE TABLE  nhacungcap  (
   MaNCC  varchar(15) NOT NULL,
   TenNCC  varchar(20) NOT NULL,
   DiaChi  varchar(20) NOT NULL,
   Email  varchar(25) NOT NULL,
   SoDienThoai  varchar(13) NOT NULL,
   MaSP  varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table  nhacungcap 
--

INSERT INTO  nhacungcap  ( MaNCC ,  TenNCC ,  DiaChi ,  Email ,  SoDienThoai ,  MaSP ) VALUES
('1', 'Huy', 'BinhThuan', 'Huynguyen120304@gmail.com', '0367644927', NULL);

-- --------------------------------------------------------

--
-- Table structure for table  nhanvien 
--

CREATE TABLE  nhanvien  (
   MaNhanVien  varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
   HoTen  varchar(20) NOT NULL,
   GioiTinh  varchar(5) NOT NULL,
   SoDienThoai  varchar(13) NOT NULL,
   UserName  varchar(15) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table  phuongthucthanhtoan 
--

CREATE TABLE  phuongthucthanhtoan  (
   MaPT  varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
   LoaiPT  varchar(15) NOT NULL,
   TenPT  varchar(15) NOT NULL,
   MaDonHang  varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table  sanpham 
--

CREATE TABLE  sanpham  (
   MaSP  varchar(15) NOT NULL,
   TenSP  varchar(120) NOT NULL,
   HinhAnh  varchar(70) NOT NULL,
   SoLuongSP  int(100) NOT NULL,
   GiaSP  int(50) NOT NULL,
   TrangThai  tinyint(1) NOT NULL,
   MaTH  varchar(15) NOT NULL,
   MaDM  varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table  sanpham 
--

INSERT INTO  sanpham  ( MaSP ,  TenSP ,  HinhAnh ,  SoLuongSP ,  GiaSP ,  TrangThai ,  MaTH ,  MaDM ,  MaNCC ) VALUES
('1', 'Sửa rửa mặt', '\"C:\\Users\\ADMIN\\Desktop\\Học Kì 2-Năm2\\Phân tích th', 35, 350000, 1, '1', '1', '1'),
('2', 'Kem Dưỡng AHC Làm Sá', 'Kem Dưỡng AHC Làm Sáng Vùng Da Mắt.webp', 500, 500000, 1, '1', '1', '1'),
('3', 'Sữa Chống Nắng La Ro', 'product-variation-50-ml-front.webp', 400, 560000, 1, '2', '1', '1'),
('4', 'Nước Cân Bằng Chống ', 'Nước Cân Bằng Chống Lão.webp', 970, 970000, 1, '1', '1', '1'),
('5', 'Tinh Chất Dưỡng Trắn', 'Tinh Chất Dưỡng Trắng Da.webp', 340, 340000, 1, '3', '1', '1'),
('6', 'Tinh Chất Giảm Mụn, ', 'Tinh Chất Giảm Mụn, Giảm Thâm.webp', 900, 900000, 1, '1', '1', '1'),
('7', 'Son Tint Lì Peripera', 'Son Tint Lì Peripera Ink.webp', 250, 250000, 1, '3', '2', '1'),
('8', 'Bảng Phấn Mắt 12 Màu', 'Bảng Phấn Mắt 12 Màu Perfect Diary Explorer.webp', 480, 480000, 1, '4', '2', '1'),
('9', 'Phấn Nước Che Khuyết', 'Phấn Nước Che Khuyết Điểm Mịn Lì.webp', 700, 700000, 1, '3', '2', '1'),
('10', 'Chì Chân Mày THE FAC', 'Chì Chân Mày THE FACE SHOP.webp', 129, 129000, 1, '5', '2', '1'),
('11', 'Son Dưỡng Môi Chăm S', '[cmm]', 639, 639000, 1, '6', '2', '1'),
('12', 'Bộ Cọ Trang Điểm Mắt', 'Bộ Cọ Trang Điểm Mắt 6 Cây TOOLA - TLA019.webp', 48, 48000, 1, '7', '2', '1'),
('13', 'Son Tint Nước Siêu L', 'Son Tint Nước Siêu Lì.webp', 155, 155000, 1, '8', '2', '1'),
('14', 'Bộ Sưu Tập Phiên Bản', 'Bộ Sưu Tập Phiên Bản.webp', 500, 500000, 1, '8', '2', '1'),
('15', 'Men Stay Simplicity ', '1.jpg', 190, 190000, 1, '12', '3', '1'),
('16', 'Combo 3in1 Nâng Tầm ', '2.jpg', 1200, 1200000, 1, '13', '3', '1'),
('17', 'Bộ Dưỡng Da Nâng Tầm', '3.jpg', 1300, 1300000, 1, '14', '3', '1'),
('18', 'Sữa Tắm Nam Nâng Tầm', '4.jpg', 130, 130000, 1, '15', '3', '1'),
('19', 'Kem Chống Nắng Dành ', '5.jpg', 330, 330000, 1, '16', '3', '1'),
('20', 'Kem trắng da trị nám', '6.jpg', 2000, 2000000, 1, '18', '3', '1'),
('21', 'Kem Dưỡng Trắng Da T', 'Soyraie.jpg', 250, 250000, 1, '17', '3', '1');

-- --------------------------------------------------------

--
-- Table structure for table  taikhoan 
--

CREATE TABLE  taikhoan  (
   UserName  varchar(15) NOT NULL,
   TenNhomQuyen  varchar(20) NOT NULL,
   MatKhau  varchar(20) NOT NULL,
   SDT  varchar(10) NOT NULL,
   DiaChi varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Đổ dữ liệu cho  taikhoan 
INSERT INTO  taikhoan ( UserName ,  TenNhomQuyen ,  MatKhau ,  SDT, DiaChi) 
VALUES ('Admin','admin','Admin@','0123456789', 'Thôn Tiên Sơn 2, Xã Tân Sơn, Quận 8, Hồ Chí Minh');
-- --------------------------------------------------------

--
-- Table structure for table  thuonghieu 
--

CREATE TABLE  thuonghieu  (
   MaTH  varchar(15) NOT NULL,
   TenTH  varchar(20) NOT NULL,
   XuatXu  varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table  thuonghieu 
--

INSERT INTO  thuonghieu  ( MaTH ,  TenTH ,  XuatXu ) VALUES
('1', 'AHC', 'Hàn Quốc'),
('2', 'La Roche-Posay', 'Pháp'),
('3', 'CLUB CLIO', 'Hàn Quốc'),
('4', 'PERFECT DIARY', 'Trung Quốc'),
('5', 'THE FACE SHOP', 'Hàn Quốc'),
('6', 'Dear Dahlia', 'Hàn Quốc'),
('7', 'TOOLA', 'Trung Quốc'),
('8', 'ROMAND', 'Hàn Quốc'),
('9', 'Dermafirm', 'Hàn Quốc'),
('10', 'DSIUAN', 'Trung Quốc'),
('11', 'Lameila', 'Trung Quốc'),
('12', 'Men Stay Simplicity', 'Việt Nam'),
('13', 'MERLIN for men', 'Việt Nam'),
('14', 'DSiuan', 'Trung Quốc'),
('15', 'D\'Vi Nature', 'Việt Nam'),
('16', 'The Inkey List', 'Anh Quốc'),
('17', 'White Conc', 'Nhật Bản'),
('18', 'ILUMA Image ', 'Mỹ');


CREATE TABLE  PhieuNhap (
	 maPhieuNhap  varchar(15) ,
	 maNhanVien  varchar(15),
   maNhaCC  varchar(15),
	 ngayLap  date,
	 tongTien  int(20)
);

CREATE TABLE chitietphieunhap(
	 maPhieuNhap  varchar(15) ,
	 maSP  varchar(15)
	 soLuong  int(10)
);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
