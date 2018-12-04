<?php

namespace DrupalProject\custom;

class DatabaseExport {
  public function exportCurrent() {
    $connection = \Drupal::service('database');
    $details = $connection->getConnectionOptions();

    $this->export(
      $details['host'],
      $details['username'],
      $details['password'],
      $details['database']
    );
  }

  public function export($host, $user, $pass, $name, $tables = false, $backupName = false) {
    $content = NULL;
    $content .= $this->preExport($name);

    $tables = $this->getTables($host, $user, $pass, $name, $tables);

    foreach ($tables as $table) {
      $content .= $this->processTable($table, $host, $user, $pass, $name);
    }

    $content .= $this->postExport();

    $this->download($backupName, $name, $content);
  }

  public function preExport($name) {
    $content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `" . $name . "`\r\n--\r\n\r\n\r\n";

    return $content;
  }

  public function getTables($host, $user, $pass, $name, $tables = false) {
    $mysqli = new \mysqli($host, $user, $pass, $name);

    $mysqli->select_db($name);
    $mysqli->query("SET NAMES 'utf8'");
    $queryTables = $mysqli->query('SHOW TABLES');

    while ($row = $queryTables->fetch_row()) {
      $target_tables[] = $row[0];
    }

    if ($tables !== false) {
      $target_tables = array_intersect($target_tables, $tables);
    }

    return $target_tables;
  }

  public function processTable($table, $host, $user, $pass, $name) {
    if (empty($table)) {
      return;
    }

    $content = "";

    $mysqli = new \mysqli($host, $user, $pass, $name);

    $result = $mysqli->query('SELECT * FROM `' . $table . '`');
    $fields_amount = $result->field_count;
    $rows_num = $mysqli->affected_rows;

    $res = $mysqli->query('SHOW CREATE TABLE ' . $table);
    $tableLine = $res->fetch_row();
    $tableLine[1] = str_ireplace('CREATE TABLE `', 'CREATE TABLE IF NOT EXISTS `', $tableLine[1]);
    $content .= "\n\n" . $tableLine[1] . ";\n\n";

    for ($i = 0, $st_counter = 0; $i < $fields_amount; $i++, $st_counter = 0) {
      while ($row = $result->fetch_row()) {
        if ($st_counter % 100 == 0 || $st_counter == 0) {
          $content .= "\nINSERT INTO " . $table . " VALUES";
        }

        $content .= "\n(";

        for ($j = 0; $j < $fields_amount; $j++) {
          $row[$j] = str_replace("\n", "\\n", addslashes($row[$j]));

          if (isset($row[$j])) {
            $content .= '"' . $row[$j] . '"';
          } else {
            $content .= '""';
          }

          if ($j < ($fields_amount - 1)) {
            $content .= ',';
          }
        }

        $content .= ")";

        if ((($st_counter + 1) % 100 == 0 && $st_counter != 0) || $st_counter + 1 == $rows_num) {
          $content .= ";";
        } else {
          $content .= ",";
        }

        $st_counter = $st_counter + 1;
      }
    }

    $content .= "\n\n\n";

    return $content;
  }

  public function postExport() {
    return "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
  }

  public function download($backupName, $name, $content) {
    $backupName = $backupName ? $backupName : $name . '--(' . date('H-i-s') . '_' . date('d-m-Y') . ').sql';

    ob_get_clean();

    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header('Content-Length: ' . mb_strlen($content, '8bit'));
    header("Content-disposition: attachment; filename=\"" . $backupName . "\"");

    echo $content;

    exit;
  }
}


