<?php require 'app/views/templates/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>My Reminders</h1>
                <a href="/notes/create" class="btn btn-primary">Create New Reminder</a>
            </div>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>

            <?php if (empty($notes)): ?>
                <div class="alert alert-info">No reminders yet. <a href="/notes/create">Create your first one!</a></div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($notes as $note): ?>
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card <?php echo $note['completed'] ? 'border-success' : ''; ?>">
                                <div class="card-body">
                                    <h5 class="card-title <?php echo $note['completed'] ? 'text-decoration-line-through' : ''; ?>">
                                        <?php echo htmlspecialchars($note['subject']); ?>
                                    </h5>
                                    <?php if (!empty($note['content'])): ?>
                                        <p class="card-text"><?php echo htmlspecialchars($note['content']); ?></p>
                                    <?php endif; ?>
                                    <small class="text-muted">Created: <?php echo date('M j, Y', strtotime($note['created_at'])); ?></small>
                                </div>
                                <div class="card-footer">
                                    <div class="btn-group w-100" role="group">
                                        <a href="/notes/edit/<?php echo $note['id']; ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <a href="/notes/toggle/<?php echo $note['id']; ?>" class="btn btn-sm btn-outline-<?php echo $note['completed'] ? 'warning' : 'success'; ?>">
                                            <?php echo $note['completed'] ? 'Undo' : 'Complete'; ?>
                                        </a>
                                        <a href="/notes/delete/<?php echo $note['id']; ?>" class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Are you sure you want to delete this reminder?')">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require 'app/views/templates/footer.php'; ?> 