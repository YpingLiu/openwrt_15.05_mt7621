<?php 
    $dir = $_GET["dir"];

    if(!isset($dir)){
        //定义要查看的目录
        $dir="/mnt/sda1";
    }
    //echo 'dir==@='.$dir;
    //先判断$_GET['a']是否已经传值 防止NOTICE错误
    if(isset($_GET['a'])){
        //选择判断要执行的操作
        switch($_GET['a']){
            case 'creat':
                //新建文件
                $filename=$_POST["filename"];
                $filename=rtrim($dir,"/")."/".$filename;
                //写入文件 写入一个空字符串
                file_put_contents($filename,"");
                break;
            case 'del':
                //删除文件
                //unlink($_GET['filename']);
				deldir($_GET['filename']);
                break;
            case 'update':
                //修改文件
                file_put_contents($_POST['filename'],$_POST['content']);
                echo "修改成功";
                header("refresh:1;url=index.php");
                break;
        }
    }

	function deldir($fname)
	{
		if(is_dir($fname))
		{
			//在删除之前，把里面的文件全部删掉
			$dir = opendir($fname);
			while($dname = readdir($dir))
			{
							 //必须加这一项，不然可能会将整个磁盘给删掉
				if($dname!="." && $dname!="..")
				{
					$durl = $fname."/".$dname;
					if(is_file($durl))
					{
						unlink($durl);
					}
					else
					{
						deldir($durl);
					}
				}
			}
			closedir($dir);
			//删除该文件夹
			rmdir($fname); 
		}
		else
		{
			//如果是文件，直接删掉
			unlink($fname);
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
<form action="main.php" method="post" class="smart-green">
<h1>文件管理</h1>
<table class="bordered">
    <thead>
    <tr>
        <th>名称</th>
        <th>类型</th>
        <th>大小</th>
        <th>操作</th>
    </tr>
    </thead>      
     <?php
        //遍历目录
        if(is_dir($dir)){
            $dd=opendir($dir);
            if($dir!="/mnt/sda1"){
                 $pDir = substr($dir,0,strripos($dir,"/"));
                //echo 'dir==@='.$dir;
                echo "<tr>";
                    echo "<td><a href='dirs.php?dir={$pDir}'>..</a></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                echo "</tr>";
            }
            while(false !== ($f=readdir($dd))){
                //过滤点
                if($f == "." || $f == ".."){
                    continue;
                }
                //拼路径
                $file=rtrim($dir,"/")."/".$f;
                //防止中文乱码
                //$f2=iconv("gb2312","utf-8",$f);
                echo "<tr>";
                    if(is_file($file))
                        echo "<td><img src='./images/file.png'/>{$f}</td>";
                    else
                        echo "<td><a href='dirs.php?dir={$file}'><img src='./images/dir.png'/>&nbsp{$f}</a></td>";
                    echo "<td>".filetype($file)."</td>";
                    echo "<td>".filesize($file)."</td>";
                    //echo "<td>".filectime($file)."</td>";
                    //echo "<td>".date('Y-m-d H:i:s',filectime($file))."123</td>";
                    echo "<td align='center'>
                            <a href='dirs.php?a=del&filename={$file}'>删除</a>
                          </td>";
                echo "</tr>";
            
            }
        }
        else{
            echo "<tr>";
                echo "<td colspan='4'>尚未安装磁盘</td>";
            echo "</tr>";
        }
        
    ?>
</table>
</form>
</body>
</html>

