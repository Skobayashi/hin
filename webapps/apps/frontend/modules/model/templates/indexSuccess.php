<h1>Model List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($model_list as $model): ?>
    <tr>
      <td><a href="<?php echo url_for('model/edit?id='.$model->getId()) ?>"><?php echo $model->getId() ?></a></td>
      <td><?php echo $model->getName() ?></td>
      <td><?php echo $model->getCreatedAt() ?></td>
      <td><?php echo $model->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('model/new') ?>">New</a>
