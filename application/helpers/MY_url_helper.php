<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//extension: css_url
if ( ! function_exists('static_url'))
{
	function static_url()
	{
		$CI =& get_instance();
		return $CI->config->item("static_url");
	}
}

/* End of file url_helper.php */
/* Location: ./system/helpers/url_helper.php */
?>