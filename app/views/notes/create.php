<?php require 'app/views/templates/header.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Create New Reminder</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="/notes/create">
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject *</label>
                            <input type="text" class="form-control" id="subject" name="subject" required 
                                   value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content (Optional)</label>
                            <textarea class="form-control" id="content" name="content" rows="4"><?php echo isset($_POST['content']) ? htmlspecialchars($_POST['content']) : ''; ?></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="/notes" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Reminder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'app/views/templates/footer.php'; ?> 