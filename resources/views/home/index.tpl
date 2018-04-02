<{extends file="extends/main.block.tpl"}>
<{block "head-styles-plus"}>
	<link rel="stylesheet" type="text/css" href="<{'static/css/slick.css'|url}>" />
	<link rel="stylesheet" type="text/css" href="<{'static/css/base.css'|url}>" />
	<link rel="stylesheet" type="text/css" href="<{'static/css/style.css'|url}>" />
	<link rel="stylesheet" type="text/css" href="<{'static/css/all.css'|url}>"/>
	<link rel="stylesheet" type="text/css" href="<{'static/css/swiper.min.css'|url}>"/>
	<link rel="stylesheet" type="text/css" href="<{'static/css/iconfont/iconfont.css'|url}>" />
<{/block}>
<{block "head-scripts-plus"}>
	<script src="<{'static/js/fastclick.js'|url}>"></script>
	<script src="<{'static/js/slick.min.js'|url}>"></script>	
	<script src="<{'static/js/rem.js'|url}>"></script>
	<script src="<{'static/js/basic.js'|url}>"></script>
	<script src="<{'static/js/swiper.jquery.min.js'|url}>"></script>
    <script>
	(function($){
		$(function() { 
			$('.autoplay').slick({
				slidesToScroll: 1,
				autoplay: true,
				autoplaySpeed: 2000,
				dots:true,
			});
		    var banner = new Swiper('.banner',{
		        autoplay: 5000,
		        pagination : '.swiper-pagination',
		        paginationClickable: true,
		        lazyLoading : true,
		        loop:true
		    });		
		});
	})(jQuery);
	</script>
<{/block}>
<{block "body-container"}>	
<div class="header">
			<span><{config('settings.title')}></span>
			<a href="<{'ucenter'|url}>" style="padding-top:0;"><span class="user" style="padding-top:0;"><i class="iconfont icon-person"></i></span></a>
		</div>
		<div class="banner swiper-container">
            <div class="swiper-wrapper">
            	<{foreach $_banners as $banner}>
                <div class="swiper-slide"><a href="<{if $banner.url}><{$banner.url}><{else}>javascript:void(0);<{/if}>"><img class="swiper-lazy" data-src="<{"attachment?id="|url}><{$banner.cover}>" alt="<{$banner.title}>"></a></div>
                <{/foreach}>
            </div>
            <div class="swiper-pagination"></div>
        </div>
		<div class="menu">
			<ul class="clearfix">
				<li>
					<a href="<{'order'|url}>">
						<img src="<{'static/img/icon1.png'|url}>">
						<p class="menu-txt">交水费</p>
					</a>
				</li>
				<li>
					<a href="javascript:alert('正在开发，敬请期待..');"><!--href="<{'ucenter/fee_inquiry'|url}>"-->
						<img src="<{'static/img/icon2.png'|url}>">
						<p class="menu-txt">查水费</p>
					</a>
				</li>
				<li>
					<a href="<{'notice'|url}>">
						<img src="<{'static/img/icon6.png'|url}>">
						<p class="menu-txt">通知公告</p>
					</a>
				</li>
				<li>
					<a href="<{'question'|url}>">
						<img src="<{'static/img/icon8.png'|url}>">
						<p class="menu-txt">咨询帮助</p>
					</a>
				</li>
			</ul>
		</div>
		<div class="brief">
			<h3 class="brief-tit">公司简介</h3>
			<a href="<{'article/company_info'|url}>">
			<div class="brirf-content clearfix">
				<div class="bc-left fl">
					<img src="<{"attachment?id="|url}><{$_company_info.pic_id}>">
				</div>
				<div class="bc-right fr">
					<{$_company_info.contents|truncate:40:"..."}>
				</div>
			</div>
			</a>
		</div>
		<dl class="news">
			<dt class="news-tit">公司资讯</dt>
			<{foreach $_company_cms as $cms_item}>
			<a href="<{'article/cms_info?id='|url}><{$cms_item.id}>">
			<dd class="news-content clearfix">
				<div class="nc-left fl">
					<img src="<{"attachment?id="|url}><{$cms_item.pic_id}>">
				</div>
				<div class="nc-right fr">
					<a href="<{'article/cms_info?id='|url}><{$cms_item.id}>" class="ncr-top"><{$cms_item.contents|truncate:40:"..."}></a>
					<span class="nc-time"><{$cms_item.created_at|date_format:"%m-%d %H:%M"}></span>
				</div>
			</dd>
			</a>
			<{/foreach}>
		</dl>
	<{include file="home/footer.inc.tpl"}>	
<{/block}>