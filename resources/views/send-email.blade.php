<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Send an Email</h2>

    <div class="card shadow-sm p-4">
        <form>
            <div class="mb-3">
                <label class="form-label">From</label>
                <select class="form-control">
                    <option>info@yourdomain.com</option>
                    <option>support@yourdomain.com</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">To</label>
                <input type="email" class="form-control" placeholder="recipient@example.com">
            </div>

            <div class="mb-3">
                <label class="form-label">Subject</label>
                <input type="text" class="form-control" placeholder="Enter subject">
            </div>

            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea class="form-control" rows="5" placeholder="Type your message here"></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">Send Email</button>
        </form>
    </div>
</div>

</body>
</html>
