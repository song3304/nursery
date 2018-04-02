<div class="form-group">
	<label class="col-md-3 control-label" for="account_num">户号</label>
	<div class="col-md-9">
		<input type="text" id="account_num" name="account_num" class="form-control" placeholder="请输入户号" value="<{$_data.account_num}>">
	</div>
</div>
<div class="form-group">
	<label class="col-md-3 control-label" for="account_name">户名</label>
	<div class="col-md-9">
		<input type="hidden" id="account_name" name="account_name" class="form-control" placeholder="请输入户名..." value="<{$_data.account_name}>">
	</div>
</div>
<div class="form-group">
	<label class="col-md-3 control-label" for="account_address">地址</label>
	<div class="col-md-9">
		<input type="hidden" id="account_address" name="account_address" class="form-control" placeholder="请输入地址..." value="<{$_data.account_address}>">
	</div>
</div>
<div class="form-group">
	<label class="col-md-3 control-label" for="account_phone">预留电话</label>
	<div class="col-md-9">
		<input type="text" id="account_phone" name="account_phone" class="form-control" placeholder="请输入联系电话..." value="<{$_data.account_phone}>">
	</div>
</div>
<div class="form-group form-actions">
	<div class="col-md-9 col-md-offset-3">
		<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> 提交</button>
		<button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> 重设</button>
	</div>
</div>