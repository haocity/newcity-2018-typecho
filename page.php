<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="box post" cid="<?php echo $this->cid;?>">
	<h2 class="title"><a href="<?php $this->permalink() ?>" target="_blank"><?php $this->title() ?></a></h2>
	<div class="post-con ">
		<!--内容-->
		<?php $this->content(); ?>
	</div>
	<div class="post-bottom">
		<div class="post-bottom-time">
			发表于<time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time>
		</div>
		<div class="post-bottom-classify">
			<svg class="icon" aria-hidden="true">
				<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-icon-class"></use>
			</svg>
			分类:<?php $this->category(','); ?>
		</div>
		<div class="post-bottom-comnum pointer">
			<svg class="icon" aria-hidden="true">
				<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-comment"></use>
			</svg>
			评论
		</div>
		<div class="post-bottom-love pointer">
			<svg class="icon" aria-hidden="true">
				<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-love1"></use>
			</svg><span>已喜欢</span>
		</div>
		<div class="post-bottom-share pointer">
			<svg class="icon" aria-hidden="true">
				<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-share"></use>
			</svg>
			分享
		</div>
		<div class="post-bottom-tts pointer">
			<svg class="icon" aria-hidden="true">
				<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-maikefeng"></use>
			</svg>
			朗读
		</div>
	</div>
	<div class="post-ex"></div>
</div>
<?php $this->need('comments.php'); ?>
<?php $this->need('footer.php'); ?>
