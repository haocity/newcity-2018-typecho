<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
	exit ;
 ?>
<?php if (!isajax()) { ?>
<!DOCTYPE HTML>
<html class="no-js">
<head>
    <meta charset="<?php $this -> options -> charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this -> archiveTitle(array('category' => _t('分类 %s 下的文章'), 'search' => _t('包含关键字 %s 的文章'), 'tag' => _t('标签 %s 下的文章'), 'author' => _t('%s 发布的文章')), '', ' - '); ?><?php $this -> options -> title(); ?></title>
	<script src="https://at.alicdn.com/t/font_464467_n309tpndqj6vfgvi.js" async="async" type="text/javascript" charset="utf-8"></script>
    <!--[if lt IE 9]>
    <script src="//cdnjscn.b0.upaiyun.com/libs/html5shiv/r29/html5.min.js"></script>
    <script src="//cdnjscn.b0.upaiyun.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- 使用url函数转换相关路径 -->
    <link rel="stylesheet" href="<?php $this -> options -> themeUrl('style.css'); ?>">
	<script  src="<?php $this -> options -> themeUrl('min.js'); ?>"   type="text/javascript" charset="utf-8"></script>
	<script src="<?php $this -> options -> themeUrl('hco.js'); ?>" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		optionstitle="<?php $this->options->title() ?>"
		<?php if ($this->options->srollSet == 'able'){ 
			echo "srollopen='true'";
		}else{
			echo "srollopen='false'";
		}
		?>
	</script>
</head>
<body>
<!--[if lt IE 8]>
    <div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>'); ?>.</div>
<![endif]-->
<header>
	<nav class="main-width">
		<div class="logo">
			<a href="<?php $this->options->siteUrl(); ?>">
				<?php if($this->options->sitename){$this->options->sitename();}else{$this->options->title();}?>
			</a>
		</div>
		<div class="nav">
			<li><a<?php if($this->is('index')): ?> class="current"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a></li>
			<!--分类菜单-->        
			<?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
			<?php while ($category->next()): ?>
			<li><a href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>"><?php $category->name(); ?></a></li>
			<?php endwhile; ?>
			<?php if($this->options->customnav){$this->options->customnav();} ?>
			<!--页面-->
			<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
			<?php while($pages->next()): ?>
               <li><a<?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>
            <?php endwhile; ?>
            <li class="phone-show-right"><a href="JavaScript:;">侧边栏</a></li>
		</div>
		<div class="nav-btn"><div class="bar1"></div><div class="bar1"></div><div class="bar1"></div></div>
	</nav>
</header>
<!-- end #header -->
		
		<div class="container-warp main-width">
			<div class="container-right">
				<div class="box search-box">
					 <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                    	<input type="text" name="s" class="search-text" placeholder="<?php _e('输入关键字搜索'); ?>" />
                	</form>
				</div>
				<div class="about-me box">
					<div class="title">
						<svg class="icon" aria-hidden="true"><use xlink:href="#icon-me"></use></svg>
						 关于我</div>
					<div class="head-sculpture">
						<img src="<?php if ($this->options->logoUrl){$this->options->logoUrl();}else{echo "https://ws2.sinaimg.cn/mw690/c2cb8acfgy1flwqpiubluj203k03kmxn.jpg";} ?>"/>
					</div>
					<div class="name"><?php if($this->options->sitename2){$this->options->sitename2();}else{$this->options->title();}?>
</div>
					<div class="contact-way">
						<?php if ($this->options->socialqq): ?>
						<a href="<?php $this->options->socialqq(); ?>" target="_blank"><svg class="icon" aria-hidden="true"><use xlink:href="#icon-qq"></use></svg></a>
						<?php endif; ?>
						<?php if ($this->options->socialtwitter): ?>
						<a href="<?php $this->options->socialtwitter(); ?>"><svg class="icon" aria-hidden="true"><use xlink:href="#icon-twitter"></use></svg></a>
						<?php endif; ?>
						<?php if ($this->options->socialweibo): ?>
						<a href="<?php $this->options->socialweibo(); ?>"><svg class="icon" aria-hidden="true"><use xlink:href="#icon-weibo-oc"></use></svg></a>
						<?php endif; ?>
            			<?php if ($this->options->socialgithub): ?>
						<a href="<?php $this->options->socialgithub(); ?>"><svg class="icon" aria-hidden="true"><use xlink:href="#icon-github"></use></svg></a>
						<?php endif; ?>
						<?php if ($this->options->socialemail): ?>
						<a href="#" title="<?php $this->options->socialmail(); ?>"><svg class="icon" aria-hidden="true"><use xlink:href="#icon-email"></use></svg></a>
						<?php endif; ?>
					</div>
					<div class="introduce">
						<?php if($this->options->rightinfo){$this->options->rightinfo();}else{echo "喵 喵 喵<br>请在主题设置里进行设置";}?>
					</div>
					<div class="love-me"><svg class="icon" aria-hidden="true" ><use xlink:href="#icon-love"></use></svg></div>
				</div>
				<footer >
					© 2017 HAOTOWN-疯狂减肥带<br />
					<?php if($this->options->icp){$this->options->icp();}else{echo "鲁ICP备15029864号";}?>
				</footer>
			</div>
			<div class="container">
		<?php } ?>	

    
    
