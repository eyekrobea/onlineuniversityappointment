<?php /** @noinspection PhpIllegalPsrClassPathInspection */

namespace SannyTech;

use SannyTech\Exceptions\DatabaseException;
use SannyTech\Helper as help;
use Exception;
use PDO;
use PDOException;

class Database
{
    protected string $host;
    protected string $user;
    protected string $pass;
    protected string $name;
    protected int $port;
    protected string $charset;
    protected mixed $error;
    protected mixed $db;
    protected mixed $stmt;
    protected mixed $dsn;
    protected array $options = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_EMULATE_PREPARES => false
    );

    /**
     * Database constructor.
     * @param $dbHost
     * @param $dbName
     * @param $dbUser
     * @param $dbPass
     * @param int $dbPort
     * @param string $dbCharset
     * @throws DatabaseException
     */
    public function __construct(
        $dbHost, $dbName, $dbUser, $dbPass, int $dbPort = 3306, string $dbCharset = 'utf8mb4'
    ) {
        $help = new help();
        $this->host    = $help::env('DB_HOST');
        $this->name    = $help::env('DB_NAME');
        $this->user    = $help::env('DB_USER');
        $this->pass    = $help::env('DB_PASS');
        $this->port    = $help::env('DB_PORT');
        $this->charset = $help::env('DB_CHARSET');

        switch($help::env('DB_MODEL')) {
            case 'sqlite':
                $this->dsn = 'sqlite:' . $help::env('SQLITE_DB_DIR');
                $this->connectSqlite();
                break;
            case 'mysql':
            case 'sql':
                $this->dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->name;charset=$this->charset";
                $this->connectMysql();
                break;
            default:
                throw new DatabaseException('Database model not supported');
        }

    }

    /**
     * @return void
     * @throws DatabaseException
     */
    public function connectSqlite(): void
    {
        try {
            $this->db = new PDO($this->dsn, null, null, $this->options);
            #echo 'Connected to SQLite database';
        } catch (PDOException $e) {
            throw new DatabaseException('SQLite: ' . $e->getMessage());
        }
    }

    /**
     * @return void
     * @throws DatabaseException
     */
    public function connectMysql(): void
    {
        try {
            $this->db = new PDO($this->dsn, $this->user, $this->pass, $this->options);
            #echo 'Connected to MySQL';
        } catch (PDOException $e) {
            throw new DatabaseException('MySQL: ' . $e->getMessage());
        }
    }

    /**
     * Query the database
     * @param $sql
     * @return mixed
     * @throws DatabaseException
     */
    public function query($sql): mixed
    {
        $this->stmt = $this->db->prepare($sql);
        $this->confirmQuery($this->stmt);
        $this->stmt->execute();
        return $this->stmt;
    }

    /**
     * Executes a query
     * @param $sql
     */
    public function exec($sql): void
    {
        $this->db->exec($sql);
    }

    /**
     * Confirm if the query was successful
     * @param $stmt
     * @throws DatabaseException
     */
    private function confirmQuery($stmt): void
    {
        if(!$stmt) {
            $this->error = $this->db->errorInfo();
            throw new DatabaseException('Query failed: ' . $this->error[2]);
        }
    }

    /**
     * Prepare the query
     * @param $sql
     * @return mixed
     * @throws DatabaseException
     */
    public function prepare($sql): mixed
    {
        $this->stmt = $this->db->prepare($sql);
        $this->confirmQuery($this->stmt);
        return $this->stmt;
    }

    /**
     * Execute the prepared statement
     * @return mixed
     */
    public function execute(): mixed
    {
        return $this->stmt->execute();
    }

    /**
     * Get the row count
     * @return mixed
     */
    public function rowCount(): mixed
    {
        return $this->stmt->rowCount();
    }

    /**
     * Get the last inserted ID
     * @return string
     */
    public function lastInsertId(): string
    {
        return $this->db->lastInsertId();
    }

    /**
     * Begin a transaction
     * @return bool
     */
    public function beginTransaction(): bool
    {
        return $this->db->beginTransaction();
    }

    /**
     * End a transaction
     * @return bool
     */
    public function commit(): bool
    {
        return $this->db->commit();
    }

    /**
     * Cancel a transaction
     * @return bool
     */
    public function rollBack(): bool
    {
        return $this->db->rollBack();
    }

    /**
     * Escape the string
     * @param $string
     * @return string
     */
    public function escape($string): string
    {
        return $this->db->quote($string);
    }

    /**
     * Close the connection
     */
    public function close(): void
    {
        $this->db = null;
    }

    /**
     * Export the database to a SQL file
     * @param $file
     * The name of the file to export to
     * @param bool $dbTablePick
     * Pick specific tables to export
     * @param array $dbTable
     * The tables to export
     * @param bool $dbDrop
     * Whether to include the DROP DATABASE statement
     * @return bool
     * @throws DatabaseException
     */
    public function backup($file, bool $dbTablePick = false, array $dbTable = [], bool $dbDrop = false): bool
    {
        # Get all the tables
        $tables = $this->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
        if($dbTablePick) {
            $tables = array_intersect($tables, $dbTable);
        }

        # Prepare the SQL script
        $sql = '-- Database Backup --' . PHP_EOL . PHP_EOL;
        $sql .= '-- --------------------------------------------------------' . PHP_EOL . PHP_EOL;
        $sql .= '-- Host: ' . $this->host . PHP_EOL;
        $sql .= '-- Generation Time: ' . date('M j, Y \a\t g:i A') . PHP_EOL;
        $sql .= '-- Server version: ' . $this->db->getAttribute(PDO::ATTR_SERVER_VERSION) . PHP_EOL;
        $sql .= '-- PHP Version: ' . phpversion() . PHP_EOL . PHP_EOL;
        $sql .= '-- Database: `' . help::env('DB_NAME') . '`' . PHP_EOL . PHP_EOL;
        $sql .= '-- Project: ' . help::env('APP_NAME') . PHP_EOL;
        $sql .= '-- --------------------------------------------------------' . PHP_EOL . PHP_EOL;
        #$sql .= '/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;' . PHP_EOL;
        #$sql .= '/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;' . PHP_EOL;
        #$sql .= "/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;" . PHP_EOL . PHP_EOL;
        #$sql .= '-- --------------------------------------------------------' . PHP_EOL . PHP_EOL;

        # If we want to include the DROP DATABASE statement
        if($dbDrop) {
            $sql .= '--' . PHP_EOL;
            $sql .= '-- Drop the database' . PHP_EOL;
            $sql .= '--' . PHP_EOL . PHP_EOL;
            $sql .= 'DROP DATABASE IF EXISTS `' . help::env('DB_NAME') . '`;' . PHP_EOL . PHP_EOL;
            $sql .= 'CREATE DATABASE IF NOT EXISTS `' . help::env('DB_NAME') . '`;' . PHP_EOL . PHP_EOL;
            $sql .= 'USE `' . help::env('DB_NAME') . '`;' . PHP_EOL . PHP_EOL;
            $sql .= '-- --------------------------------------------------------' . PHP_EOL . PHP_EOL;
        }

        # Cycle through each table
        foreach($tables as $table) {
            $sql .= 'DROP TABLE IF EXISTS ' . $table . ';';

            # Select the tables based on the table names

            # Get the table structure
            $create = $this->query('SHOW CREATE TABLE ' . $table)->fetch(PDO::FETCH_ASSOC);
            # Add the table structure to the SQL script
            $sql .= "\n\n" . $create['Create Table'] . ";\n\n";

            # Get the table data
            $data = $this->query('SELECT * FROM ' . $table)->fetchAll(PDO::FETCH_ASSOC);
            # Cycle through each row
            foreach($data as $row) {
                # Prepare the SQL statement
                $sql .= 'INSERT INTO ' . $table . ' VALUES (';
                # Cycle through each field
                foreach($row as $value) {
                    # Add the field value to the SQL statement
                    $value = addslashes($value);
                    # Escape any apostrophes
                    $value = str_replace("\n", "\\n", $value);
                    if(!isset($value)) {
                        $sql .= "''";
                    } else {
                        $sql .= "'" . $value . "'";
                    }
                    $sql .= ',';
                }
                # Remove the last comma
                $sql = substr($sql, 0, -1);
                $sql .= ");\n";
            }
            # Add a new line
            $sql .= "\n\n";
            $sql .= '-- --------------------------------------------------------' . PHP_EOL;
            $sql .= '-- End of data for table `' . $table . '`' . PHP_EOL;
            $sql .= '-- --------------------------------------------------------' . PHP_EOL . PHP_EOL;

        }
        #$sql .= '/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;' . PHP_EOL;
        #$sql .= '/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;' . PHP_EOL;
        #$sql .= '/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;' . PHP_EOL;
        # Save the SQL script to a backup file
        try {
            if(!file_put_contents('../'.help::env('DB_BACKUP_DIR').'/'.$file.'.sql', $sql)) {
                throw new Exception('Could not save the SQL file.');
            }
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * Import a SQL file
     * @param $file
     * The file to import
     * @return bool
     * @throws Exception
     */
    public function restore($file): bool
    {

        if(!file_exists($file)) {
            throw new Exception("File does not exist");
        } else {
            $sql = file_get_contents($file);
            $content = explode(';', $sql);
            foreach($content as $query) {
                $query = trim($query);
                if(!empty($query)) {
                    try {
                        # Disable foreign key checks
                        $this->db->prepare("SET FOREIGN_KEY_CHECKS = 0")->execute();
                        $this->db->prepare("SET UNIQUE_CHECKS = 0")->execute();
                        $this->db->prepare("SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO'")->execute();
                        $this->db->prepare($query)->execute();
                    } catch (PDOException $e) {
                        $this->error = $e->getMessage();
                        return false;
                    }
                }
            }
        }
        return true;
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        $this->close();
    }


}