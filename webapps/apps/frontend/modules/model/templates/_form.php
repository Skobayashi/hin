<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>
<?php use_helper('Form') ?>
<?php $model_list = ModelTable::getName(); ?>

<form class="form" action="<?php echo url_for('model/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellpadding="5" cellspacing="0" id="form">
    <tfoot>
      <tr>
        <td colspan="2">
       	<input type="submit" value="保存" />
          <?php echo $form->renderHiddenFields() ?>
          &nbsp;<a href="<?php echo url_for('contents/new') ?>">キャンセル</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('削除', 'model/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => '削除してもよろしいですか?')) ?>
          <?php endif; ?>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo label_for('model_name' , '機種名') ?></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>

<p>現在の機種リスト</p>
<div class="now">
<table>
	<tbody>
		<?php foreach($model_list as $v): ?>
		<tr>
		<td><?php echo $v ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</div>