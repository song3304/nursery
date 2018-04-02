<div class="form-group">
	<label class="col-md-3 control-label" for="title">标题</label>
	<div class="col-md-9">
		<input type="text" id="title" name="title" class="form-control" placeholder="请输入标题" value="<{$_data.title}>">
	</div>
</div>
<div class="form-group">
	<label class="col-md-3 control-label" for="pic_id">图片</label>
	<div class="col-md-9">
		<input type="hidden" id="pic_id" name="pic_id" class="form-control" placeholder="请输入..." value="<{$_data.pic_id|default:0}>">
	</div>
</div>
<div class="form-group">
	<label class="col-md-3 control-label" for="contents">资讯内容</label>
	<div class="col-md-9">
		<input type="hidden" id="type" name="type" value="<{$_data.type}>">
		<textarea id="contents" name="contents" class="form-control" placeholder="请输入资讯内容..." style="height:200px;"><{$_data.contents}></textarea>
	</div>
</div>
<div class="form-group form-actions">
	<div class="col-md-9 col-md-offset-3">
		<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> 提交</button>
		<button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> 重设</button>
	</div>
</div>