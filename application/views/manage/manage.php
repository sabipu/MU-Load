<h1>I am manage</h1>
<a href="<?php echo base_url('register'); ?>">Add new</a>
<table>
  <thead>
    <tr>
      <th>&nbsp;</th>
      <th>Name</th>
      <th>Hours</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($users as $user) : ?>
      <tr data-userid="<?= $user->user_id ?>">
        <td>
          <div class="user_profile"><?= $user->first_name[0] ?><?= $user->last_name[0] ?></div>
        </td>
        <td>
          <?= $user->name ?>
        </td>
        <td>
          <input type="number" placeholder="Hours allocation every year"> / year
          <button>Update</button>
        </td>
        <td>
          <button>Pause</button>
          <button>Delete</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
