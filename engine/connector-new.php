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
      $sql = 'SELECT * FROM templates ORDER BY `name` ASC';
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
        $sql = 'INSERT INTO `connectors`(`user`, `name`, `source`, `api`, `cred_id`, `cred_pass`, `type`, `method`) VALUES ("'.$_SESSION["username"].'","'.$_POST['name'].'","'.$_POST['source'].'","'.addslashes($_POST['api']).'","'.$_POST['cred_id'].'","'.$_POST['cred_pass'].'","'.$_POST['type'].'","'.$_POST['method'].'")';
        $statement = $connection->prepare($sql);
        $statement->execute();
?>
        <script>
          window.location = "../pages/connector.php";
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
    myG-Bridge - New Connector
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
          <a class="nav-link active" href="../pages/connector.php">
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
          <a class="nav-link " href="../pages/design.php">
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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Builder</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">New Connector</h6>
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
                  <p class="mb-0"><i class="ni ni-atom text-default text-sm opacity-10"></i> New Connector</p>
                  <input type="submit" name="submit" class="btn btn-primary btn-sm ms-auto" value="Save">
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <p class="text-uppercase text-sm">Connector Information</p>
                  <input type="button" name="tmplts" class="btn btn-dark btn-sm ms-auto" value="Templates" id="tmplts">
                </div>
                <div class="row">
                  <div class="col-9">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Name</label>
                      <input id="name" name="name" class="form-control" type="text" placeholder="Name" required>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Stash Type<i>(please fill)</i></label>
                      <input id="type" name="type" class="form-control" type="text" placeholder="'db' or 'ws'" maxlength="2">
                    </div>
                  </div>
                </div>
                <hr class="horizontal dark">
                <p class="text-uppercase text-sm">Account Information</p>
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">API Route (full)/Database Source (in format : <i>server-name</i>|<i>database-name</i>)</label>
                      <input id="source" name="source" class="form-control" type="text" placeholder="API full Route URL or Database Source (including port)" required>
                    </div>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">API Data (Json) or Database Query</label>
                      <input id="api" name="api" class="form-control" type="text" placeholder="API Data/Query">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">API Method</label>
                      <input id="method" name="method" class="form-control" type="text" placeholder="GET/POST/PUT/DELETE" maxlength="6">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Account Login/ID</label>
                      <input id="cred_id" name="cred_id" class="form-control" type="text" placeholder="Credential ID">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Account Password/Key&nbsp;&nbsp;&nbsp;<input type="checkbox" onclick="showHidePassword()"><i class="ni ni-lock-circle-open text-default text-sm opacity-10"></i></label>
                      <input id="cred_pass" name="cred_pass" class="form-control" type="password" placeholder="Credential Password">
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <style>
        .modal {
          display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
          z-index: 1; /* Sit on top */
          padding-top: 100px; /* Location of the box */
          left: 0;
          top: 0;
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        .modal-content {
          position: relative;
          background-color: #fefefe;
          margin: auto;
          padding: 0;
          border: 1px solid #888;
          width: 58%;
          box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
          -webkit-animation-name: animatetop;
          -webkit-animation-duration: 0.4s;
          animation-name: animatetop;
          animation-duration: 0.4s
        }
        @-webkit-keyframes animatetop {
          from {top:-300px; opacity:0} 
          to {top:0; opacity:1}
        }
        @keyframes animatetop {
          from {top:-300px; opacity:0}
          to {top:0; opacity:1}
        }
        .close {
          color: white;
          float: right;
          font-size: 28px;
          font-weight: bold;
        }
        .close:hover,
        .close:focus {
          color: #000;
          text-decoration: none;
          cursor: pointer;
        }
        .modal-header {
          padding: 2px 16px;
          background-color: #5e72e4;
          color: white;
        }
        .modal-body {padding: 2px 16px;}
        .modal-footer {
          padding: 2px 16px;
          background-color: white;
          color: white;
        }
      </style>
      <div id="templateModal" class="modal">
        <div class="modal-content">
          <div class="modal-header">
            <h2 style="color: white;">Connector Templates</h2>
            <span class="close">&times;</span>
          </div>
          <div class="modal-body">
            <br />
            <div class="row">
              <div class="col-12 mb-md-0 mb-4">
                <div class="form-group">
                  <label for="tSelector">Template</label>
                  <select name="tSelector" id="tSelector" class="col-12" onchange="displayTemplateValues()">
                  <option value="empty" disabled selected>--- please choose from this dropdown list ---</option>
                    <?php foreach ($result as $row) : ?>
                      <option value='<?php echo escape($row["source"])."¤".escape(stripslashes($row["api"]))."¤".escape($row["method"])."¤".escape($row["type"])."¤".escape($row["cred_id"])."¤".escape($row["cred_pass"]); ?>'><?php echo escape($row["name"]); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <p>Values</p>
            <div class="row">
              <div class="col-9 mb-md-0 mb-4">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">API Route (full)/Database Source (in format : <i>server-name</i>|<i>database-name</i>)</label>
                  <input id="tsource" name="tsource" class="form-control" type="text" placeholder="API full Route URL or Database Source (including port)" value="" readonly>
                </div>
              </div>
              <div class="col-3 mb-md-0 mb-4">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Stash Type <i>(please fill)</i></label>
                  <input id="ttype" name="ttype" class="form-control" type="text" placeholder="'db' or 'ws'" value="" maxlength="2" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-9 mb-md-0 mb-4">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">API Data (Json) or Database Query</label>
                  <input id="tapi" name="tapi" class="form-control" type="text" placeholder="API Data/Query" value="" readonly>
                </div>
              </div>
              <div class="col-3 mb-md-0 mb-4">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Method</label>
                  <input id="tmethod" name="tmethod" class="form-control" type="text" placeholder="GET/POST/PUT/D..." value="" maxlength="6" readonly>
                </div>
              </div>
              <div class="col-md-6 mb-md-0 mb-4">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Account Login/ID</label>
                  <input id="tcred_id" name="tcred_id" class="form-control" type="text" placeholder="Credential ID" value="" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Account Password/Key&nbsp;&nbsp;&nbsp;<input type="checkbox" onclick="showHidePassword()"><i class="ni ni-lock-circle-open text-default text-sm opacity-10"></i></label>
                  <input id="tcred_pass" name="tcred_pass" class="form-control" type="password" placeholder="Credential Password" value="" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary btn-sm ms-auto" onclick="loadTemplateValues();">Load Template Values</button>
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

    // "template" modal elements
    var modal = document.getElementById("templateModal");
    var btn = document.getElementById("tmplts");
    var span = document.getElementsByClassName("close")[0];
    btn.onclick = function() {
      modal.style.display = "block";
    }
    span.onclick = function() {
      modal.style.display = "none";
    }
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }

    // template value manipulations
    function displayTemplateValues() {
      var disp = document.getElementById("tSelector").value;
      var dispVals = disp.split("¤");
      document.getElementById("tsource").value = dispVals[0];
      document.getElementById("tapi").value = dispVals[1];
      document.getElementById("tmethod").value = dispVals[2];
      document.getElementById("ttype").value = dispVals[3];
      document.getElementById("tcred_id").value = dispVals[4];
      document.getElementById("tcred_pass").value = dispVals[5];
    }
    function loadTemplateValues() {
      document.getElementById("source").value = document.getElementById("tsource").value;
      document.getElementById("api").value = document.getElementById("tapi").value;
      document.getElementById("method").value = document.getElementById("tmethod").value;
      document.getElementById("type").value = document.getElementById("ttype").value;
      document.getElementById("cred_id").value = document.getElementById("tcred_id").value;
      document.getElementById("cred_pass").value = document.getElementById("tcred_pass").value;
      modal.style.display = "none";
    }
    
    function showHidePassword() {
      var x = document.getElementById("cred_pass");
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