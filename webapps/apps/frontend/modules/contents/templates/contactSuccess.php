<h4><?php echo link_to('トップへ' , '@homepage')?></h4>
<h3>投書コーナー</h3>
<p>意見要望、その他些細な出来事があった際に、下記フォームに入力・送信すると小林すにメールが送れます。</p>

<form action="<?php echo url_for('contents/validator')?>" method="post" >
<table id="form" class="contact">
<?php echo $form->renderGlobalErrors() ?>
	<tr>
		<th id="user"><?php echo $form['username']->renderLabel()?></th>
		<td><?php echo $form['username']?>
		<?php echo $form['username']->renderError()?></td>
	</tr>
	<tr id="button">
		<th id="content"><?php echo $form['content']->renderLabel()?></th>
		<td><?php echo $form['content']?>
		<?php echo $form['content']->renderError()?></td>
	</tr>
	<tr>
		<td colspan="2"><input type="button" value="戻る" onclick="document.location.href='<?php echo url_for('@homepage')?>';"/>
		<input type="submit" value="確認"/></td>
	</tr>
</table>
</form>
