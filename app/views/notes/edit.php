<?php require 'app/views/templates/header.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Reminder</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="/notes/edit/<?php echo $note['id']; ?>">
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject *</label>
                            <input type="text" class="form-control" id="subject" name="subject" required 
                                   value="<?php echo htmlspecialchars($note['subject']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content (Optional)</label>
                            <textarea class="form-control" id="content" name="content" rows="4"><?php echo htmlspecialchars($note['content']); ?></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="/notes" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Reminder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'app/views/templates/footer.php'; ?>