<h1>Test List</h1>
<?php $list = $sf_data->getRaw('list') ?> 

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Author</th>
      <th>Dispatchday</th>
      <th>Modelnumber</th>
      <th>Hourmeter</th>
      <th>Delivery</th>
      <th>User</th>
      <th>Outbreak</th>
      <th>Attachment</th>
      <th>Message</th>
      <th>Contents</th>
      <th>Management</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($list as $hin): ?>
    <tr>
      <td><a href="<?php //echo url_for('test/edit?id='.$hin->getId()) ?>"><?php //echo $hin->getId() ?></a></td>
      <td><?php echo $hin['id'] ?></td>
      <td><?php echo $hin['author_id'] ?></td>
      <td><?php echo $hin['dispatchday'] ?></td>
      <td><?php echo $hin['modelnumber'] ?></td>
      <td><?php echo $hin['user'] ?></td>
      <td><?php echo $hin['created_at'] ?></td>
      <td><?php echo $hin['updated_at'] ?></td>
      <td><?php //echo $hin->getAttachment() ?></td>
      <td><?php //echo $hin->getMessage() ?></td>
      <td><?php //echo $hin->getContents() ?></td>
      <td><?php //echo $hin->getManagement() ?></td>
      <td><?php //echo $hin->getCreatedAt() ?></td>
      <td><?php //echo $hin->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('test/new') ?>">New</a>
