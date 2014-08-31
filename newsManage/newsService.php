<?php
	require_once"sqlTool.php";
	//������ݿ�
	$sqlTool=new sqlTool();
	$sqlTool->__consturct();
	$title=$_POST['title'];
	$author=$_POST['author'];
	$data=$_POST['data'];
	$content=$_POST['content'];
	//echo $title.$author.$data.$content;
	$sql="insert into newsmanage (title,author,data,content)values('$title','$author','$data','$content')";
	$b= $sqlTool->execute_dml($sql);
	if ($b==1) {
		echo "<h1>新闻发布成功</h1>";
	}else {
		echo "没有发布成功";
	}
	
	$sqlTool->close_connect();