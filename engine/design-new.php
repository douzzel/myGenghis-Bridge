<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim
* Modified for final use by Graphene-BSM

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

<?php
	session_start();
	if (isset($_SESSION["username"])) {
    require "../../config.php";
    require "../../common.php";
    try {
      $connection = new PDO($dsn, $username, $password, $options);
      $sql = 'SELECT connectors.id AS `id`, connectors.user AS `user`, connectors.name AS `name`, connectors.source AS `source`, connectors.api AS `api`, connectors.method AS `method`, connectors.cred_id AS `cred_id`, connectors.type AS `type`, connectors.cred_pass AS `cred_pass`, `creation_date`, `last_modified`, max(`date`) AS `date` FROM `connectors` LEFT JOIN `testing` ON connectors.name = testing.name WHERE connectors.user = "'.$_SESSION["username"].'" GROUP BY `name`, `id` ORDER BY `creation_date` DESC';
      $statement = $connection->prepare($sql);
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }

    if (isset($_POST['submit'])) {
      if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
        die();
      }
      try {
        $connection = new PDO($dsn, $username, $password, $options);
        $sql = 'INSERT INTO `orchestrations`(`user`, `name`, `flow`) VALUES ("'.$_SESSION["username"].'","'.$_POST['flname'].'","'.$_POST['flowyData'].'")';
        $statement = $connection->prepare($sql);
        $statement->execute();
?>
        <script>
          window.location = "../pages/design.php";
        </script>
<?php
      } catch(PDOException $error) {
          echo $sql . "<br>" . $error->getMessage();
      }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    myG-Bridge - Design New
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.bunny.net/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://fonts.bunny.net/css?family=Roboto:400,500,700&display=swap" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <link href="../assets/flowy/styles.css" rel="stylesheet" type="text/css" />
  <link href="../assets/flowy/flowy.min.css" rel="stylesheet" type="text/css" />
  <!-- Script Files -->
  <script src="../assets/flowy/flowy.min.js"></script>
  <script src="../assets/flowy/main.js"></script>
</head>

<body>
  <!-- "coming soon" overlay -->
  <!--
  <div onclick="goBack()" style="position: fixed; display: block; width: 100%; height: 100%; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.5); z-index: 99; cursor: pointer;">
    <div style="position: absolute; top: 50%; left: 50%; font-size: 50px; color: white; transform: translate(-50%,-50%); -ms-transform: translate(-50%,-50%);">
      Coming Soon <small><i>(click to go back)</i></small>
    </div>
  </div>
  -->
  <!-- flowy -->
  <div id="navigation">
      <div id="leftside">
        <div id="details">
          <div id="back" onclick="goBack()" style="cursor: pointer;"><img src="../assets/flowy/assets/arrow.svg" /></div>
          <div id="names">
            <p id="title">Orchestration Designer</p>
            <p id="subtitle">myG-Bridge</p>
          </div>
        </div>
      </div>
      <div id="centerswitch">
        <div id="leftswitch">Diagram view</div>
        <div id="rightswitch">-unnamed-</div>
      </div>
      <div id="buttonsright">
        <!-- <div id="discard" onclick="flowy.deleteBlocks();">Delete Blocks</div> -->
        <form method="post" id="flowData">
          <div id="publish" onclick="saveFlow()">Save</div>
          <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
          <input name="flname" id="flname" type="hidden">
          <input name="flowyData" id="flowyData" type="hidden">
        </form>
      </div>
    </div>
    <div id="leftcard">
      <div id="closecard">
        <img src="../assets/flowy/assets/closeleft.svg" />
      </div>
      <p id="header">Blocks</p>
      <div id="search">
        <img src="../assets/flowy/assets/search.svg" />
        <input type="text" placeholder="Search blocks" />
      </div>
      <div id="subnav">
        <div id="triggers" class="navactive side">Triggers</div>
        <div id="actions" class="navdisabled side">Actions</div>
        <div id="loggers" class="navdisabled side">Loggers</div>
      </div>
      <div id="blocklist">
        <div class="blockelem create-flowy noselect">
          <input
            type="hidden"
            name="blockelemtype"
            class="blockelemtype"
            value="1"
          />
          <div class="grabme">
            <img src="../assets/flowy/assets/grabme.svg" />
          </div>
          <div class="blockin">
            <div class="blockico">
              <span></span>
              <img src="../assets/flowy/assets/eye.svg" />
            </div>
            <div class="blocktext">
              <p class="blocktitle">New visitor</p>
              <p class="blockdesc">
                Triggers when somebody visits a specified page
              </p>
            </div>
          </div>
        </div>
        <div class="blockelem create-flowy noselect">
          <input
            type="hidden"
            name="blockelemtype"
            class="blockelemtype"
            value="2"
          />
          <div class="grabme">
            <img src="../assets/flowy/assets/grabme.svg" />
          </div>
          <div class="blockin">
            <div class="blockico">
              <span></span>
              <img src="../assets/flowy/assets/action.svg" />
            </div>
            <div class="blocktext">
              <p class="blocktitle">Action is performed</p>
              <p class="blockdesc">
                Triggers when somebody performs a specified action
              </p>
            </div>
          </div>
        </div>
        <div class="blockelem create-flowy noselect">
          <input
            type="hidden"
            name="blockelemtype"
            class="blockelemtype"
            value="3"
          />
          <div class="grabme">
            <img src="../assets/flowy/assets/grabme.svg" />
          </div>
          <div class="blockin">
            <div class="blockico">
              <span></span>
              <img src="../assets/flowy/assets/time.svg" />
            </div>
            <div class="blocktext">
              <p class="blocktitle">Time has passed</p>
              <p class="blockdesc">Triggers after a specified amount of time</p>
            </div>
          </div>
        </div>
        <div class="blockelem create-flowy noselect">
          <input
            type="hidden"
            name="blockelemtype"
            class="blockelemtype"
            value="4"
          />
          <div class="grabme">
            <img src="../assets/flowy/assets/grabme.svg" />
          </div>
          <div class="blockin">
            <div class="blockico">
              <span></span>
              <img src="../assets/flowy/assets/error.svg" />
            </div>
            <div class="blocktext">
              <p class="blocktitle">Error prompt</p>
              <p class="blockdesc">Triggers when a specified error happens</p>
            </div>
          </div>
        </div>
      </div>
      <div id="footer">
        <small>
          © <script> document.write(new Date().getFullYear()); </script>, made with <i class="fa fa-magic"></i> by <i class="fa fa-hat-wizard"></i> at <a href="https://graphene-bsm.com" class="font-weight-bold" target="_blank">Graphene-BSM</a>, for a better web.
        </small>
      </div>
    </div>
    <div id="propwrap">
      <div id="properties">
        <div id="close">
          <img src="assets/close.svg" />
        </div>
        <p id="header2">Properties</p>
        <div id="propswitch">
          <div id="dataprop">Data</div>
          <div id="alertprop">Alerts</div>
          <div id="logsprop">Logs</div>
        </div>
        <div id="proplist">
          <p class="inputlabel">Select database</p>
          <div class="dropme">Database 1 <img src="assets/dropdown.svg" /></div>
          <p class="inputlabel">Check properties</p>
          <div class="dropme">All<img src="assets/dropdown.svg" /></div>
          <div class="checkus">
            <img src="assets/checkon.svg" />
            <p>Log on successful performance</p>
          </div>
          <div class="checkus">
            <img src="assets/checkoff.svg" />
            <p>Give priority to this block</p>
          </div>
        </div>
        <div id="divisionthing"></div>
        <div id="removeblock">Delete blocks</div>
      </div>
    </div>
    <div id="canvas"></div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
  <!-- light/dark mode toggle (via session storage) -->
  <script>
    var checkbox = document.getElementById("dark-version");
    if (sessionStorage.getItem("mode") == "dark") {
      darkmode();
    } else {
      nodark();
    }
    checkbox.addEventListener("change", function() {
      if (checkbox.checked) {
        darkmode();
      } else {
        nodark();
      }
    });
    function darkmode() {
      body.classList.add("dark-version");
      checkbox.checked = true;
      sessionStorage.setItem("mode", "dark");
    }
    function nodark() {
      body.classList.remove("dark-version");
      checkbox.checked = false;
      sessionStorage.setItem("mode", "light");
    }
    function goBack() {
      history.back();
    }
    function saveFlow() {
      document.getElementById("flowyData").value = JSON.stringify(flowy.output());
      var orcName = prompt("Please name this orchestration design :");
      if (orcName == null || orcName == "") {
        alert("Orchestration must be named to save it!");
      } else {
        document.getElementById("flname").value = orcName;
        if (document.getElementById("flowyData").value != ("" || "undefined")) {
          document.getElementById("flowData").submit();
        } else {
          alert("Current orchestration design does not exist!\nPlease create it before saving!");
        }
      }
    }
  </script>
</body>

</html>

<?php
	}  else  {
?>
   <script>
      window.location = "../index.php";
   </script>
<?php 
	}  
?>