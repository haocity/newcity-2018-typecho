<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
	
<?php if (!isajax()) { ?>
    </div>
</div>

<div class="footer">本站由 <a href="#">TYPECHO</a>强力驱动 <?php if($this->options->icp){$this->options->icp();}else{echo "鲁ICP备15029864号";}?></div>
<div class="h-share">
	<a class="wb" href="#" target="_blank"><svg class="icon" aria-hidden="true"><use xlink:href="#icon-weibo-oc"></use></svg>微博分享</a>
	<a href="javacript:void(0)" class="h-copy"><svg class="icon" fill="#9fadc7" viewBox="0 0 24 24" width="20" height="20"><path d="M6.77 17.23c-.905-.904-.94-2.333-.08-3.193l3.059-3.06-1.192-1.19-3.059 3.058c-1.489 1.489-1.427 3.954.138 5.519s4.03 1.627 5.519.138l3.059-3.059-1.192-1.192-3.059 3.06c-.86.86-2.289.824-3.193-.08zm3.016-8.673l1.192 1.192 3.059-3.06c.86-.86 2.289-.824 3.193.08.905.905.94 2.334.08 3.194l-3.059 3.06 1.192 1.19 3.059-3.058c1.489-1.489 1.427-3.954-.138-5.519s-4.03-1.627-5.519-.138L9.786 8.557zm-1.023 6.68c.33.33.863.343 1.177.029l5.34-5.34c.314-.314.3-.846-.03-1.176-.33-.33-.862-.344-1.176-.03l-5.34 5.34c-.314.314-.3.846.03 1.177z" fill-rule="evenodd"></path></svg>复制链接<textarea rows="1" class="h-copy-text pointer"></textarea></a>
	<img class="qr"  alt="二維碼" />
</div>
<div class="isload cssload-wraper">
	<div class="cssload-dots"></div>
</div>
<?php $this->footer();?>
</body>
</html>
<?php } ?>