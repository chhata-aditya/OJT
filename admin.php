<?php include("connection.php");?>
<?php
    // Check cookie
    if(isset($_COOKIE['token'])){
       // echo "Logged";
        $id = $_COOKIE['id'];
    }
    else{
        //echo ' <meta http-equiv="refresh" content="0;url=login.php">';
        echo "Please login to use panel";
        exit(0);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Roboto', sans-serif;
      background-color: #f5f6fa;
    }

    .dashboard {
      display: flex;
    }

    .sidebar {
      width: 250px;
      background-color:rgb(136, 117, 91);
      color: #fff;
      height: 100vh;
      padding: 20px 0;
      position: fixed;
      transition: all 0.3s ease;
    }

    .sidebar.hidden {
      transform: translateX(-100%);
    }

    .sidebar .brand {
      display: flex;
      align-items: center;
      padding: 0 20px;
      font-size: 1.5rem;
      font-weight: bold;
    }

    .sidebar .brand i {
      margin-right: 10px;
    }

    .sidebar .user-info {
      margin: 20px 0;
      padding: 0 20px;
    }

    .sidebar .nav-links {
      list-style: none;
      padding: 0;
    }

    .sidebar .nav-links li {
      margin: 10px 0;
    }

    .sidebar .nav-links li a {
      color: #fff;
      text-decoration: none;
      padding: 10px 20px;
      display: flex;
      align-items: center;
      border-radius: 4px;
    }

    .sidebar .nav-links li a i {
      margin-right: 10px;
    }

    .sidebar .nav-links li a:hover {
      background-color:rgb(87, 52, 28);
    }
    .sidebar .nav-links li a.active {
    background-color: rgb(87, 52, 28); /* Active link background color */
    color: white; /* Optional: Change text color for active link */
}

    .main-content {
      margin-left: 250px;
      width: calc(100% - 250px);
      padding: 20px;
      transition: margin-left 0.3s ease;
    }

    .main-content.expanded {
      margin-left: 0;
      width: 100%;
    }

    .main-content .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #fff;
      padding: 10px 20px;
      border-bottom: 1px solid #ddd;
    }

    .main-content .header .menu-icon {
      font-size: 1.5rem;
      color: #1a2b4b;
      cursor: pointer;
    }

    .main-content .header .search-bar {
      display: flex;
      align-items: center;
    }

    .main-content .header .search-bar input {
      padding: 5px 10px;
      border: 1px solid #ddd;
      border-radius: 4px 0 0 4px;
      outline: none;
    }

    .main-content .header .search-bar button {
      padding: 5px 10px;
      border: none;
      background-color:rgb(116, 83, 52);
      color: #fff;
      border-radius: 0 4px 4px 0;
      cursor: pointer;
    }

    .main-content .header .user-profile {
      display: flex;
      align-items: center;
    }

    .main-content .header .user-profile img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .content h1 {
      font-size: 2rem;
      color: #333;
    }
    .box {
      display: inline-block;
      margin: 10px;
      padding: 20px;
      width: 200px;
      background-color:rgb(199, 171, 132);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      text-align: center;
      vertical-align: top;
    }

    /* Right-Side Content Styling */
    .right-side {
      margin-bottom: 15px;
    }

    .box-topic {
      font-size: 1.2rem;
      font-weight: bold;
      color: #333;
    }

    .number {
      font-size: 2rem;
      color:rgb(252, 246, 246);
      margin: 10px 0;
    }

    .indicator {
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.9rem;
      color:rgb(83, 34, 34);
    }

    .indicator i {
      margin-right: 5px;
      font-size: 1rem;
    }

    .cart {
      font-size: 2.5rem;
      color:rgb(77, 28, 28);
    }
      /* Box Styling */
      .box-container {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 90%;
      max-width: 1200px;
    }

    .box-header {
      font-size: 1.5rem;
      font-weight: bold;
      color: #333;
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .box-header .add-user-btn {
      background-color: #1a73e8;
      color: #fff;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 0.9rem;
    }

    .box-header .add-user-btn:hover {
      background-color: #155bb5;
    }

    /* Table Styling */
    .user-table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }

    .user-table th,
    .user-table td {
      padding: 15px;
      border: 1px solid #ddd;
    }

    .user-table th {
      background-color: #f2f2f2;
      color: #333;
      font-weight: bold;
    }

    .user-table td {
      color: #555;
    }

    .user-table tr:hover {
      background-color: #f9f9f9;
    }

    /* Responsive Table */
    @media (max-width: 768px) {
      .user-table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
      }

      .box-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }
    }
  </style>
