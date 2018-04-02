<{foreach $_question_list as $question}>
	<a href="<{'question/detail?id='|url}><{$question.id}>">
	<li class="answer-list">
		<h3 class="list-tit" style="font-weight: bold;"><{$question.title}></h3>
		  <p class="list-txt"><{$question.contents|truncate:40:"..."}></p>
	</li>
	</a>
<{/foreach}>