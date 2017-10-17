
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
        <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect"
          href="<?=base_url('item/update/' . $item->item_slug)?>">Update</a>
        
        <a class="js-delete mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--red-500 mdl-color-text--white"
          data-slug="<?=base_url('item/delete/' . $item->item_slug)?>">Delete</a>
      </td>
    </tr>

    <?php endforeach; ?>


  </table>

  <?php endif; ?>

  <br>

  <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--indigo-500 mdl-color-text--white"
    href="<?=base_url('item/logout')?>"><i class="material-icons">exit_to_app</i> Logout</a>

</div>

<!-- fab -->
<div class="add-fab">

  <a href="<?=base_url('item/create')?>" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
    <i class="material-icons fab">add</i>
  </a>

</div>

<script>
$('.js-delete').click(function() {
  var slug = $(this).attr('data-slug')
  swal({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#e91e63',
    cancelButtonColor: '#3f51b5',
    confirmButtonText: 'Yes, delete it!'
  }).then(function() {
    /* swal(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    ) */
    window.location.replace(slug)
  })

})
</script>