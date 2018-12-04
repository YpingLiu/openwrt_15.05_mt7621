<?php 
    //先判断$_GET['a']是否已经传值 防止NOTICE错误
    if(isset($_GET['a'])){
        //选择判断要执行的操作
        switch($_GET['a']){
            case 'format':
                //新建文件
                //$filename=$_POST["filename"];
                //$filename=rtrim($dir,"/")."/".$filename;
                //写入文件 写入一个空字符串
                //file_put_contents($filename,"");
                break;
        }
    }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="css/form.css" rel='stylesheet' type='text/css' />
<link href="css/table.css" rel='stylesheet' type='text/css' />
<script src="js/menu/jquery.min.js"></script>

</head>

<body bgcolor="#FFFFFF" style="margin:0;padding:0">
<span class="radius"></span>
<form action="disks.php" method="post" class="smart-green">
<h1>磁盘管理</h1>
<table class="bordered">
    <thead>
    <tr>
        <th>磁盘名称</th>
        <th>容量</th>
        <th>已用</th>
        <th>可用</th>
        <th>可用%s</th>
        <th>操作</th>
    </tr>
    </thead>      
     <?php
        //遍历目录
        $dd=opendir($dir);
        $cmd = "df";
        exec($cmd,$array);
        foreach ($array as $k => $v){
            //$v=str_replace("\t","_",$v);
            $v=preg_replace("/[\s]+/is"," ",$v);
            $items = explode(" ",$v);
            if(strpos($items[0], "/dev/sd") === 0){
                echo "<tr>";
                echo "<td><img src='./images/disk.png'/>&nbsp{$items[0]}</td>";
                echo "<td>{$items[1]}</td>";
                echo "<td>{$items[2]}</td>";
                echo "<td>{$items[3]}</td>";
                echo "<td>{$items[4]}</td>";
                echo "<td align='center'>
                        <a href=\"javascript:diskFormat('{$items[0]}');\">格式化</a>
                      </td>";
                echo "</tr>"; 
            }
        }
    ?>
 
</table>
</form>
</body>
<script type="text/javascript">
function diskFormat(path){
    if(confirm("Are you sure to format selected disk?")){
        if(confirm("All data will be lose!!!")){
            location.href="disks.php?a=format&path="+path;
            return;
        }
    }
}
</script>
</html>

