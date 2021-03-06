<?php 
  class Category {
    // DB Stuff
    private $conn;
    private $table = 'categories';

    // Properties
    public $nama;
    public $id_akun;
    public $password;
    public $email;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get categories
    public function read() {
      // Create query
      $query = 'SELECT
       id,
       name
      FROM
      ' . $this->table . '
      ORDER BY
        created_at DESC';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;

    }
  }
