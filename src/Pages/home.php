<?php
require_once  $_SERVER['DOCUMENT_ROOT'] . '/Pages/Include/LoginSessionHandler.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>The Bear Cave</title>
	<link rel="stylesheet" href="./CSS/material.min.css">
	<script src="./CSS/material.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <!--<link rel="icon" type="image/png" href="../favIcon.png">-->

</head>
<body>
  <div class="mdl-layout mdl-js-layout">
    <header class="mdl-layout__header mdl-layout__header--scroll">
      <img class="mdl-layout-icon"></img>
      <div class="mdl-layout__header-row">
        <span class="mdl-layout__title">The Bear Cave</span>
        <div class="mdl-layout-spacer"></div>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="./login.php?logout=true">Log Out</a>
        </nav>
      </div>
    </header>
    <div class="mdl-layout__drawer">
      <span class="mdl-layout__title"><?php echo($session_first_name . ' ' . $session_last_name); ?></span>
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="#">User Details</a>
      </nav>
    </div>

    <?php
      use Classes\userStats; 

      $userStats = new userStats();
      $userStats->getHomePageStatistics($session_id);
      var_dump($userStats);
    ?>
    <main class="mdl-layout__content">

      <div class="mdl-grid">
       <div class="mdl-cell mdl-cell--4--col">
         <div class="mdl-card mdl-shadow--6dp" style="overflow:visible;">
          <div class="mdl-card__title mdl-color--primary mdl-color-text--white" >
            <h2 class="mdl-card__title-text"><i class="material-icons">build</i>&nbsp;&nbsp;Maintenance</h2>
          </div>
          <div class="mdl-card__supporting-text">
            <p>My Maintenance Requests: 0</p>
            <p>Open Requests: 0</p>
          </div>
          <div class="mdl-card__actions">
            <span id="view_maintenance_requests">
              <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" >
                <i class="material-icons">search</i>
              </button>
            </span>
            
            <span id="create_maintenance_requests">
              <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect">
                <i class="material-icons">add</i>
              </button>
            </span>

            <div class="mdl-tooltip mdl-tooltip--top" data-mdl-for="view_maintenance_requests">
              View all Maintenance Requests
            </div>
            <div class="mdl-tooltip mdl-tooltip--top" data-mdl-for="create_maintenance_requests">
              Create New Maintenance Requests
            </div>

            
          </div>

        </div> 
      </div>  	
    </div>


  </main>
</div>
</body>
</html>