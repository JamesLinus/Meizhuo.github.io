<?php
	require_once 'sqlTool.php';
	$sqlTool=new sqlTool();
	//连接数据库
	$sqlTool->__consturct();
	header("Content-Type:text/html;charset=utf-8");
	$id=$_GET['id'];
	//echo "$id";
	$sql="select * from newsManage where id=$id";
	$res=$sqlTool->execute_dql($sql);
	while ($row = mysql_fetch_assoc($res)){
		echo "{$row['id']}.{$row['content']}";
	}
		
	
	mysql_free_result($res);
	$sqlTool->close_connect();