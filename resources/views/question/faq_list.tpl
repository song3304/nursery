<{extends file="extends/main.block.tpl"}>

<{block "head-styles-after"}>
  <link rel="stylesheet" type="text/css" href="<{'static/css/slick.css'|url}>"/>
  <link rel="stylesheet" type="text/css" href="<{'static/css/base.css'|url}>"/>
  <link rel="stylesheet" type="text/css" href="<{'static/css/style.css'|url}>"/>
  <link rel="stylesheet" type="text/css" href="<{'static/css/iconfont/iconfont.css'|url}>"/>
<{/block}>

<{block "head-scripts-plus"}>
	<script src="<{'static/js/basic.js'|url}>"></script>
	<script src="<{'static/js/rem.js'|url}>"></script>
<{/block}>

<{block "body-container"}>
	<div class="header">
		<span>咨询解答</span>
		<a href="javascript:window.history.go(-1);" class="back"><i class="iconfont icon-left"></i></a>
	</div>
	<div class="banner">
		<img src="<{'static/img/self-report.png'|url}>">
	</div>
	<div class="answer-box">
			<ul class="answer-content">
				<a href="<{'question/faq_item'|url}>">
				<li class="answer-list">
					<h3 class="list-tit">请问如何申请助学贷款？请问如何申请助学贷款？</h3>
				    <p class="list-txt">
                                           学生申请贷款，应由本人向学校贷款审定机构提出申请，提供本人及家
					庭经济状况的必要资料（一般包括本人书面申请、家庭经济情况调查表、
					街道或乡级以上的困难证明、担保人的担保书及本人的现实表现等），
					承诺有关还贷的责任条款，提供还贷担保人。目前各高校学生贷款实际
					额度一般每年在1000元以上。
				    </p>
				</li>
				</a>
				<a href="<{'question/detail'|url}>">
				<li class="answer-list">
					<h3 class="list-tit">请问如何申请助学贷款？请问如何申请助学贷款？</h3>
				    <p class="list-txt">
                                           学生申请贷款，应由本人向学校贷款审定机构提出申请，提供本人及家
					庭经济状况的必要资料（一般包括本人书面申请、家庭经济情况调查表、
					街道或乡级以上的困难证明、担保人的担保书及本人的现实表现等），
					承诺有关还贷的责任条款，提供还贷担保人。目前各高校学生贷款实际
					额度一般每年在1000元以上。
				    </p>
				</li>
				</a>
			</ul>
		</div>
	<{include file="home/footer.inc.tpl"}>	
<{/block}>