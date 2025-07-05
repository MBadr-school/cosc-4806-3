<?php require APPROOT.'/views/templates/header.php'; ?>

<h1>My Reminders</h1>

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

<p><a href="/notes/create">+ New Reminder</a></p>

<?php if(count($data['notes'])): ?>
  <table>
    <thead>
      <tr>
        <th>Subject</th>
        <th>Created</th>
        <th>Done?</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($data['notes'] as $n): ?>
        <tr>
          <td><?= htmlspecialchars($n['subject']); ?></td>
          <td><?= $n['created_at']; ?></td>
          <td><?= $n['completed'] ? '✔' : '––'; ?></td>
          <td>
            <a href="/notes/edit/<?= $n['id']; ?>">Edit</a> |
            <a href="/notes/toggle/<?= $n['id']; ?>">
              <?= $n['completed'] ? 'Uncomplete' : 'Complete'; ?>
            </a> |
            <a href="/notes/delete/<?= $n['id']; ?>" onclick="return confirm('Delete?');">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>No reminders yet.</p>
<?php endif; ?>

<?php require APPROOT.'/views/templates/footer.php'; ?>
