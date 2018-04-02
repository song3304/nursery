<div class="form-group">
	<label class="col-md-3 control-label" for="title">标题</label>
	<div class="col-md-9">
		<input type="text" id="title" name="title" class="form-control" placeholder="请输入标题" value="<{$_data.title}>">
	</div>
</div>
<div class="form-group">
	<label class="col-md-3 control-label" for="url">url</label>
	<div class="col-md-9">
		<input type="text" id="url" name="url" class="form-control" placeholder="请输入url" value="<{$_data.url}>">
	</div>
</div>
<div class="form-group">
	<label class="col-md-3 control-label" for="location">位置</label>
	<div class="col-md-9"><!--0.首页 1.个人中心 2.通知公告 3.公司资讯 4.常见问题 5.我的问题-->
		<select name="location" id="location" class="form-control">
			<option value="0" <{if $_data.location eq 0}>selected="selected"<{/if}>>首页</option>
			<option value="1" <{if $_data.location eq 1}>selected="selected"<{/if}>>个人中心</option>
			<option value="2" <{if $_data.location eq 2}>selected="selected"<{/if}>>通知公告</option>
			<option value="3" <{if $_data.location eq 3}>selected="selected"<{/if}>>公司资讯</option>
			<option value="4" <{if $_data.location eq 4}>selected="selected"<{/if}>>常见问题</option>
			<option value="5" <{if $_data.location eq 5}>selected="selected"<{/if}>>我的问题</option>
		</select>
	</div>
</div>
<div class="form-group">
	<label class="col-md-3 control-label" for="status">状态</label>
	<div class="col-md-9">
		<input type="radio" name="status" value="1" <{if $_data.status eq '1'}>checked="checked"<{/if}>>显示
		<input type="radio" name="status" value="0" <{if $_data.status eq '0'}>checked="checked"<{/if}>>隐藏
	</div>
</div>
<div class="form-group">
	<label class="col-md-3 control-label" for="cover_aids">封面</label>
	<div class="col-md-9">
		<input type="hidden" id="cover" name="cover" class="form-control" placeholder="请输入..." value="<{$_data.cover|default:0}>">
	</div>
</div>
<div class="form-group">
	<label class="col-md-3 control-label" for="porder">排序</label>
	<div class="col-md-9">
		<input type="text" id="porder" name="porder" class="form-control" placeholder="请输入排序" value="<{$_data.porder|default:0}>">
	</div>
</div>
<div class="form-group form-actions">
	<div class="col-md-9 col-md-offset-3">
		<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> 提交</button>
		<button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> 重设</button>
	</div>
</div>