</head>
<body>
  <div class="dashboard">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <div class="brand">
        <i class="fas fa-gem"></i>
        <span>JEWEL</span>
      </div>
        <div class="user-info"> 
            
            <?php
                // Fetch user details
                $sql = "SELECT * FROM users WHERE id=$id";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $name = $row["name"];
                    echo '<h1 style="color:#fff;font-size:20px">Hello, '.$name.'</h1>';
                }
            }
            ?>
           </div>
     
      <ul class="nav-links">
        <li><a href="admin.php" class="active"><i class="fas fa-tachometer-alt "></i> Dashboard</a></li>
        <li><a href="product.php"><i class="fas fa-box"></i> Product</a></li>
        <li><a href="#"><i class="fas fa-list"></i> Order List</a></li>
        <li><a href="#"><i class="fas fa-chart-line"></i> Analytics</a></li>
        <li><a href="#"><i class="fas fa-warehouse"></i> Stock</a></li>
        <li><a href="#"><i class="fas fa-shopping-cart"></i> Total Order</a></li>
        <li><a href="#"><i class="fas fa-users"></i> Team</a></li>
        <li><a href="#"><i class="fas fa-envelope"></i> Messages</a></li>
        <li><a href="#"><i class="fas fa-cogs"></i> Settings</a></li>
        <li><a href="#"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <div class="header">
        <div class="menu-icon" id="menu-icon">
          <i class="fas fa-bars"></i>
        </div>
        <div class="search-bar">
          <input type="text" placeholder="Search...">
          <button><i class="fas fa-search"></i></button>
        </div>
        
      </div>
      <div class="content">
        <h1>Dashboard</h1>
      </div>

  
  <div class="container">
    <!-- First Box -->
    <div class="box">
      <div class="right-side">
        <div class="box-topic">Total Order</div>
        <div class="number">40,876</div>
        <div class="indicator">
          <i class='bx bx-up-arrow-alt'></i>
          <span class="text">Up from yesterday</span>
        </div>
      </div>
      <i class='bx bx-cart-alt cart'></i>
    </div>

    <!-- Second Box -->
    <div class="box">
      <div class="right-side">
        <div class="box-topic">Total Sales</div>
        <div class="number">$25,431</div>
        <div class="indicator">
          <i class='bx bx-up-arrow-alt'></i>
          <span class="text">Increased today</span>
        </div>
      </div>
      <i class='bx bx-cart-alt cart'></i>
    </div>

    <!-- Third Box -->
    <div class="box">
      <div class="right-side">
        <div class="box-topic">New Users</div>
        <div class="number">1,234</div>
        <div class="indicator">
          <i class='bx bx-up-arrow-alt'></i>
          <span class="text">Growing steadily</span>
        </div>
      </div>
      <i class='bx bx-user cart'></i>
    </div>

    <!-- Fourth Box -->
    <div class="box">
      <div class="right-side">
        <div class="box-topic">Revenue</div>
        <div class="number">$10,876</div>
        <div class="indicator">
          <i class='bx bx-up-arrow-alt'></i>
          <span class="text">Higher profits</span>
        </div>
      </div>
      <i class='bx bx-dollar cart'></i>
    </div>
  </div>

<!--table-->
<div class="box-container">
    <div class="box-header">
      <span>Registered User </span>
      
    </div>
    <table class="user-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['name']}</td>
              <td>{$row['email']}</td>
             
            </tr>";
          }
        } else {
          echo "<tr><td colspan='6'>No users found</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!--table-->
<div class="box-container" style="margin: 25px 0px 0px 5px;">
    <div class="box-header">
      <span>Customer Reviews</span>
      
    </div>
    <table class="user-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>review</th>
          
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM review";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['name']}</td>
              <td>{$row['review']}</td>
             
            </tr>";
          }
        } else {
          echo "<tr><td colspan='6'>No users found</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

    </div>
  </div>

  <!-- Embedded JavaScript -->
  <script>
    const menuIcon = document.getElementById("menu-icon");
    const sidebar = document.getElementById("sidebar");
    const mainContent = document.querySelector(".main-content");

    menuIcon.addEventListener("click", () => {
      sidebar.classList.toggle("hidden");
      mainContent.classList.toggle("expanded");
    });
  </script>
</body>
</html>
