<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $this->fetch('title').$title; ?></title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<!-- 在这里引入外部文件和脚本(欲知更多信息，请参见 HTML 助件) -->
<?php

echo $this->Html->css('blog');
echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>
</head>
<body>

<!-- 如果你要某种菜单出现在你所有的视图中，在这里引入。 -->
<div id="header">
    <div id="menu">my first blog !</div>
</div>

<!-- 这里显示我的视图 -->
<?php echo $this->Session->flash(); ?>

<?php echo $this->fetch('content'); ?>

<!-- 为每个显示的页面添加底边栏。 -->
<div id="footer">there is foot !</div>

</body>
</html>