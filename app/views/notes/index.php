<?php require APPROOT.'/views/templates/header.php'; ?>

<h1>My Reminders</h1>
<p><a href="/notes/create" class="btn btn-primary mb-3">Create New Reminder</a></p>

<?php if(!empty($_SESSION['success'])): ?>
  <div class="alert alert-success">
    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
  </div>
<?php endif; ?>

<?php if(!empty($_SESSION['error'])): ?>
  <div class="alert alert-danger">
    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
  </div>
<?php endif; ?>

<?php if(!empty($data['notes'])): ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Subject</th>
        <th>Details</th>
        <th>Created At</th>
        <th>Completed</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($data['notes'] as $n): ?>
        <tr>
          <td><?= htmlspecialchars($n['subject']); ?></td>
          <td><?= nl2br(htmlspecialchars($n['content'])); ?></td>
          <td><?= date('Y-m-d H:i', strtotime($n['created_at'])); ?></td>
          <td><?= $n['completed'] ? 'Yes' : 'No'; ?></td>
          <td>
            <a href="/notes/edit/<?= $n['id']; ?>">Edit</a> |
            <a href="/notes/toggle/<?= $n['id']; ?>">
              <?= $n['completed'] ? 'Uncomplete' : 'Complete'; ?>
            </a> |
            <a href="/notes/delete/<?= $n['id']; ?>" onclick="return confirm('Delete this reminder?');">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>No reminders yet.</p>
<?php endif; ?>

<?php require APPROOT.'/views/templates/footer.php'; ?>
