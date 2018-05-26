<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('头像地址'), _t('在这里填入一个图片URL地址'));
    $form->addInput($logoUrl);	
    $sitename = new Typecho_Widget_Helper_Form_Element_Text('sitename', NULL, NULL, _t('输入站点名称'), _t('在这里输入导航条显示的站点名称 留空则显示基本设置中的站点名称'));
    $form->addInput($sitename);
	
	$sitename2 = new Typecho_Widget_Helper_Form_Element_Text('sitename2', NULL, NULL, _t('输入站点左侧名称'), _t('在这里输入左侧显示的站点名称 留空则显示基本设置中的站点名称'));
    $form->addInput($sitename2);
	
    $srollSet = new Typecho_Widget_Helper_Form_Element_Radio('srollSet',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'able', _t('滚动加载设置'), _t('默认开启 页面到达底部时加载下一页'));
    $form->addInput($srollSet);

    
    $socialweibo = new Typecho_Widget_Helper_Form_Element_Text('socialweibo', NULL, NULL, _t('输入微博链接'), _t('在这里输入微博链接 留空则不显示'));
    $form->addInput($socialweibo);
    $socialqq = new Typecho_Widget_Helper_Form_Element_Text('socialqq', NULL, NULL, _t('输入QQ链接'), _t('在这里输入QQ链接例子:http://wpa.qq.com/msgrd?v=3&uin=123456&site=qq&menu=yes  123456为你的QQ'));
    $form->addInput($socialqq);
    $socialgithub = new Typecho_Widget_Helper_Form_Element_Text('socialgithub', NULL, NULL, _t('输入GitHub链接'), _t('在这里输入GitHub链接,留空则不显示'));
    $form->addInput($socialgithub);
    $socialtwitter = new Typecho_Widget_Helper_Form_Element_Text('socialtwitter', NULL, NULL, _t('输入twitter链接'), _t('在这里输入twitter链接,留空则不显示'));
    $form->addInput($socialtwitter);
	$socialmail = new Typecho_Widget_Helper_Form_Element_Text('socialmail', NULL, NULL, _t('输入邮箱链接'), _t('在这里输入mail链接,留空则不显示'));
    $form->addInput($socialmail);
	


	$icp = new Typecho_Widget_Helper_Form_Element_Text('icp', NULL, null, _t('输入备案号'), _t('例如：鲁ICP备15029864号'));
    $form->addInput($icp);
	
	
	
    $customnav = new Typecho_Widget_Helper_Form_Element_Textarea('customnav', NULL, NULL, _t('输入自定义菜单'), _t('在这里输入新的菜单栏 格式&lt;li&gt;&lt;a href="http://app.haotown.cn/"&gt;项目&lt;/a&gt;&lt;/li&gt; '));
    $form->addInput($customnav);
	
	$rightinfo = new Typecho_Widget_Helper_Form_Element_Textarea('rightinfo', NULL, NULL, _t('输入右侧自定义菜单'), _t('显示在右边头像下面'));
    $form->addInput($rightinfo);
	
	    $slimg = new Typecho_Widget_Helper_Form_Element_Select('slimg', array(
            'showon'=>'有图文章显示缩略图，无图文章随机显示缩略图',
            'Showimg' => '有图文章显示缩略图，无图文章只显示一张固定的缩略图',      
            'showoff' => '有图文章显示缩略图，无图文章则不显示缩略图',
            'allsj' => '所有文章一律显示随机缩略图',
            'guanbi' => '关闭所有缩略图显示'
        ), 'showon',
        _t('缩略图设置'), _t('默认选择“有图文章显示缩略图，无图文章随机显示缩略图”'));
        $form->addInput($slimg->multiMode());
	
	
	
}



function isajax(){
	if(isset($_GET["ajax"])&&$_GET["ajax"]=='true'){
	   return TRUE;	
	}else{
	  return FALSE;
	}
}	


function themeFields($layout) {
        $thumb = new Typecho_Widget_Helper_Form_Element_Text('thumb', NULL, NULL, _t('自定义缩略图'), _t('输入缩略图地址(仅文章有效)'));
        $layout->addItem($thumb);
    }
    /** 输出文章缩略图 */
function showThumbnail($widget)
{ 
    // 当文章无图片时的默认缩略图
    $rand = rand(1,4999); 
    // 随机 n张缩略图
    $random = 'https://oneimg.haotown.cn/400/bj@' . $rand . '.jpg'; // 随机缩略图路径
    if(Typecho_Widget::widget('Widget_Options')->slimg && 'Showimg'==Typecho_Widget::widget('Widget_Options')->slimg){
      $random = $widget->widget('Widget_Options')->themeUrl . '/img/mr.png'; //无图时只显示固定一张缩略图
    }
    $cai = '';//这里可以添加图片后缀，例如七牛的缩略图裁剪规则，这里默认为空
    $attach = $widget->attachments(1)->attachment;
    $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i'; 
    $patternMD = '/\!\[.*?\]\((http(s)?:\/\/.*?(jpg|png))/i';
    $patternMDfoot = '/\[.*?\]:\s*(http(s)?:\/\/.*?(jpg|png))/i';
    if (preg_match_all($pattern, $widget->content, $thumbUrl)) {
		$ctu = $thumbUrl[1][0].$cai;
	}

    //如果是内联式markdown格式的图片
    else if (preg_match_all($patternMD, $widget->content, $thumbUrl)) {
    	$ctu = $thumbUrl[1][0].$cai;
    }
    //如果是脚注式markdown格式的图片
    else if (preg_match_all($patternMDfoot, $widget->content, $thumbUrl)) {
    	$ctu = $thumbUrl[1][0].$cai;
    }else if ($attach && $attach->isImage) {
		$ctu = $attach->url.$cai;
    }else if ($widget->tags) {
    	foreach ($widget->tags as $tag) {
			$ctu = './usr/themes/yodu/img/tag/' . $tag['slug'] . '.jpg';
			if(is_file($ctu)){ 
    			$ctu = $widget->widget('Widget_Options')->themeUrl . '/img/tag/' . $tag['slug'] . '.jpg';
        	}else{
           		$ctu = $random;
        	}
    		break;
    	}
    }else {
    	$ctu = $random;
    }
    if(Typecho_Widget::widget('Widget_Options')->slimg && 'showoff'==Typecho_Widget::widget('Widget_Options')->slimg){
	    if($widget->fields->thumb){$ctu = $widget->fields->thumb;}
	    if($ctu== $random) echo '';
	    else if($widget->is('post')||$widget->is('page')){
	    	echo $ctu;
	    }else{
		 	echo '<img src="'.$ctu.'">';
	    }
    }else{
	    if($widget->fields->thumb){$ctu = $widget->fields->thumb;}
	    if(!$widget->is('post')&&!$widget->is('page')){
		    if(Typecho_Widget::widget('Widget_Options')->slimg && 'allsj'==Typecho_Widget::widget('Widget_Options')->slimg){$ctu = $random;}
	    }
	    echo $ctu;
    }
}
