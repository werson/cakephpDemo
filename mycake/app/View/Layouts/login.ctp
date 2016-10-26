<!DOCTYPE html>
<html lang="en">
<head>
<title>MyTime——登录</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<!-- 在这里引入外部文件和脚本(欲知更多信息，请参见 HTML 助件) -->
<?php
echo $this->Html->css('cake');
echo $this->Html->script('jquery-1.10.2.min');
echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>
</head>
<body>

<!-- 如果你要某种菜单出现在你所有的视图中，在这里引入。 -->
<div id="header">
    <div id="menu">
        <div class='tableList'>
        </div>
    </div>
</div>

<!-- 这里显示我的视图<?php echo $this->Session->flash(); ?> -->

<?php echo $this->fetch('content'); ?>

<!-- 为每个显示的页面添加底边栏。 -->
<div id="footer">
        <span class="fot">©werson毕业设计</span>
</div>

</body>
</html>