<?php
require_once('databaseService.php');

$service = new ServiceClass();
$service->process();

class ServiceClass
{
    private $conn;
    private $dbname = 'sam_db';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->dbConnection();
    }

    public function process()
    {
        try {
            $backupDir = '../../database_backup/';
            if (!is_dir($backupDir)) {
                mkdir($backupDir, 0777, true); // Create directory if it doesn't exist
            }

            $backupFileName = $this->dbname . '_' . date("Y-m-d_H-i-s") . '.sql';
            $backupFilePath = $backupDir . $backupFileName;

            $handle = fopen($backupFilePath, 'w');

            // Get all tables
            $tables = [];
            $stmt = $this->conn->query("SHOW TABLES");
            while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                $tables[] = $row[0];
            }

            foreach ($tables as $table) {
                // Get CREATE TABLE statement
                $createStmt = $this->conn->query("SHOW CREATE TABLE `$table`");
                $createRow = $createStmt->fetch(PDO::FETCH_ASSOC);
                fwrite($handle, "\n\n" . $createRow['Create Table'] . ";\n\n");

                // Export table data
                $rows = $this->conn->query("SELECT * FROM `$table`");
                while ($row = $rows->fetch(PDO::FETCH_ASSOC)) {
                    $columns = array_map(fn($v) => "`$v`", array_keys($row));
                    $values = array_map([$this->conn, 'quote'], array_values($row));
                    $insert = "INSERT INTO `$table` (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $values) . ");\n";
                    fwrite($handle, $insert);
                }
            }

            fclose($handle);

            echo '✅ Backup successful: <br> <a  class="btn btn-primary" href="' . $backupFilePath . '" download>Download</a>';

        } catch (Exception $e) {
            echo "❌ Backup failed: " . $e->getMessage();
        }
    }
}
?>