<h1>品情 No.<?php echo $hin['id'] ?></h1>
<?php $hin = $sf_data->getRaw('hin') ?>
<?php $model = $sf_data->getRaw('model') ?> 
<?php $author = $sf_data->getRaw('author') ?>
<?php use_helper('Form') ?>
<?php use_helper('Javascript') ?>
<?php $last = HinTable::moveLast() ?>
<?php $now = HinTable::idPage($hin['id']) ?>

<?php echo link_to('ラストページへ' , 'contents/index?page=' . $last) ?><br/>
<?php echo link_to('現在のリスト画面へ' , 'contents/index?page=' . $now) ?>
<table cellpadding="10" cellspacing="0" id="form">
	
	<tfoot>
		<tr>
			<td colspan="2">
				<?php echo form_tag('contents/xml') ?>
				<?php echo submit_tag('xml書き出し' ,array('confirm' => 'XMLを書き出しますか?')) ?>
				<?php echo input_hidden_tag('id' , $hin['id']) ?>
				</form>
			</td>
		</tr>
	</tfoot>

    <tr><th>Id</th><td><?php echo $hin['id'] ?></td></tr>
	
    <tr><th>発信部所</th><td><?php echo $author ?></td></tr>
	
    <tr><th>発信日</th><td><?php echo str_replace( '-' , '/' , $hin['dispatchday']) ?></td></tr>
	
	<tr><th>機種</th><td>
		<?php foreach($model as $model): ?>
		<?php echo $model . "<br/>" ?>
		<?php endforeach; ?>
		</td></tr>
	
    <tr><th>機番</th><td><?php echo $hin['modelnumber'] ?></td></tr>
	
    <tr><th>アワメータ</th><td><?php echo $hin['hourmeter'] ?></td></tr>
	
    <tr><th>納入年月</th><td><?php echo str_replace('-', '/', $hin['delivery']) ?></td></tr>
	
    <tr><th>ユーザー名</th><td><?php echo $hin['user'] ?></td></tr>
	
    <tr><th>発生日</th><td><?php echo str_replace('-', '/', $hin['outbreak']) ?></td></tr>
	
    <tr><th>アタッチメント</th><td><?php echo $hin['attachment'] ?></td></tr>
	
    <tr><th>メッセージ</th><td><?php echo $hin['message'] ?></td></tr>
	
    <tr><th>内容</th><td><?php echo $hin['contents'] ?></td></tr>
	
    <tr><th>管理表No.</th><td><?php echo $hin['management'] ?></td></tr>
	
</table>

<a href="<?php echo url_for('contents/edit?id=' . $hin['id']) ?>">編集</a>