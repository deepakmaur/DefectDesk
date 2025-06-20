<?php
require 'config.php'; // Ensure $pdo is set up

function sendMailCompat($to, $subject, $message, $headers) {
    return mail($to, $subject, $message, $headers);
}

function sendBugNotification($title, $description, $submitted_by) {
    global $pdo;

    try {
        // 1. Get the reporter's email
        $reporterStmt = $pdo->prepare("SELECT email FROM users WHERE username = ?");
        $reporterStmt->execute([$submitted_by]);
        $reporterEmail = $reporterStmt->fetchColumn();

        if (!$reporterEmail) {
            echo "❌ Reporter email not found for $submitted_by";
            return;
        }

        // 2. Get all editors' emails
        $editorStmt = $pdo->prepare("SELECT email FROM users WHERE role = 'editor'");
        $editorStmt->execute();
        $editorEmails = $editorStmt->fetchAll(PDO::FETCH_COLUMN);

        if (empty($editorEmails)) {
            echo "⚠️ No editor emails found.";
            return;
        }

        // 3. Prepare email content
        $subject = "🐞 Bug Report from $submitted_by";
        $message = "<html><body>
            <h2>New Bug Submitted</h2>
            <p><strong>Title:</strong> " . htmlspecialchars($title) . "</p>
            <p><strong>Description:</strong><br>" . nl2br(htmlspecialchars($description)) . "</p>
            <p><strong>Reported by:</strong> $submitted_by ($reporterEmail)</p>
            <hr>
            <p>Check it on the BugTrackr dashboard.</p>
        </body></html>";

        // 4. Send to each editor
        foreach ($editorEmails as $editorEmail) {
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8\r\n";
            $headers .= "From: BugTrackr <thums9up@gmail.com>\r\n";
            $headers .= "Reply-To: $reporterEmail\r\n";

            if (sendMailCompat($editorEmail, $subject, $message, $headers)) {
                echo "✅ Mail sent to: $editorEmail<br>";
            } else {
                echo "❌ Failed to send mail to: $editorEmail<br>";
            }
        }

    } catch (PDOException $e) {
        echo "❌ PDO Exception: " . $e->getMessage();
    }
}
