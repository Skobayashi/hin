<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>
<?php use_helper('Form') ?>
<?php $last = HinTable::moveLast() ?>

<?php echo link_to('ラストページへ' , 'contents/index?page=' . $last) ?>
<form action="<?php echo url_for('contents/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellpadding="10" cellspacing="0" id="form">
    <tfoot>
      <tr>
        <td colspan="2">
       	<input type="submit" value="保存" />
          <?php echo $form->renderHiddenFields() ?>
          &nbsp;<a href="<?php echo url_for('contents/index?page=' . $last) ?>">キャンセル</a>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo label_for('hin_author_id' , '発信部所') ?></th>
        <td>
          <?php echo $form['author_id']->renderError() ?>
          <?php echo $form['author_id'] ?>
		  <p id="author"><?php echo link_to('発信部所追加' , 'author/new') ?></p>
        </td>
      </tr>
      <tr>
        <th><?php echo label_for('hin_dispatchday' , '発信日') ?></th>
        <td>
          <?php echo $form['dispatchday']->renderError() ?>
          <?php echo $form['dispatchday'] ?>
        </td>
      </tr>
	  <tr>
        <th><?php echo label_for('hin_models_list' , '機種') ?></th>
        <td>
          <?php echo $form['models_list']->renderError() ?>
          <?php echo $form['models_list'] ?>
		  <p id="model"><?php echo link_to('機種追加' , 'model/new') ?></p>
        </td>
      </tr>
      <tr>
        <th><?php echo label_for('hin_modelnumber' , '機番') ?></th>
        <td>
          <?php echo $form['modelnumber']->renderError() ?>
          <?php echo $form['modelnumber'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo label_for('hin_hourmeter' , 'アワメータ') ?></th>
        <td>
          <?php echo $form['hourmeter']->renderError() ?>
          <?php echo $form['hourmeter'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo label_for('hin_delivery' , '納入年月') ?></th>
        <td>
          <?php echo $form['delivery']->renderError() ?>
          <?php echo $form['delivery'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo label_for('hin_user' , 'ユーザ名') ?></th>
        <td>
          <?php echo $form['user']->renderError() ?>
          <?php echo $form['user'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo label_for('hin_outbreak' , '発生日') ?></th>
        <td>
          <?php echo $form['outbreak']->renderError() ?>
          <?php echo $form['outbreak'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo label_for('hin_attachment' , 'アタッチメント') ?></th>
        <td>
          <?php echo $form['attachment']->renderError() ?>
          <?php echo $form['attachment'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo label_for('hin_message' , 'メッセージ') ?></th>
        <td>
          <?php echo $form['message']->renderError() ?>
          <?php echo $form['message'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo label_for('hin_contents' , '内容') ?></th>
        <td>
          <?php echo $form['contents']->renderError() ?>
          <?php echo $form['contents'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo label_for('hin_management' , '管理表No.') ?></th>
        <td>
          <?php echo $form['management']->renderError() ?>
          <?php echo $form['management'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
