<?php
	require_once"sqlTool.php";
	//������ݿ�
	$sqlTool=new sqlTool();
	$sqlTool->__consturct();
	//处理编码
	header("Content-Type:text/html;charset=utf-8");
	//定义导航条变量
	$pageNow=1;//显示第几页
	$pageCount=5;//共几页
	$rowCount=0;//工友多少条记录
	$pageSize=6;//每页显示几条记录
	//根据用户需要显示第几页
	if (!empty($_GET['pageNow'])){
		$pageNow=$_GET['pageNow'];
	}
	$sql1="select count(id) from mz_news";
	$res1=$sqlTool->execute_dql($sql1);
	//取出数据有多少行
	if($row=mysql_fetch_row($res1)){
		$rowCount=$row[0];
	}
	mysql_free_result($res1);
	$pageCount=ceil($rowCount/$pageSize);
	
	
	
	
	
	
	$sql="select * from mz_news limit ".($pageNow-1)*$pageSize.",$pageSize";
	$res=$sqlTool->execute_dql($sql);
	echo "<h1>新闻列表</h1>";
	echo "<table border='1px' bordercolor='green' cellspacing='0px' width='700px' >";
	echo "<tr><th>id</th><th>标题</th><th>作者</th><th>日期</th><th>正文</th><th></th></tr>";
	//
	while ($row=mysql_fetch_assoc($res)){
		echo "<tr><td>{$row['id']}</td><td>{$row['title']}</td><td>{$row['author']}</td><td>{$row['data']}</td><td>{$row['content']}</td><td><a href='newsView.php?id={$row['id']}'>查看新闻</td></tr>";
	}
	echo "</table>";
	/*for ($i=1;$i<=$pageCount;$i++){
		echo "<a href='newsList.php?pageNow=$i'>$i</a>&nbsp;";
	}*/
	if ($pageNow>1) {
		$prePage=$pageNow-1;
		echo "<a href='newsList.php?pageNow=$prePage'>上一页</a>&nbsp;";
	}
	if ($pageNow<$pageCount) {
		$nextPage=$pageNow+1;
		echo "<a href='newsList.php?pageNow=$nextPage'>下一页</a>&nbsp;";
	}
	//显示当前页和共几页
	echo "当前页{$pageNow}/共{$pageCount}页";
	echo "<br><br>";
	?>
	<form action="newsList.php">
	跳转到:<INPUT type="text" name="pageNow"/>
	<input type="submit" value="提交">
	</form>
	<?php 
	mysql_free_result($res);
	$sqlTool->close_connect();
	