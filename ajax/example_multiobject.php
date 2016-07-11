<?php
	require_once("jqSajax.class.php");
	class MyObj {
			var $name, $age;
			
			function MyObj($name='', $age='') {
				$this->name = $name;
				$this->age = $age;
			}
			function method1($d1,$d2){
				return 'The people say about: '.$d1.' and '.$d2;
			}
			function method2(){
				return 'The people see the date server: '.date('d-n-Y');
			}
	}
	
	class subObj{
		var $child,$child_age;
		
		function subObj($child='',$child_age=''){
			$this->child=$child;
			$this->child_age=$child_age;
		}
		
		function subMethod1($d1,$d2){
			return 'The child of people say about: '.$d1.' and '.$d2;
		}
	
	}

	//$ajax=new jqSajax(2,1,1);
	$people=new MyObj();
	$people->child=new subObj();
	
	$ajax=new jqSajax();
	$ajax->request_type = "POST";
	$ajax->export('people->method1','people->child->subMethod1');//export method
	
	$ajax->processClientReq();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>jqSajax</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
@import "screen.css";
</style>
<script src="jquery-1.2.2.pack.js"></script>
<script src="json.js"></script>
<script>
<?php
	$ajax->showJs();
?>
//show animation
$(function(){
	$("#ajax_display").ajaxStart(function(){
		$(this).html('<div style="position:absolute;top:'+400+'px;left:'+400+'px;"><p align=center><strong>Loading....</strong><br /><img src="ajax-loader.gif" /></p></div>');
	});
	$("#ajax_display").ajaxSuccess(function(){
   		$(this).html('');
 	});
	$("#ajax_display").ajaxError(function(url){
   		alert('jqSajax is error ');
 	});
});
</script>
</head>
<body>
<div id="wrap">
<div id="header">
<div class="header">jqSajax</div>
<h1>Call your PHP method/function from Javascript</h1>
</div>
<div id="menu">
<ul>
<li><a href="http://satoewarna.com">Satoewarna</a></li><li><a href="index.php">Home</a></li><li><a href="example_jquery.php">Call as JQUERY Plugin</a></li><li><a href="example_jqsajax.php">Call as jqSajax method</a></li><li><a href="example_function.php">Call as javascript function</a></li><li><a href="doc.html">Docs</a></li><li><a href="job.html">Give me a Job</a></li><li><a href="http://satoewarna.com/jqsajax/download.html">download</a></li><li><a href="https://sourceforge.net/project/admin/donations.php?group_id=235778">Donate</a></li>
</ul>
</div>
<div id="content">
<h2>Demo of Call Object in Object:</h2>
<p>Now,jqSajax Support calling object in object with N degrees.<br>&nbsp;Call $class-&gt;method1-&gt;method2-&gt;method3 ... methodN() as $.x_class_method1_method2_method3_ ....methodN()</p>
<p>&nbsp;</p>
<button onClick="alert($.x_people_method1('winoto',25))"">Call $people->method1()</button>
<button onClick="alert($.x_people_child_subMethod1('winoto',25))">Call $people->child-&gt;subMethod1()</button></button>
<p>&nbsp;</p>
<p>I hope it's usefull for You.</p>
<div id="footer">
<h5>By <a  href="http://satoewarna.com/jqsajax">Winoto</a> >> Design by <a href="http://www.kricit.co.uk/elgunvis">Ashley Johnson</a></h5>
</div>
</div>
</body>
</html>

