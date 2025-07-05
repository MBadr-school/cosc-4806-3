<?php require APPROOT.'/views/templates/header.php'; ?>

<h1>Create Reminder</h1>

<?php if(!empty($_SESSION['error'])): ?>
  <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<form method="POST" action="/notes/create">
  <div class="mb-3">
    <label class="form-label">Subject *</label>
    <input type="text" name="subject" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Details</label>
    <textarea name="content" class="form-control" rows="4"></textarea>
  </div>
  <button class="btn btn-success">Create</button>
  <a href="/notes" class="btn btn-secondary">Cancel</a>
</form>

<?php require APPROOT.'/views/templates/footer.php'; ?>
