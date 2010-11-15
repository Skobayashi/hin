<h4><?php echo link_to('トップへ' , '@homepage')?></h4>
<h3>投書コーナー確認画面</h3>
<p>意見要望、その他些細な出来事があった際に、下記フォームに入力・送信すると小林すにメールが送れます。</p>

<form action="<?php echo url_for('contents/send') ?>" method="post" />
<table id="form" class="contact">
	<tr>
		<th id="user">名前</th>
		<td><?php echo $data['username']?></td>
	</tr>
	<tr>
		<th id="content">内容</th>
		<td><?php echo preg_replace('/\n/' , '<br/>' , $data['content'])?></td>
	</tr>
	<tr>
		<td colspan="2"><input type="button" value="戻る" onclick="document.location.href='<?php echo url_for('contents/contact')?>';"/>
		<input type="submit" value="送信"/></td>
	</tr>
</table>
<input type="hidden" id="user" name="user" value="<?php echo $data['username']?>"/>
<input type="hidden" id="content" name="content" value="<?php echo $data['content']?>"/>
</form>