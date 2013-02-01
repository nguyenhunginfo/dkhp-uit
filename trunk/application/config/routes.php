<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "welcome";
$route['dang-ki-hoc-phan']='index/toVindex';
$route['ket-qua']='index/toVresult';
$route['thoi-khoa-bieu']='tkb';
$route['login']='welcome';
$route['logout']='index/logout';
$route['404_override'] = '';

$route['quanly/sinhvien']='sinhvien/index';
$route['quanly/sinhvien/them-sinh-vien']='sinhvien/themsv';
$route['quanly/sinhvien/them-sinh-vien/(:any)']='sinhvien/themsv/$1';
$route['quanly/sinhvien/nhap-du-lieu']='sinhvien/nhapdl';
$route['quanly/sinhvien/nhap-du-lieu/(:any)']='sinhvien/nhapdl/$1';
$route['quanly/sinhvien/xuat-du-lieu']='sinhvien/xuatdl';
$route['quanly/sinhvien/thongke']='sinhvien/thongke';
$route['quanly/sinhvien/(:any)']='sinhvien/index/$1';
$route['sinhvien']='';

$route['quanly/giaovien']='giaovien/index';
$route['quanly/giaovien/them-giao-vien']='giaovien/themgv';
$route['quanly/giaovien/nhap-du-lieu']='giaovien/nhapdl';
$route['quanly/giaovien/lich-giang-day']='giaovien/lich_giang_day';
$route['quanly/giaovien/thoi-khoa-bieu/(:any)']='giaovien/tkb/$1';
$route['quanly/giaovien/xuat-du-lieu']='giaovien/xuatdl';
$route['quanly/giaovien/thongke']='giaovien/thongke';
$route['giaovien']='';

$route['quanly/monhoc']='monhoc/index';
$route['quanly/monhoc/them-mon-hoc']='monhoc/themmh';
$route['quanly/monhoc/mon-hoc-nhom']='monhoc/monhocnhom';
$route['quanly/monhoc/mon-hoc-nhom/them']='monhoc/them_nhom_monhoc';
$route['quanly/monhoc/mon-hoc-nhom/dieu-chinh/(:any)']='monhoc/dieuchinhnhom/$1';
$route['quanly/monhoc/mon-hoc-nhom/(:any)']='monhoc/monhocnhom/$1';
$route['quanly/monhoc/tuong-duong']='monhoc/monhoctuongduong';
$route['quanly/monhoc/them-mon-hoc/(:any)']='monhoc/themmh/$1';
$route['quanly/monhoc/nhap-du-lieu']='monhoc/nhapdl';
$route['quanly/monhoc/thong-ke']='monhoc/thongke';
$route['quanly/monhoc/(:any)']='monhoc/index/$1';

$route['quanly/lop']='lop/index';
$route['quanly/lop/lop-da-mo']='lop/index';
$route['quanly/lop/ly-thuyet']='lop/index/lt';
$route['quanly/lop/thuc-hanh']='lop/index/th';
$route['quanly/lop/lop-de-nghi']='lop/denghi';
$route['quanly/lop/them-lop']='lop/themlop';
$route['quanly/lop/them-lop/lt']='lop/themlop/lt';
$route['quanly/lop/them-lop/th']='lop/themlop/th';
$route['quanly/lop/danh-sach/(:any)']='lop/danh_sach/$1';
$route['quanly/lop/nhap-du-lieu']='lop/nhapdl';
$route['quanly/lop/nhap-du-lieu/lt']='lop/nhapdl/lt';
$route['quanly/lop/nhap-du-lieu/th']='lop/nhapdl/th';
$route['quanly/lop/lich-giang-day']='lop/lichgiangday';
$route['quanly/lop/thong-ke']='lop/thongke';


$route['quanly/giaovien']='giaovien/index';
$route['giaovien']='';

$route['quanly/chuong-trinh-dao-tao']='ctdt/index';
$route['quanly/chuong-trinh-dao-tao/dieu-chinh-chuyen-nganh/(:any)']='ctdt/dieuchinhchuyennganh/$1';

$route['quanly/chuong-trinh-dao-tao/them']='ctdt/themctdt';
$route['quanly/chuong-trinh-dao-tao/them/(:any)']='ctdt/themctdt/$1';
$route['quanly/chuong-trinh-dao-tao/them/(:any)/(:any)']='ctdt/themctdt/$1/$2';
$route['quanly/chuong-trinh-dao-tao/saochep']='ctdt/saochepctdt';
$route['quanly/chuong-trinh-dao-tao/saochep/(:any)/(:any)']='ctdt/saochepctdt/$1/$2';
$route['quanly/chuong-trinh-dao-tao/dieu-chinh/(:any)/(:any)']='ctdt/dieuchinh/$1/$2';
$route['quanly/chuong-trinh-dao-tao/xoa/(:any)/(:any)']='ctdt/xoa_hocky/$1/$2';
$route['quanly/chuong-trinh-dao-tao/nhap-du-lieu']='ctdt/nhapdl';
$route['quanly/chuong-trinh-dao-tao/nhap-du-lieu/(:any)']='ctdt/nhapdl/$1';
$route['quanly/chuong-trinh-dao-tao/xuat-du-lieu']='ctdt/xuatdl';
$route['quanly/chuong-trinh-dao-tao/thongke']='ctdt/thongke';
$route['quanly/chuong-trinh-dao-tao/(:any)/(:any)']='ctdt/detail/$1/$2';
$route['quanly/chuong-trinh-dao-tao/(:any)']='ctdt/index/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
?>