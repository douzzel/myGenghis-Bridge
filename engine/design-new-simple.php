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
        $sql = 'INSERT INTO `orchestrations`(`user`, `name`, `oname`, `osource`, `oapi`, `ocred_id`, `ocred_pass`, `otype`, `omethod`, `dname`, `dsource`, `dapi`, `dcred_id`, `dcred_pass`, `dtype`, `dmethod`, `action`) VALUES ("'.$_SESSION["username"].'","'.$_POST['name'].'","'.$_POST['oname'].'","'.$_POST['osource'].'","'.addslashes($_POST['oapi']).'","'.$_POST['ocred_id'].'","'.$_POST['ocred_pass'].'","'.$_POST['otype'].'","'.$_POST['omethod'].'","'.$_POST['dname'].'","'.$_POST['dsource'].'","'.addslashes($_POST['dapi']).'","'.$_POST['dcred_id'].'","'.$_POST['dcred_pass'].'","'.$_POST['dtype'].'","'.$_POST['dmethod'].'","'.$_POST['action'].'")';
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
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    myG-Bridge - New Design
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.bunny.net/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-default navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main" data-color="primary">
    <div class="sidenav-header">
      <i class="fas fa-times p-4 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="../pages/dashboard.php">
        <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">myG-Bridge</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav ">
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Builder</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/connector.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-atom text-default text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Connector</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../engine/probe.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-spaceship text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Probe</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Orchestrator</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/testing.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-user-run text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Testing</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="../pages/design.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-ruler-pencil text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Design</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/statistics.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-sound-wave text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Statistics</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/configuration.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-settings text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Configuration</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
      <div class="card card-plain shadow-none" id="sidenavCard">
        <img class="w-50 mx-auto" src="../assets/img/illustrations/icon-documentation.svg" alt="sidebar_illustration">
        <div class="card-body text-center p-3 w-100 pt-0">
          <div class="docs-info">
            <h6 class="mb-0">Need help?</h6>
            <p class="text-xs font-weight-bold mb-0">Please check our docs</p>
          </div>
        </div>
      </div>
      <a class="btn btn-dark btn-sm w-100 mb-3" href="javascript:void(window.open('https://mygenghis.com/classes/livezilla/chat.php?nct=MQ__&hfc=MQ__','','width=400,height=600,left=0,top=0,resizable=yes,menubar=no,location=no,status=yes,scrollbars=yes'))" alt="myG-Bridge - Documentation">
        Documentation
      </a>
    </div>
  </aside>
  <div class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="../pages/dashboard.php">myG-Bridge</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Orchestrator</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">New Design</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item dropdown ps-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user me-sm-1 text-white"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="../pages/profile.php">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-single-02 text-success text-sm opacity-10"></i>
                        </div>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">Profile</span>
                        </h6>
                      </div>
                    </div>
                  </a>
                </li>
                <!--
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="../pages/rtl.php">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-world-2 text-dark text-sm opacity-10"></i>
                        </div>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">RTL</span>
                        </h6>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="../pages/sign-in.php">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-single-copy-04 text-primary text-sm opacity-10"></i>
                        </div>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">Sign In</span>
                        </h6>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="../pages/sign-up.php">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-collection text-info text-sm opacity-10"></i>
                        </div>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">Sign Up</span>
                        </h6>
                      </div>
                    </div>
                  </a>
                </li>
                -->
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="../pages/log-out.php">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-button-power text-danger text-sm opacity-10"></i>
                        </div>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">Log Out</span>
                        </h6>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <div class="form-check form-switch ps-0 ms-auto my-auto">
                <i class="fa fa-sun" style="color: white;"></i>&nbsp;<input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">&nbsp;<i class="fa fa-moon" style="color: white;"></i>
              </div>
            </li>
            <!--
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                  <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          Payment successfully completed
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
            -->
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header pb-0">
              <form method="post">
                <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
                <div class="d-flex align-items-center">
                  <p class="mb-0"><i class="ni ni-ruler-pencil text-default text-sm opacity-10"></i> New Design for an Orchestration</p>
                  <input type="submit" name="submit" class="btn btn-primary btn-sm ms-auto" value="Save">
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Name</label>
                      <input id="name" name="name" class="form-control" type="text" placeholder="Name" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-xs-12">
                    <hr class="horizontal dark">
                    <div class="d-flex align-items-center">
                      <p class="text-uppercase text-sm">Source Information</p>
                    </div>
                    <div class="row">
                      <div class="col-9">
                        <div class="form-group">
                          <label for="tSelector">Source Connector Selector</label>
                          <select name="oSelector" id="oSelector" class="col-12" onchange="displayOriginValues()">
                          <option value="empty" disabled selected>--- please choose from this dropdown list ---</option>
                            <?php foreach ($result as $row) : ?>
                              <option value='<?php echo escape($row["name"])."¤".escape($row["source"])."¤".escape(stripslashes($row["api"]))."¤".escape($row["method"])."¤".escape($row["type"])."¤".escape($row["cred_id"])."¤".escape($row["cred_pass"]); ?>'><?php echo escape($row["name"]); ?></option>
                            <?php endforeach; ?>
                          </select>
                          <input id="oname" name="oname" class="form-control" type="text" readonly hidden>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Stash Type</label>
                          <input id="otype" name="otype" class="form-control" type="text" placeholder="'db' or 'ws'" maxlength="2" readonly>
                        </div>
                      </div>
                    </div>
                    <p class="text-uppercase text-sm">Source Account Information</p>
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">API Route (full)/Database Source (in format : <i>server-name</i>|<i>database-name</i>)</label>
                          <input id="osource" name="osource" class="form-control" type="text" placeholder="API full Route URL or Database Source (including port)"  readonly>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">API Data (Json) or Database Query</label>
                          <input id="oapi" name="oapi" class="form-control" type="text" placeholder="API Data/Query" readonly>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">API Method</label>
                          <input id="omethod" name="omethod" class="form-control" type="text" placeholder="GET/POST/PUT/DELETE" maxlength="6" readonly>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Account Login/ID</label>
                          <input id="ocred_id" name="ocred_id" class="form-control" type="text" placeholder="Credential ID" readonly>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Account Password/Key&nbsp;&nbsp;&nbsp;<input type="checkbox" onclick="oShowHidePassword()"><i class="ni ni-lock-circle-open text-default text-sm opacity-10"></i></label>
                          <input id="ocred_pass" name="ocred_pass" class="form-control" type="password" placeholder="Credential Password" readonly>
                        </div>
                      </div>
                    </div>
                    <hr class="horizontal dark">
                  </div>
                  <div class="col-md-6 col-xs-12">
                  <hr class="horizontal dark">
                    <div class="d-flex align-items-center">
                      <p class="text-uppercase text-sm">Target Information</p>
                    </div>
                    <div class="row">
                      <div class="col-9">
                        <div class="form-group">
                          <label for="tSelector">Target Connector Selector</label>
                          <select name="dSelector" id="dSelector" class="col-12" onchange="displayDestinationValues()">
                          <option value="empty" disabled selected>--- please choose from this dropdown list ---</option>
                            <?php foreach ($result as $row) : ?>
                              <option value='<?php echo escape($row["name"])."¤".escape($row["source"])."¤".escape(stripslashes($row["api"]))."¤".escape($row["method"])."¤".escape($row["type"])."¤".escape($row["cred_id"])."¤".escape($row["cred_pass"]); ?>'><?php echo escape($row["name"]); ?></option>
                            <?php endforeach; ?>
                          </select>
                          <input id="dname" name="dname" class="form-control" type="text" readonly hidden>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Stash Type</label>
                          <input id="dtype" name="dtype" class="form-control" type="text" placeholder="'db' or 'ws'" maxlength="2" readonly>
                        </div>
                      </div>
                    </div>
                    <p class="text-uppercase text-sm">Target Account Information</p>
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">API Route (full)/Database Source (in format : <i>server-name</i>|<i>database-name</i>)</label>
                          <input id="dsource" name="dsource" class="form-control" type="text" placeholder="API full Route URL or Database Source (including port)"  readonly>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">API Data (Json) or Database Query</label>
                          <input id="dapi" name="dapi" class="form-control" type="text" placeholder="API Data/Query" readonly>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">API Method</label>
                          <input id="dmethod" name="dmethod" class="form-control" type="text" placeholder="GET/POST/PUT/DELETE" maxlength="6" readonly>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Account Login/ID</label>
                          <input id="dcred_id" name="dcred_id" class="form-control" type="text" placeholder="Credential ID" readonly>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Account Password/Key&nbsp;&nbsp;&nbsp;<input type="checkbox" onclick="dShowHidePassword()"><i class="ni ni-lock-circle-open text-default text-sm opacity-10"></i></label>
                          <input id="dcred_pass" name="dcred_pass" class="form-control" type="password" placeholder="Credential Password" readonly>
                        </div>
                      </div>
                    </div>
                    <hr class="horizontal dark">
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center">
                      <p class="text-uppercase text-sm">Action(s)</p>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Source >> Target Data Processing</label>
                        <textarea id="action" name="action" class="form-control" type="text" rows="5" placeholder="Action(s)"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-end">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-magic"></i> by <i class="fa fa-hat-wizard"></i> at
                <a href="https://graphene-bsm.com" class="font-weight-bold" target="_blank">Graphene-BSM</a>,
                for a better web.
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
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

    // source/origin connector value loader
    function displayOriginValues() {
      var oDisp = document.getElementById("oSelector").value;
      var oDispVals = oDisp.split("¤");
      document.getElementById("oname").value = oDispVals[0];
      document.getElementById("osource").value = oDispVals[1];
      document.getElementById("oapi").value = oDispVals[2];
      document.getElementById("omethod").value = oDispVals[3];
      document.getElementById("otype").value = oDispVals[4];
      document.getElementById("ocred_id").value = oDispVals[5];
      document.getElementById("ocred_pass").value = DispVals[6];
    }
    // target/destination connector value loader
    function displayDestinationValues() {
      var dDisp = document.getElementById("dSelector").value;
      var dDispVals = dDisp.split("¤");
      document.getElementById("dname").value = dDispVals[0];
      document.getElementById("dsource").value = dDispVals[1];
      document.getElementById("dapi").value = dDispVals[2];
      document.getElementById("dmethod").value = dDispVals[3];
      document.getElementById("dtype").value = dDispVals[4];
      document.getElementById("dcred_id").value = dDispVals[5];
      document.getElementById("dcred_pass").value = dDispVals[6];
    }
    
    function oShowHidePassword() {
      var x = document.getElementById("ocred_pass");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
    function dShowHidePassword() {
      var x = document.getElementById("dcred_pass");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
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