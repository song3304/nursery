<{if $_act == 'reply'}>
<div class="form-group">
	<label class="col-md-3 control-label" for="user">提问</label>
	<div class="col-md-9">
		<label class="form-control"><{$_data.user.username}>:<{$_data.parents.content}></label>
	</div>
</div>
<{/if}>
<div class="form-group">
	<label class="col-md-3 control-label" for="content"><{if $_data.act=='reply'}>回复<{else}>问题<{/if}></label>
	<div class="col-md-9">
		<input type="hidden" name="user_id" value="<{$_data.user_id}>"/>
		<input type="hidden" name="pid" value="<{$_data.pid}>"/>
		<textarea class="form-control" id="content" name="content" placeholder="请输入<{if $_data.act=='reply'}>回复<{else}>问题<{/if}>..."><{$_data.content}></textarea>
	</div>
</div>
<div class="form-group form-actions">
	<div class="col-md-9 col-md-offset-3">
		<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> 提交</button>
		<button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> 重设</button>
	</div>
</div>