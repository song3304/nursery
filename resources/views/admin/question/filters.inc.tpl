<!-- Form Content -->
<form action="<{'admin'|url nofilter}>/<{block "name"}><{/block}>" method="GET" class="form-bordered form-horizontal">
	<div class="form-group col-sm-4">
		<label class="col-md-3 control-label" for="title">关键字</label>
		<div class="col-md-9">
			<div class="input-group">
				<input type="text" id="content" name="f[content][lk]" class="form-control" placeholder="请输入问题关键字..." value="<{$_filters.content.like}>">
			</div>
		</div>
	</div>
	<div class="form-group col-sm-4">
		<label class="col-md-3 control-label" for="classId">用户名</label>
		<div class="col-md-9">
			<select name="f[user_id][in][]" class="select-model form-control" data-id="{{id}}" data-model="admin/member" data-text="{{username}}" data-params='{"f[role_id]":"1"}' data-term="title" data-placeholder="请输入用户名" value="<{$_filters.user_id.in|default:[]|implode:','}>"></select>
		</div>
	</div>
	<div class="form-group col-sm-4">
		<label class="col-md-3 control-label" for="created_at-min">加入时间</label>
		<div class="col-md-9">
			<div class="input-group input-daterange">
				<input type="text" id="created_at-min" name="f[created_at][min]" class="form-control text-center" placeholder="开始时间" value="<{$_filters.created_at.min}>">
				<span class="input-group-addon">～</span>
				<input type="text" id="created_at-max" name="f[created_at][max]" class="form-control text-center" placeholder="结束时间" value="<{$_filters.created_at.max}>">
			</div>
		</div>
	</div>
	<div class="form-group col-sm-12 text-right">
		<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> 检索</button>
		<button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> 重置</button>
	</div>
	<div class="clearfix"></div>
</form>
<!-- END Form Content -->
<script>
(function($){
	$().ready(function(){
		$('#created_at-min').on('focus',function(){
			WdatePicker({
				skin: 'twoer',
				isShowClear:true,
				readOnly:true,
				dateFmt:'yyyy-MM-dd',
				isShowOthers:false,
				maxDate: '#F{$dp.$D(\'created_at-max\')}'
			});
		});
		$('#created_at-max').on('focus',function(){
			WdatePicker({
				skin: 'twoer',
				isShowClear:true,
				readOnly:true,
				dateFmt:'yyyy-MM-dd',
				isShowOthers:false,
				minDate: '#F{$dp.$D(\'created_at-min\')}'
			});
		});
	});
})(jQuery);
</script>