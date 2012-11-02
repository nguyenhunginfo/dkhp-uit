<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>UploadiFive Test</title>

<script type="text/javascript" src="<?php echo static_url(); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo static_url(); ?>/js/ajaxfileupload.js"></script>
<style type="text/css">
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
</style>
</head>
<script type="text/javascript">
$(document).ready(function()
{
	
	
	
   $('#file_upload').change(function()
   {
    alert("me");
	 $.ajaxFileUpload({
         url         :'upload/ajax_upload',
         secureuri      :false,
         fileElementId  :'file_upload',
         dataType    : 'json',
         data        : {
            'title'           : "me"
         },
         success  : function (data, status)
         {
            
            alert(data.msg);
         }
      });
      
   });
});
     

			


</script>
<body>
	<h1>Uploadify Demo</h1>
	<form>
		<div id="queue"></div>
		<input id="file_upload" name="file_upload" type="file" multiple="true">
	</form>

	
</body>
</html>