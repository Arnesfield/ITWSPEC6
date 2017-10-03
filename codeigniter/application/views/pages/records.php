
<div class="container">

  <h1><?=$title?></h1>

  <?php if (!$activities): ?>

  <div>
    <p>No activities found.</p>
  </div>

  <?php else: ?>
  <?php date_default_timezone_set('Asia/Hong_Kong'); ?>

  <table class="table mdl-shadow--4dp mdl-data-table w-max">

    <tr>
      <th>Acitivity Name</th>
      <th>Date</th>
      <th>Time</th>
      <th>Actions</th>
    </tr>

    <?php foreach ($activities as $activity): ?>

    <tr>
      <td><?=$activity->name?></td>
      <td><?=date('M d Y', $item->date)?></td>
      <td><?=date('H:i', $item->time)?></td>
      <td>
        <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect"
          href="<?=base_url('activity/update/' . $activity->id)?>">Update</a>
        
        <a class="js-delete mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--red-500 mdl-color-text--white"
          data-slug="<?=base_url('item/delete/' . $activity->id)?>">Delete</a>
      </td>
    </tr>

    <?php endforeach; ?>


  </table>

  <?php endif; ?>

</div>

<!-- fab -->
<div class="add-fab">

  <a href="<?=base_url('activity/create')?>" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
    <i class="material-icons fab">add</i>
  </a>

</div>

<script>

</script>