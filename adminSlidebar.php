<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
    <link rel="stylesheet" href="slideBarStyle.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
  <body>
    
    <div class="sidebar close">
        <div class="logo-details">
          <i class='bx bx-bitcoin '></i>
          <span class="logo_name">Digital Money Fortune</span>
        </div>
        <ul class="nav-links">
          <li onclick="window.location.href='adminPannel.php'">
            <a href="#">
              <i class='bx bx-grid-alt' ></i>
              <span class="link_name" >AdminPannel</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="#">AdminPannel</a></li>
            </ul>
          </li>
          <li>
            <a href="manageUsers.php">
              <i class='bx bx-user' ></i>
              <span class="link_name">ManageUsers</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="manageUsers.php">ManageUsers</a></li>
            </ul>
          </li>
          <li>
            <a href="manageWithdrawals.php">
              <i class='bx bx-dollar' ></i>
              <span class="link_name">ManageWithdrawals</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="manageWithdrawals.php">ManageWithdrawals</a></li>
            </ul>
          </li>
          <li>
            <a href="manageDeposits.php">
              <i class='bx bx-dollar' ></i>
              <span class="link_name">ManageDeposits</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="manageDeposits.php">ManageDeposits</a></li>
            </ul>
          </li>
          
          <li>
        <div class="profile-details">
          <div class="name-job">
            <div class="profile_name"></div>
          </div>
          <i onclick="window.location.href='adminSignin.php'" class='bx bx-log-out' ></i>
        </div>
      </li>
    </ul>
    </div>
    <section class="home-section">
      <div class="home-content">
        <i class='bx bx-menu' ></i>
      </div>
    </section>

    <script>
      let arrow = document.querySelectorAll(".arrow");
      for (var i = 0; i < arrow.length; i++) {
          arrow[i].addEventListener("click", (e)=>{
      let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
      arrowParent.classList.toggle("showMenu");
          });
      }
      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".bx-menu");
      console.log(sidebarBtn);
      sidebarBtn.addEventListener("click", ()=>{
          sidebar.classList.toggle("close");
      });
    </script>
  </body>
</html>
