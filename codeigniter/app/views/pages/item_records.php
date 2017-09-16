
<div class="container">

  <h1><?=$title?></h1>

  <?php if (!$items): ?>

  <div>
    <p>No items found.</p>
  </div>

  <?php else: ?>
  <?php date_default_timezone_set('Asia/Hong_Kong'); ?>

  <table class="table mdl-shadow--4dp mdl-data-table w-max">

    <tr>
      <th>Item ID</th>
      <th>Item Name</th>
      <th>Item Description</th>
      <th>Item Price</th>
      <th>Added at</th>
      <th>Last updated at</th>
      <th>Actions</th>
    </tr>

    <?php foreach ($items as $item): ?>

    <tr>
      <td><?=$item->item_id?></td>
      <td><?=$item->item_name?></td>
      <td><?=$item->item_desc?></td>
      <td><?=$item->item_price?></td>
      <td><?=date('M d Y H:i:s', $item->item_added_at)?></td>
      <td><?=date('M d Y H:i:s', $item->item_updated_at)?></td>
      <td>
        <a href="update/<?=$item->item_id?>" class="btn btn-default">Update</a>
        <a href="delete/<?=$item->item_id?>" class="btn btn-danger">Delete</a>
      </td>
    </tr>

    <?php endforeach; ?>


  </table>

  <?php endif; ?>

</div>

<!-- fab -->
<div class="add-fab">

  <a href="<?=base_url('item/create')?>" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
    <i class="material-icons fab">add</i>
  </a>

</div>
