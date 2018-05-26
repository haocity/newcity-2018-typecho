<?php
/**
 * NEWCITY 2018
 * 
 * @package HAOTOWN 
 * @author 疯狂减肥带
 * @version 2018.1
 * @link http://haotown.cn
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>

<?php while($this->next()): ?>
<div class="box post flipInX" cid="<?php echo $this->cid;?>">
	
	<div class="post-con ">
		<!--内容-->
		<?php if($this->options->slimg && 'guanbi'==$this->options->slimg): ?>
		<?php else: ?>
		<?php if($this->options->slimg && 'showoff'==$this->options->slimg): ?><a href="<?php $this->permalink() ?>" ><?php showThumbnail($this); ?></a>
		<?php else: ?>
		<div class="simg" style="background-image: url('<?php showThumbnail($this); ?>');"></div>
		<?php endif; ?>
		<?php endif; ?>
		<div class="post-con-main">
			<h2 class="title"><a href="<?php $this->permalink() ?>" target="_blank"><?php $this->title() ?></a></h2>
			<div class="con">
				<?php $this->excerpt(160, '...'); ?>
			</div> 
		</div>
		<p class="more"><a href="<?php $this->permalink() ?>" >阅读全文</a></p>
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
<?php endwhile; ?>


<?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>



<?php $this->need('footer.php'); ?>
