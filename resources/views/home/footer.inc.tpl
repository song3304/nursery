<div class="footer">
	<ul class="footer-page clearfix">
		<li class="page-item<{if $_nav=='index'}> active<{/if}>">
			<a href="<{''|url}>">
				<i class="iconfont icon-index"></i>
				<p>首页</p>
			</a>
		</li>
		<li class="page-item<{if $_nav=='pay_water'}> active<{/if}>">
			<a href="<{'order'|url}>">
				<i class="iconfont icon-computer"></i>
				<p>交水费</p>
			</a>
		</li>
		<li class="page-item<{if $_nav=='faq'}> active<{/if}>">
			<a href="<{'question'|url}>">
				<i class="iconfont icon-ask"></i>
				<p>咨询帮助</p>
			</a>
		</li>
		<li class="page-item<{if $_nav=='ucenter'}> active<{/if}>">
			<a href="<{'ucenter'|url}>">
				<i class="iconfont icon-person1"></i>
				<p>个人中心</p>
			</a>
		</li>
	</ul>
</div>