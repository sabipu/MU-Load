<div class="login">
  <h1>Setup new Password</h1>
  <form method="post" action="/recover/<?= $user_id ?>/<?= $recovery_hash ?>">
    <input type="password" name="password" placeholder="Password">
    <input type="password" name="re-password" placeholder="Password">
    <input type="submit" value="Submit">
  </form>
</div>
