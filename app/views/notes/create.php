<?php require APPROOT.'/views/templates/header.php'; ?>

<h1>Create Reminder</h1>

<?php if(!empty($_SESSION['error'])): ?>
  <div class="alert alert-danger">
    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
  </div>
<?php endif; ?>

<form action="/notes/create" method="post">
  <div>
    <label for="subject">Subject</label><br>
    <input type="text" id="subject" name="subject" required>
  </div>
  <div>
    <label for="content">Details</label><br>
    <textarea id="content" name="content"></textarea>
  </div>
  <button type="submit">Create</button>
  <a href="/notes">Cancel</a>
</form>

<?php require APPROOT.'/views/templates/footer.php'; ?>
