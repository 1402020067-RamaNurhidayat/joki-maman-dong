<?php 
  class Post {
    // DB stuff
    private $conn;
    private $table = 'Product';

    // Post Properties
    public $nama;
    public $id_akun;
    public $password;
    public $email;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT * FROM ' . $this->table . ' ORDER BY nama';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT * FROM ' . $this->table . ' WHERE nama = ?';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->nama = $row['nama'];
          $this->id_akun = $row['id_akun'];
          $this->password = $row['password'];
          $this->email = $row['email'];
    }

        // Create Post
        public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET nama = :nama, id_akun = :id_akun, password = :password, email = :email';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->nama = htmlspecialchars(strip_tags($this->nama));
          $this->id_akun = htmlspecialchars(strip_tags($this->id_akun));
          $this->password = htmlspecialchars(strip_tags($this->password));
          $this->email = htmlspecialchars(strip_tags($this->email));

          // Bind data
          $stmt->bindParam(':nama', $this->nama);
          $stmt->bindParam(':id_akun', $this->id_akun);
          $stmt->bindParam(':password', $this->password);
          $stmt->bindParam(':email', $this->email);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }
  }
