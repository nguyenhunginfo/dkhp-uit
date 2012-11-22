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
$route['404_override'] = '';
$route['dang-ky-hoc-phan']='index/login';
$route['login']='welcome';
$route['logout']='index/logout';
$route['quanly/sinhvien']='sinhvien/index';
$route['quanly/sinhvien/them-sinh-vien']='sinhvien/themsv';
$route['quanly/sinhvien/them-sinh-vien/(:any)']='sinhvien/themsv/$1';
$route['quanly/sinhvien/nhap-du-lieu']='sinhvien/nhapdl';
$route['quanly/sinhvien/nhap-du-lieu/(:any)']='sinhvien/nhapdl/$1';
$route['quanly/sinhvien/xuat-du-lieu']='sinhvien/xuatdl';
$route['quanly/sinhvien/thongke']='sinhvien/thongke';
$route['quanly/sinhvien/test']='sinhvien/test';
$route['quanly/sinhvien/(:any)']='sinhvien/index/$1';
$route['sinhvien']='';

$route['quanly/monhoc']='monhoc/index';
$route['quanly/monhoc/them-mon-hoc']='monhoc/themmh';
$route['quanly/monhoc/them-mon-hoc/(:any)']='monhoc/themmh/$1';
$route['quanly/monhoc/nhap-du-lieu']='monhoc/nhapdl';
$route['quanly/monhoc/thong-ke']='monhoc/thongke';
$route['quanly/monhoc/(:any)']='monhoc/index/$1';

$route['quanly/lop']='lop/index';
$route['quanly/lop/ly-thuyet']='lop/index/lt';
$route['quanly/lop/thuc-hanh']='lop/index/th';
$route['quanly/lop/them-lop']='lop/themlop';
$route['quanly/lop/them-lop/lt']='lop/themlop/lt';
$route['quanly/lop/them-lop/th']='lop/themlop/th';

$route['quanly/lop/nhap-du-lieu']='lop/nhapdl';
$route['quanly/lop/nhap-du-lieu/lt']='lop/nhapdl/lt';
$route['quanly/lop/nhap-du-lieu/th']='lop/nhapdl/th';
$route['quanly/lop/lich-giang-day']='lop/lichgiangday';



$route['quanly/giaovien']='giaovien/index';
$route['giaovien']='';



/* End of file routes.php */
/* Location: ./application/config/routes.php */
?>