<?php $author = $sf_data->getRaw('author') ?>
<?php use_helper('Form') ?>

<h1>品情リスト</h1>
  <a href="<?php echo url_for('contents/new') ?>">新規作成</a>

<?php if($pager->haveToPaginate()): ?>
<?php $move = new HinForm() ?>
<table class="pager" cellspacing="5">
	<tbody>
		<tr>
			<td name="hover"><a href="<?php echo url_for('contents/index') ?>?page=1">First</a></td>
			<td name="hover"><a href="<?php echo url_for('contents/index') ?>?page=<?php echo $pager->getPreviousPage(); ?>">< Prev</a></td>
<?php foreach ($pager->getLinks() as $page): ?>
<?php if ($page == $pager->getPage()): ?>
			<td class="nowpage"><?php echo $page ?></td>
<?php else: ?>
			<td name="hover"><a href="<?php echo url_for('contents/index') ?>?page=<?php echo $page ?>"><?php echo $page ?></a></td>
<?php endif; ?>
<?php endforeach; ?>
			<td name="hover"><a href="<?php echo url_for('contents/index') ?>?page=<?php echo $pager->getNextPage(); ?>">Next ></a></td>
			<td name="hover"><a href="<?php echo url_for('contents/index') ?>?page=<?php echo $pager->getLastPage(); ?>">Last</a></td>
			<td class="none"><?php echo 'page: ' . $pager->getPage() . '/' . $pager->getLastPage() ?></td>
		</tr>
	</tbody>
</table>

<table>
	<tbody><tr><td>
<?php echo form_tag('contents/movepage', array('class' => 'pageform')) ?>
	<?php echo input_tag('move') ?>
	<?php echo submit_tag('ページ移動') ?>
	<?php echo input_hidden_tag('pagenate' , $pager->getLastPage()) ?>
	<?php echo input_hidden_tag('nowpage' , $pager->getPage()) ?>
</form></td>

<td><?php echo form_tag('contents/idmove' , array('class' => 'pageform')) ?>
	<?php echo input_tag('idmove') ?>
	<?php echo submit_tag('id移動') ?>
	<?php echo input_hidden_tag('nowpage' , $pager->getPage()) ?>
</form></td></tr>
</tbody>
</table>

<?php endif; ?>

<table cellpadding="10" cellspacing="0" id="index">
  <thead>
    <tr>
      <th>Id</th>
      <th>メッセージ</th>
      <th>機種機番</th>
      <th>発信日</th>
      <th>発信部所</th>
      <th>ユーザー名</th>
      <th>内容</th>
      <th>管理表No.</th>
      <th>更新日</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>Id</th>
      <th>メッセージ</th>
      <th>機種機番</th>
      <th>発信日</th>
      <th>発信部所</th>
      <th>ユーザー名</th>
      <th>内容</th>
      <th>管理表No.</th>
      <th>更新日</th>
    </tr>
  </tfoot>
  <tbody>
    <?php foreach ($pager->getResults() as $k => $hin): ?>
    <?php if($k%2 == 1): ?>
	<tr class="even">
      <td class="center"><a href="<?php echo url_for('contents/show?id='.$hin->getId()) ?>"><?php echo $hin->getId() ?></a></td>
      <td><a href="<?php echo url_for('contents/show?id='.$hin->getId()) ?>"><?php echo $hin->message ?></a></td>
      <td><a href="<?php echo url_for('contents/show?id='.$hin->getId()) ?>"><?php echo $hin->modelnumber ?></a></td>
      <td><a href="<?php echo url_for('contents/show?id=' . $hin->id) ?>"><?php echo preg_replace('/-/' , '/' , $hin->dispatchday) ?></a></td>
      <td><a href="<?php echo url_for('contents/show?id='.$hin->getId()) ?>"><?php echo $author[$hin->getAuthorId()] ?></a></td>
      <td><a href="<?php echo url_for('contents/show?id='.$hin->getId()) ?>"><?php echo $hin->getUser() ?></a></td>
      <td><a href="<?php echo url_for('contents/show?id='.$hin->getId()) ?>"><?php echo $hin->getContents() ?></a></td>
      <td><a href="<?php echo url_for('contents/show?id='.$hin->getId()) ?>"><?php echo $hin->getManagement() ?></a></td>
      <td><a href="<?php echo url_for('contents/show?id='.$hin->getId()) ?>"><?php echo substr( $hin->getUpdatedAt() , 0 , 16) ?></a></td>
    </tr>
	<?php else: ?>
	<tr class="odd">
      <td class="center"><a href="<?php echo url_for('contents/show?id='.$hin->getId()) ?>"><?php echo $hin->getId() ?></a></td>
      <td><a href="<?php echo url_for('contents/show?id='.$hin->getId()) ?>"><?php echo $hin->message ?></a></td>
      <td><a href="<?php echo url_for('contents/show?id='.$hin->getId()) ?>"><?php echo $hin->modelnumber ?></a></td>
      <td><a href="<?php echo url_for('contents/show?id=' . $hin->id) ?>"><?php echo preg_replace('/-/' , '/' , $hin->dispatchday) ?></a></td>
      <td><a href="<?php echo url_for('contents/show?id='.$hin->getId()) ?>"><?php echo $author[$hin->getAuthorId()] ?></a></td>
      <td><a href="<?php echo url_for('contents/show?id='.$hin->getId()) ?>"><?php echo $hin->getUser() ?></a></td>
      <td><a href="<?php echo url_for('contents/show?id='.$hin->getId()) ?>"><?php echo $hin->getContents() ?></a></td>
      <td><a href="<?php echo url_for('contents/show?id='.$hin->getId()) ?>"><?php echo $hin->getManagement() ?></a></td>
      <td><a href="<?php echo url_for('contents/show?id='.$hin->getId()) ?>"><?php echo substr( $hin->getUpdatedAt() , 0 , 16) ?></a></td>
    </tr>
	<?php endif; ?>
    <?php endforeach; ?>
  </tbody>
</table>

<?php if($pager->haveToPaginate()): ?>
<table class="pager" cellspacing="5">
	<tbody>
		<tr>
			<td name="hover"><a href="<?php echo url_for('contents/index') ?>?page=1">First</a></td>
			<td name="hover"><a href="<?php echo url_for('contents/index') ?>?page=<?php echo $pager->getPreviousPage(); ?>">< Prev</a></td>
<?php foreach ($pager->getLinks() as $page): ?>
<?php if ($page == $pager->getPage()): ?>
			<td class="nowpage"><?php echo $page ?></td>
<?php else: ?>
			<td name="hover"><a href="<?php echo url_for('contents/index') ?>?page=<?php echo $page ?>"><?php echo $page ?></a></td>
<?php endif; ?>
<?php endforeach; ?>
			<td name="hover"><a href="<?php echo url_for('contents/index') ?>?page=<?php echo $pager->getNextPage(); ?>">Next ></a></td>
			<td name="hover"><a href="<?php echo url_for('contents/index') ?>?page=<?php echo $pager->getLastPage(); ?>">Last</a></td>
			<td class="none"><?php echo 'page: ' . $pager->getPage() . '/' . $pager->getLastPage() ?></td>
		</tr>
	</tbody>
</table>
<?php endif; ?>

<?php echo form_tag('contents/xmlall' , array('id' => 'xml')) ?>
<?php echo submit_tag('XML全書き出し' , array('confirm' => 'XMLをすべて書き出しますか?')) ?>
</form>