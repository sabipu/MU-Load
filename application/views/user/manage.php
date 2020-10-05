<?php 
function random_color_part() {
  return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
  return random_color_part() . random_color_part() . random_color_part();
}
?>
<div class="general__holder">
  <header class="heading__wrapper">
    <a href="/register" class="button">Add new staff</a>
    <h1>Manage Staff</h1>
    <p>Manage staff member and change hour allocations.</p>
  </header>
  <?php if(count($users) === 0): ?>
    <div class="no-data">
      <h3>Sorry, no users added.</h3>
      <p><a href="<?= site_url('register') ?>">Click here</a> to add user.</p>
    </div>
  <?php else: ?>
    <table class="data__table">
      <thead>
        <tr>
          <th>&nbsp;</th>
          <th>Name</th>
          <th>Email address</th>
          <th>Status</th>
          <th>Teaching hrs</th>
          <th>Remaining hrs</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($users as $user) : ?>
          <?php if($user->role != 'admin'): ?>
              <tr class="data_holder" data-userid="<?= $user->user_id ?>">
                <td>
                  <div class="user_profile" style="background-color: #<?= random_color(); ?>"><?= $user->first_name[0] ?><?= $user->last_name[0] ?></div>
                </td>
                <td>
                  <div class="editable__block">
                    <input class="user_name" type="text" value="<?= $user->name ?>">
                  </div>
                </td>
                <td>
                  <div class="editable__block">
                    <input class="user_email" type="text" value="<?= $user->email ?>">
                  </div>
                </td>
                <td>
                  <?php $stat = ($user->status === 'active') ? '' : 'checked'; ?>
                  <div class="user_status" data-userid="<?= $user->user_id ?>" data-status="<?= $user->status ?>" data-url="<?= site_url('user/updateStatus') ?>">
                    <label class="custom-status">
                      <input type="checkbox" <?= $stat ?>>
                      <span class="custom-statusbox"></span>
                      <span class="custom-statustext"><span class="active">Active</span><span class="deactive">Deactive</span></span>
                    </label>
                  </div>
                </td>
                <td>
                  <div class="editable__block">
                    <input class="teaching_hour" type="text" value="<?= $user->allocated_hour ?>">
                  </div>
                </td>
                <td>
                  <div class="user_name"><?= $user->remaining_hour ?></div>
                </td>
                <td>
                  <a href="#" class="button button-small button-nobg update-obj" data-type="user" data-url="<?= site_url('user/updateUser') ?>" data-object="<?= $user->user_id ?>">Update</a>
                  <a href="#" class="button button-small button-nobg edit-obj">Edit user</a>
                  <a href="#" class="button button-small delete-obj" data-type="user" data-url="<?= site_url('user/deleteUser') ?>" data-object="<?= $user->user_id ?>">Delete user</a>
                  <a href="#" class="button button-small cancel-obj">Cancel</a>
                </td>
              </tr>
            <?php endif; ?>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
