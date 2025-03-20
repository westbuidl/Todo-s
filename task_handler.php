<!-- task_handler.php -->
<?php
require_once('includes/dbconn.php');

// Create table with description field
$conn->query("CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ref VARCHAR(20) UNIQUE,
    task_name VARCHAR(255),
    description TEXT,
    date_added DATE,
    status ENUM('waiting', 'done') DEFAULT 'waiting'
)");

$action = $_POST['action'] ?? '';

switch ($action) {
    case 'add':
        $stmt = $conn->prepare("INSERT INTO tasks (ref, task_name, description, date_added) VALUES (?, ?, ?, CURDATE())");
        $stmt->bind_param("sss", $_POST['ref'], $_POST['task_name'], $_POST['description']);
        $stmt->execute();
        break;

    case 'mark_done':
        $stmt = $conn->prepare("UPDATE tasks SET status = 'done' WHERE ref = ?");
        $stmt->bind_param("s", $_POST['ref']);
        $stmt->execute();
        break;

    case 'remove':
        $stmt = $conn->prepare("DELETE FROM tasks WHERE ref = ?");
        $stmt->bind_param("s", $_POST['ref']);
        $stmt->execute();
        break;

    case 'load':
        $result = $conn->query("SELECT * FROM tasks ORDER BY id DESC");
        $output = '';
        $counter = 1;
        while ($row = $result->fetch_assoc()) {
            $output .= "
                <tr style='border-bottom: 1px solid #ddd;'>
                    <td style='padding: 12px 15px;'>{$counter}</td>
                    <td style='padding: 12px 15px;'>{$row['ref']}</td>
                    <td style='padding: 12px 15px;'><span class='task-name' data-ref='{$row['ref']}'>{$row['task_name']}</span></td>
                    <td style='padding: 12px 15px;'>{$row['date_added']}</td>
                    <td style='padding: 12px 15px;'>{$row['status']}</td>
                    <td style='padding: 12px 15px;'>
                        <a href='#' class='mark-done' data-ref='{$row['ref']}' style='background-color: #06bd68; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; font-weight: 500; " . ($row['status'] == 'done' ? 'display: none;' : '') . "'>Mark as done</a>
                        <a href='#' class='remove-task' data-ref='{$row['ref']}' style='background-color: #e23023; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; font-weight: 500; margin-left: 5px;'>Remove task</a>
                    </td>
                </tr>";
            $counter++;
        }
        echo $output;
        break;

    case 'get_details':
        $stmt = $conn->prepare("SELECT * FROM tasks WHERE ref = ?");
        $stmt->bind_param("s", $_POST['ref']);
        $stmt->execute();
        $result = $stmt->get_result();
        $task = $result->fetch_assoc();
        if ($task) {
            echo "
                <p><strong>Name:</strong> {$task['task_name']}</p>
                <p><strong>Reference:</strong> {$task['ref']}</p>
                <p><strong>Date Added:</strong> {$task['date_added']}</p>
                <p><strong>Status:</strong> {$task['status']}</p>
                <p><strong>Description:</strong> " . (empty($task['description']) ? 'No description' : nl2br(htmlspecialchars($task['description']))) . "</p>
            ";
        }
        break;
}

$conn->close();
?>