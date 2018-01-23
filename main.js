let city = new Object;
document.addEventListener('DOMContentLoaded',function(){
//console.log("ok")
city.copy = document.querySelector(".h-copy")
city.copy.t = city.copy.querySelector('textarea')

city.share = document.querySelector(".h-share")
city.share.wb = city.share.querySelector(".wb")
city.share.qr = city.share.querySelector(".qr")
city.loadehtml=`<div class="cssload-wraper">
	<div class="cssload-dots"></div>
</div>`
city.loadele=document.querySelector('.isload')
//评论
function opencom(e) {
	let c = e.querySelector('.post-ex');
	let t=e.querySelector(".more")
	if(t){
		t.style.top=t.offsetTop+'px'
		t.style.bottom="initial"
	}
	if(e.hco) {
		c.innerHTML = "";
		e.hco = false
	} else {
		new Hco(c, 'blog', e.getAttribute("cid"));
		e.hco = true;
		
	}

}
//事件
document.querySelector('.container').addEventListener('click',
	function(e) {
		let ele = e.target;
		
		if(ele.nodeName == "SPAN") {
			ele = ele.parentNode;
		}
		if(ele.nodeName == "use") {
			ele = ele.parentNode
		}
		if(ele.nodeName == "svg") {
			ele = ele.parentNode
		}
		
		if(ele.classList.contains("pointer")) {
			if(ele.classList.contains("post-bottom-comnum")) {
				//评论
				opencom(ele.parentNode.parentNode)
			} else if(ele.classList.contains("post-bottom-love")) {
				//喜欢
				if(!ele.love) {
					ele.love = true;
					ele.querySelector('span').innerHTML = '已喜欢';
					uplove(ele.parentNode.parentNode.pid);
					fetch(city.api + "love?id=" + ele.parentNode.parentNode.pid).then(function(t) {
						console.log(t)
					})
				}
			} else if(ele.classList.contains("post-bottom-share")) {
				//分享
				
				let url = ele.parentNode.parentNode.querySelector(".title>a").href;
				let title = "疯狂减肥带-" + ele.parentNode.parentNode.querySelector(".title>a").innerText;
				city.copy.t.value = url;
				city.share.wb.href = `http://s.share.baidu.com/?click=1&url=${url}&uid=0&to=tsina&type=text&pic=&title=${title}&key=&desc=&comment=&relateUid=&searchPic=0&sign=on&l=1c1n207cd1c1n208bl1c1n20ste&linkid=jbdfo64647k&firstime=1513671457197`
				city.share.qr.src = `https://app.haotown.cn/qr/?url=${url}&&size=3`
				city.share.style.top = e.clientY + document.documentElement.scrollTop - 20 + 'px'
				city.share.style.left = e.clientX + document.documentElement.scrollLeft - 20 + 'px'
				city.share.style.display = 'block'
			}
		}
	})
//滚动
if(srollopen){
	document.addEventListener('scroll', function() {
		if(document.documentElement.clientHeight + document.documentElement.scrollTop >= document.body.offsetHeight-10) {
			if(!city.isload&&city.pagenav&&city.pagenav.next){
				console.log("加载下一页");
				city.isload=true;
				load2(city.pagenav.next,false)
			}
		}
	})
}

city.copy.t.addEventListener('click',function(){
	this.select();
	document.execCommand("Copy");
})
city.share.onmouseleave = function() {
	this.style.display = 'none'
}

function changermore(){
	city.pagenav=document.querySelector('.page-navigator');
	if(city.pagenav){
		city.pagenav.next=city.pagenav.querySelector('.next>a');
	}
	let arr=document.querySelectorAll('.more>a');
	for (let i = 0; i < arr.length; i++) {
		if(!arr[i].u){
			if(location.host&&arr[i].href.indexOf(location.host)>-1){
				arr[i].u=arr[i].href.split(location.host)[1]
			}else{
				arr[i].u=arr[i].href
			}
			arr[i].href="JavaScript:;"
			arr[i].parentNode.parentNode.className="post-con small\n";
			arr[i].parentNode.parentNode.onclick=function(){
				let _this=this;
				this.querySelector('.con').innerHTML=city.loadehtml
				this.querySelector('.more').style.display='none'
				loadone(arr[i],function(){_this.className="post-con"});
			}
		}
		
	}
	let arr2=document.querySelectorAll(".page-navigator>li>a")
	for (let i = 0; i < arr2.length; i++) {
		if(location.host&&arr2[i].href.indexOf(location.host)>-1){
			arr2[i].u=arr2[i].href.split(location.host)[1]
		}else{
			arr2[i].u=arr2[i].href
		}
		arr2[i].href="JavaScript:;"
		arr2[i].onclick=function(){
			load2(this,true)
		};
	}
}

function loadone(e,callback){
	let xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			let a=xmlhttp.responseText
			let w=e.parentNode.parentNode.querySelector(".post-con-main>.con")
			if(w){
				w.innerHTML=a;
				changerurl(w.parentNode.querySelector(".title>a").innerText+"--"+optionstitle,e.u)
				if(callback){
					callback()
				}
			}
			e.style.display='none'
		}
	}
	xmlhttp.open("GET",e.u+"?ajax=true",true);
	xmlhttp.send();
	
//	fetch(e.u+"?ajax=true").then(function(t) {
//		return t.text();
//	}).then(function(a){
//		let w=e.parentNode.parentNode
//		if(w){
//			w.innerHTML=a;
//			changerurl(w.parentNode.querySelector(".title>a").innerText+"--"+optionstitle,e.u)
//		}
//	})
}
function load2(e,isin,callback){
	city.loadele.style.display='block'
	if(!e.u){
		e.u=e.href
	}
	let xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			let a=xmlhttp.responseText
				if(isin) {
					document.querySelector('.container').innerHTML = a
					changermore()
					changerurl("第" + e.innerText + "页" + "--" + optionstitle, e.u)
				} else {
					city.pagenav.parentNode.removeChild(city.pagenav)
					let t1 = document.createElement('div');
					t1.innerHTML = a
					let t2 = t1.children
					for(let i = 0, max = t2.length; i < max; i++) {
						document.querySelector('.container').appendChild(t2[0]);
					}
					changermore()
					changerurl("第" + city.pagenav.querySelector(".current>a").innerText + "页" + "--" + optionstitle, e.u)
				}
				city.isload = false
				city.loadele.style.display='none'
				if(callback){callback()}
		}
	}
	xmlhttp.open("GET",e.u+"?ajax=true",true);
	xmlhttp.send();
	
//	fetch(e.u+"?ajax=true").then(function(t) {
//		return t.text();
//	}).then(function(a){
//		if(isin){
//			document.querySelector('.container').innerHTML=a
//			changermore()
//			changerurl("第"+e.innerText+"页"+"--"+optionstitle,e.u)
//		}else{
//			city.pagenav.parentNode.removeChild(city.pagenav)
//			let t1=document.createElement('div');
//			t1.innerHTML=a
//			let t2=t1.children
//			for (let i = 0,max=t2.length; i < max; i++) {
//				document.querySelector('.container').appendChild(t2[0]);
//			}
//			changermore()
//			changerurl("第"+city.pagenav.querySelector(".current>a").innerText+"页"+"--"+optionstitle,e.u)
//		}
//		city.isload=false
//		
//	})
}
function changerurl(title,newUrl){
	var stateObject = {};
	try{
		history.pushState(stateObject,title,newUrl);
	}catch(e){console.log("你的浏览器过时了！")}
	document.title=title;
}



changermore();
document.documentElement.scrollTop=0;
})