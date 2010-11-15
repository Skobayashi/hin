<h1>Author List</h1>
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
    <?php foreach ($author_list as $author): ?>
    <tr>
      <td><a href="<?php echo url_for('author/edit?id='.$author->getId()) ?>"><?php echo $author->getId() ?></a></td>
      <td><?php echo $author->getName() ?></td>
      <td><?php echo $author->getCreatedAt() ?></td>
      <td><?php echo $author->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('author/new') ?>">New</a>
