<{foreach $_question_list as $question}>
	<a href="<{'question/faq_item?id='|url}><{$question.id}>">
		<li>
			<span class="route-icon"><i class="iconfont icon-zixun"></i></span>
			<span class="route-word"><{$question.content}></span>
			<span class="goin"><{$question.created_at|date_format:"%Y-%m-%d"}></span>
		</li>
	</a>
<{/foreach}>