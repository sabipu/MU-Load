<h2><?= $title; ?></h2>

<?php foreach($news as $news_item): ?>
  <h3><?= $news_item['title']; ?>
  <?= $news_item['text']; ?>
  <p><a href="<?= '/news/'.$news_item['slug'] ?>">View article</a></p>
<?php endforeach; ?>
