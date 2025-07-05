<?php require APPROOT.'/views/templates/header.php'; ?>

<h1>Edit Reminder</h1>

<?php if(!empty($_SESSION['error'])): ?>
  <div class="alert alert-danger">
    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
  </div>
<?php endif; ?>

<form action="/notes/edit/<?= $data['note']['id']; ?>" method="post">
  <div>
    <label for="subject">Subject</label><br>
    <input
      type="text"
      id="subject"
      name="subject"
      value="<?= htmlspecialchars($data['note']['subject']); ?>"
      required>
  </div>
  <div>
    <label for="content">Details</label><br>
    <textarea id="content" name="content"><?= htmlspecialchars($data['note']['content']); ?></textarea>
  </div>
  <button type="submit">Save</button>
  <a href="/notes">Cancel</a>
</form>

<?php require APPROOT.'/views/templates/footer.php'; ?>
