<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<form action="<?php echo url_for('test/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields() ?>
          &nbsp;<a href="<?php echo url_for('test/index') ?>">Cancel</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'test/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['author_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['author_id']->renderError() ?>
          <?php echo $form['author_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['dispatchday']->renderLabel() ?></th>
        <td>
          <?php echo $form['dispatchday']->renderError() ?>
          <?php echo $form['dispatchday'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['modelnumber']->renderLabel() ?></th>
        <td>
          <?php echo $form['modelnumber']->renderError() ?>
          <?php echo $form['modelnumber'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['hourmeter']->renderLabel() ?></th>
        <td>
          <?php echo $form['hourmeter']->renderError() ?>
          <?php echo $form['hourmeter'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['delivery']->renderLabel() ?></th>
        <td>
          <?php echo $form['delivery']->renderError() ?>
          <?php echo $form['delivery'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['user']->renderLabel() ?></th>
        <td>
          <?php echo $form['user']->renderError() ?>
          <?php echo $form['user'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['outbreak']->renderLabel() ?></th>
        <td>
          <?php echo $form['outbreak']->renderError() ?>
          <?php echo $form['outbreak'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['attachment']->renderLabel() ?></th>
        <td>
          <?php echo $form['attachment']->renderError() ?>
          <?php echo $form['attachment'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['message']->renderLabel() ?></th>
        <td>
          <?php echo $form['message']->renderError() ?>
          <?php echo $form['message'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['contents']->renderLabel() ?></th>
        <td>
          <?php echo $form['contents']->renderError() ?>
          <?php echo $form['contents'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['management']->renderLabel() ?></th>
        <td>
          <?php echo $form['management']->renderError() ?>
          <?php echo $form['management'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['created_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['created_at']->renderError() ?>
          <?php echo $form['created_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['updated_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['updated_at']->renderError() ?>
          <?php echo $form['updated_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['models_list']->renderLabel() ?></th>
        <td>
          <?php echo $form['models_list']->renderError() ?>
          <?php echo $form['models_list'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
