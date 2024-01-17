<?php
    /*Check for login else redirect to index.php*/
    if(!isset($_COOKIE['auth'])){
        header('Location: index.php');
        exit();
    }
    $username = base64_decode($_COOKIE['auth']);
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScrumApp - Dashboard</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/moment.js"></script>
    <script type="text/javascript" src="js/mytime.js"></script>
    <script type="text/javascript" src="js/dash.js"></script>
    <script src="https://kit.fontawesome.com/2913b4c3d4.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

  </head>
  <body>
    <div class="main vh-100">
      <div class="d-flex">
        <!--NAV BAR <div class="col-2 vh-100 "></div>-->
        <!------------------------------------------------------------------------------------------------------------------------------------------------>
        <div class="sidebar col-1 vh-100 position-fixed">
            <div class="row m-0 vh-100">
                <div class="col-12 align-self-start text-center mt-5">
                    <img src="bootstrap/logo.png" alt="logo" style="height:60px;cursor:pointer;" onclick="location.reload();">
                </div>
                <div class="h-50 col-12 align-self-center">
                <ul class="navmenu nav row d-flex text-start mx-1">
                      <li class="nav-item p-2 m-2 isactive" onclick='showdash();' id="btndash">
                        <i class="fa-solid fa-table"></i> Dashboard
                      </li>
                      <li class="nav-item p-2 m-2" onclick="showprojects();" id="btnpj">
                        <i class="fa-solid fa-bars-progress"></i> Projects
                      </li>
                      <!--li class="nav-item p-2 m-2">
                        <i class="fa-solid fa-people-group"></i> Team
                      </li>
                      <li class="nav-item p-2 m-2">
                        <i class="fa-solid fa-chart-simple"></i> Reports
                      </li-->
                      <li class="nav-item p-2 m-2" onclick="showsettings();" id="btnset">
                        <i class="fa-solid fa-gear"></i> Settings
                      </li>
                    </ul>
                </div>
                <div class="col-12 align-self-end text-center p-2 mb-3">
                    <span class="logout py-2 px-1" onclick="logout();">
                        <i class="fa-solid fa-power-off"></i> Log Out 
                    </span>
                </div>
            </div>
        </div>
<!------------------------------------------------------------------------------------------------------------------------------------------------>
        <!--MAIN CONTENT-->
        <div class="content p-2 col-11 offset-1 vh-100">
          <div class="row m-0" id="panel-settings">
            <div class="col-12 border-bottom p-4 my-5"><h4>Settings</h4></div>
            <div class="LeftSettingsPanel offset-1 col-2">
            <h6 class="py-2 px-1 fw-bolder text-muted"><i class="fa-solid fa-gear"></i> Settings Menu</h6>
            <ul class="tabsMenu list-group">
              <li class="tabsMenuToggle list-group-item text-light bg-secondary" for="SetTab1">General</li>
              <li class="tabsMenuToggle list-group-item" for="SetTab2">Calendar</li>
              <li class="tabsMenuToggle list-group-item" for="SetTab3">Database & backups</li>
              <li class="tabsMenuToggle list-group-item" for="SetTab4">Users</li>
            </ul>
            </div>
            <div class="rightSettingsPanel col-7 py-2">
              <div class="SetTab1">
                <div class="row">
                  <div class="col-11 offset-1 mt-5">
                    <div class="row m-0">
                      <div class="alert alert-primary alert-scrum" role="alert">
                        <h4 class="alert-heading">ScrumApp</h4>
                        <p>
                          A management tool that utilizes scrum methodology to plan and to track projects.
                        </p>
                        
                        <hr>
                        <div class="mb-0 d-flex justify-content-evenly">
                          <span class="btn btn-sm btn-iws-green"><i class="fa-solid fa-laptop-code"></i> Najet Meftehi</span>
                          <span class="btn btn-sm btn-iws-green" onclick="window.location = 'meftahinajet@gmail.com';"><i class="fa-solid fa-envelope"></i> Gmail</span>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="SetTab2" style="display:none;">
                <div class="row m-0">
                    <div class="col-10 offset-2">
                      <div class="alert alert-warning">
                      <i class="fa-solid fa-triangle-exclamation"></i> Changes on Calendar will affect <strong>ALL</strong> Projects.
                      </div>
                      <div class="row pt-2">
                        <div class="col-4">
                          <label class="form-label text-muted">Hours Per Day</label>
                          <input class="hpd form-control" type="number" value="1">
                        </div>
                        <div class="row mt-5">
                        <label class="form-label text-muted">Working Days</label>
                          <div class="col d-flex justify-content-between" id="wdaysDiv">
                          </div>
                        </div>
                        <div class="row mt-5">
                        <label class="form-label text-muted">Holidays</label>
                        <table class="table table-sm table-borderless table-striped">
                          <thead>
                            <tr>
                              <th colspan="2">
                                <div class="row my-2">
                                  <div class="col-5 offset-1">
                                    <input type="date" class="form-control form-control-sm" id="SelectedholidayDate">
                                  </div>
                                  <div class="col-6">
                                    <button class="btn btn-sm btn-outline-secondary d-inline-block" id="addholiday">Add Holiday</button>
                                  </div>
                                </div>
                              </th>
                            </tr>
                          </thead>
                          <tbody id="holidaystablebody" class = "border-bottom border-top">
                            
                          </tbody>
                        </table>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="SetTab3" style="display:none;">
                <div class="row">
                    <div class="col-10 offset-2">
                      <div class="row pt-4 text-muted fw-bold">
                        Database Settings
                      </div>
                      <div class="row pt-4">
                        <table class="table" id="databaseTable">
                          <thead class="table-dark text-light">
                            <tr>
                              <th>Database Connection Status</th>
                              <th class="dbstatuscell">
                              <span class="dbstatus">-</span>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                          <tr>
                            <td>Server</td>
                            <td class="dbdata dbs" for="db_server" contenteditable="false">.</td>
                          </tr>
                          <tr>
                            <td>DB name</td>
                            <td class="dbdata dbn" for="db_name" contenteditable="false">.</td>
                          </tr>
                          <tr>
                            <td>DB user</td>
                            <td class="dbdata dbu" for="db_user" contenteditable="false">.</td>
                          </tr>
                          <tr>
                            <td>DB Password</td>
                            <td class="dbdata dbp" for="db_pass" contenteditable="false">.</td>
                          </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="row pt-4 text-muted fw-bold">
                        Database backups
                      </div>
                      <div class="row pt-4">
                        <table class="table table-striped">
                          <thead class="table-dark">
                            <tr>
                              <th>SQL Restore Points</th>
                              <th><button class="btn btn-sm btn-secondary" id="Backupdb">Create New</button></th>
                            </tr>
                          </thead>
                          <tbody id="backupstable">
                            
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              <div class="SetTab4" style="display:none;">
                <div class="row">
                  <!--div class="col-12 text-center fw-bold text-muted">Users</div-->
                  <div class="col-10 offset-2">
                    <div class="row pt-4 text-muted fw-bold">
                      Manage users credentials
                    </div>
                    <div class="row pt-4">
                      <table class="table" id="userstable">
                        <thead>
                        <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody id="userstablebody">
                        
                        <tr>
                          <td colspan="3">
                            <button class="btn btn-sm btn-outline-secondary border-0 fw-light">+ Add New User</button>
                          </td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>
          <div class="row m-0" id="panel-dashboard">
          <div class="panelDashmenu col-12 border-bottom p-4 my-5 d-flex"><h4>Dashboard</h4></div>
          <div class="DashContent row m-0 h-100">
            <div class="col-12" id="init">
              <div class="alert alert-warning" role="alert">
              <i class="fa-solid fa-circle-exclamation"></i> If your dashboard doesn't show you any data it means that you should <strong style="cursor:pointer;" onclick="showprojects();"><u>create</u></strong> your first project</div>
              </div>
            <div class="col-6" id="dash-summary">
              <div class="row">
                <div class="col-12">
                  <div class="GlobalSummary card">
                    <div class="card-header text-center"><h5>Summary</h5></div>
                    <div class="card-body row">
                      <div class="col px-5">
                      <ul class="list-group text-secondary fw-bold">
                        <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                          Total Projects <span class="totalpjs badge bg-dark rounded-pill">0</span>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                          Done  <span class="donepjs badge bg-success rounded-pill bg-iws-don">0</span>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                          On Track  <span class="ontrackpjs badge bg-warning rounded-pill bg-iws-ont">0</span>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                          Not Started <span class="notspjs badge bg-secondary rounded-pill bg-iws-not">0</span>
                        </li>

                      </ul>
                      </div>
                      <div class="col"><div id="donut"></div></div>
                    </div>
                    <!--div class="card-footer"></div-->
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6" id="dash-project-performance">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <div class="row">
                        <div class="col-6 text-center"><h5>Project Performance</h5></div>
                        <div class="col-6"><select class="form-select form-select-sm" id="selectpj2sum"></select></div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div id="perff"></div>
                    </div>
                    <!--div class="card-footer"></div-->
                  </div>
                </div>
              </div>
            </div>
            <div class="col-5 my-4 kpicard">
              <div class="dashrowtwo card">
                <div class="card-header text-center">Project KPI's</div>
                <div class="card-body">

                  <div class="col-7 px-3">
                    <ul class="list-group text-secondary fw-bold">
                    <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                    Total Duration / Project Duration <span class="kpi badge bg-secondary rounded-pill">0</span>
                    </li>
                    <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                      Working Days <span class="pjduration badge bg-secondary rounded-pill">0 Days ( 0 h)</span>
                    </li>
                    <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                      Total Tasks Duration <span class="tasksduration badge bg-secondary rounded-pill">0 h</span>
                    </li>
                    </ul>
                  </div>


                </div>
              </div>
            </div>
            <div class="col-7 my-4">
                <div class="card dashrowtwo">
                  <div class="card-header text-center">Project Hours / Member / Task Type</div>
                  <div class="card-body">
                    <div class="membersperf" id="MembersPerfchart"></div>
                  </div>
                </div>
              </div>
            </div>
        </div>
<!--PROJECTS--------------------------------------------------------------------------->
          <div class="pjlists row m-0" id="panel-projects">
            <!--Project MENU  add , List Project -->
            <div class="panelmenu col-13 border-bottom p-4 my-5 d-flex">
              <h4>My Projects</h4>
            </div>
            <!--Project TABS Add , List -->
            <div class="offset-1 col-10 px-5">
            <button class="btn btn-secondary" id="testreal">
                <i class="fa-solid fa-arrows-rotate"></i>
            </button>
            <button class="btn bg-iws-blue" id="AddPjBtn">
                <i class="fa-solid fa-plus"></i> New Project 
            </button>
            </div>
            <div class="projectlist offset-1 col-10 px-5">
              <table class="table caption-top">
                <span class="mx-1"></span>
                <thead class="bg-iws-blue">
                  <tr>
                    <th scope="col"><i class="fa-solid fa-bars-progress"></i></th>
                    <th scope="col">Title</th>
                    <th scope="col">Status</th>
                    <th scope="col">Main Goal</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">Due To</th>
                    <th scope="col">Owner</th>
                    <th scope="col">Members</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody id="pjtbody">

                </tbody>
              </table>
            </div>
          </div>
          <div class="AddPjPanel" id="AddPjPanel">
            <div class="panelmenu col-12 border-bottom p-4 my-5 d-flex">
              <div class="col">
                <h4>New Project</h4>
              </div>
              <div class="col d-flex justify-content-end">
                <button class="btn btn-iws-green  mx-3" id="SavePjBtn">
                  <i class="fa-solid fa-circle-check"></i> Save </button>
                <button class="btn btn-iws-red  mx-3" id="CancelPjBtn">
                  <i class="fa-solid fa-circle-xmark"></i> Cancel </button>
              </div>
            </div>

            <div class="row m-0">
              <div class="offset-1 col-10">
                <div class="AddpjForm row m-0">
                <div class="px-4 pjinfo col-6 bg-light">
                <div class="row">
                <h6>General</h6>
                </div>
                <div class="row">
                <div class="col-12 form-floating">
                <input type="text" value="" class="form-control form-control-sm" id="pjtitle" autocomplete="off">
                <label for="pjtitle" class="form-label px-4">Project Title</label>
                </div>
                <div class="col-12 mt-2 form-floating">
                <input type="text" class="form-control" id="pjgoal" autocomplete="off">
                <label for="pjgoal" class="form-label px-4">Main Goal</label>
                </div>
                <div class="col-12 mt-2 mb-2">
                <textarea type="text" placeholder="Description" class="form-control" id="pjdesc" autocomplete="off"></textarea>
                </div>
                </div>
                <div class="row mb-2">
                <div class="col-4 form-floating">
                <input type="date" value="" class="form-control" id="sdate">
                <label for="sdate" class="form-label px-4">Start Date</label>
                </div>
                <div class="col-4 form-floating">
                <input type="date" value="" class="form-control" id="edate">
                <label for="edate" class="form-label px-4">Due To Date</label>
                </div>
                <div class="col-3 form-floating">
                <input type="number" min="0" value="0" class="form-control" id="duration">
                <label for="edate" class="form-label px-4">Duration (Days)</label>
                </div>
                <div class="col-1 pmbuttons">
                <button class="btn btn-sm" id="plusday">
                <i class="fa-solid fa-circle-plus" style="font-size: 20px;"></i>
                </button>
                <button class="btn btn-sm" id="minusday">
                <i class="fa-solid fa-circle-minus" style="font-size: 20px;"></i>
                </button>
                </div>
                </div>
                <div class="row">
                <div class="col-8 form-floating">
                <input type="text" value="Admin" class="form-control" id="pjowner">
                <label for="edate" class="form-label px-4">Project Owner</label>
                </div>
                <div class="col-4 form-floating">
                <select class="form-select" id="pjstatus">
                <option value="1" selected>Not Started</option>
                <option value="2">On Track</option>
                <option value="3">Done</option>
                </select>
                <label for="pjstatus" class="form-label px-4">Project Status</label>
                </div>
                </div>
                </div>
                <div class="col-6 bg-light">
                <div class="row m-0">
                <div class="pjmembers">
                <div class="row">
                <h6>Project Members</h6>
                </div>
                <div class="pjmembers row">
                <div class="col-3 form-floating">
                <input type="text" class="form-control form-control-sm" id="Newm_fname" autocomplete="off">
                <label for="Newm_fname" class="form-label px-4">First Name</label>
                </div>
                <div class="col-3 form-floating">
                <input type="text" class="form-control form-control-sm" id="Newm_lname" autocomplete="off">
                <label for="Newm_lname" class="form-label px-4">Last Name</label>
                </div>
                <div class="col-3 form-floating">
                <select class="form-select form-control-sm" id="Newm_role">
                <option value="ds" selected>Data Scientist</option>
                <option value="po">Project Owner</option>
                <option value="sm">Scrum Master</option>
                </select>
                <label for="Newm_job" class="form-label px-4">Role</label>
                </div>
                <div class="col-2 d-flex align-items-center">
                <button class="btn btn-iws-outline-green" pid="" id="Addmember"> <i class="fa-solid fa-user-plus"></i> Add</button>
                <!--button class="btn btn-secondary btn-sm d-none" id="listmember">List</button-->
                </div>
                </div>
                </div>
                </div>

                <div class="row m-0 py-4"><span id="lsid"></span>
                <input type="hidden" id="lastidval"></input>
                <table class="table table-sm">
                <thead class="">
                <tr scope="row">
                <th scope="col"># id</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                </tr>
                </thead>
                <tbody id="pjtmembersbody"></tbody>
                </table>
                </div>
                </div>
                </div>
                </div>
              </div>
            </div>



          <!---------------------------------------------------W O P - S T A R T-------------------------------------------------------->
          <div class="" id="panel-workon">
            <div class="panelheader col-12 border-bottom p-4 my-5 d-flex">
              <div class="col">
                <h4 class="wonpjtitle">Project Plan</h4>
                <input type="hidden" value="0" id="currpjid">
              </div>
              <div class="col d-flex justify-content-end">
                <button class="btn btn-sm btn-outline-danger mx-3" id="BtnCloseSPB">
                  <i class="fa-solid fa-chevron-left"></i> My Projects </button>
              </div>
            </div>
            <!----------------------Sprints show--------------------->
            
            <div class="offset-1 col-10 px-5">
            <h5 class="text-muted py-4">Project Sprints</h5>
            <table class="table table-lg table-striped table-borderless" id="SprintsTable">
                <thead class="bg-iws-blue">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Goal</th>
                    <th scope="col">Status</th>
                    <th scope="col">From</th>
                    <th scope="col">To</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody id="SprintsTableBody">
                <tfoot class="border-top border-secondary">
                  <td colspan="9" class="text-center">
                    <button class="btn btn-sm btn-iws-outline-green" id="addsprint">
                      <i class="fa-solid fa-plus"></i> Add Sprint </button>
                  </td>
                </tfoot>
                </tbody>
              </table>
            </div>
            <!------------------------------------------------------->
            <!------------------------New Sprint--------------------->
            <!------------------------------------------------------->
            <!----------------------Sprint backlog------------------->
            <div class="col-12"></div>
            <!------------------------------------------------------->
          </div>
          <!---------------------------------------------------W O P - E N D - -------------------------------------------------------->
          <!---------------------------------------------------S P R I N T - B A C K L O G-------------------------------------------------------->
          <div class="BacklogAreaDiv" id="BacklogArea">
            <div class="panelheader col-12 border-bottom p-4 my-5 d-flex">
              <div class="col">
                <h4 class="SprintBacklogTitle">Sprint Backlog</h4>
                <input type="hidden" value="0" id="currspid">
              </div>
              <div class="col d-flex justify-content-end">
                <button class="btn btn-sm btn-outline-danger mx-3" id="BtnBackToSprints">
                  <i class="fa-solid fa-chevron-left"></i> All Sprints </button>
              </div>
            </div>
            <div class="col-8 py-2 px-5">
              <div class="row">
                <div class="col-3">
                  <select class="form-select" id="taskcategory">
                    <option value="onproject" selected>Project Tasks</option>
                    <option value="offproject">Off Project Tasks</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="on-project">
              <div class="col-12 px-5" id="abovesprintbacklogtable">
                <span class="text-muted fw-bold py-4">Sprint Backlog</span>
                <span id="memberstest"></span>
              </div>
              <!--SPBACKLOG TABLE START-->
              <div class="col-12 px-5" id="sprintbacklogtablearea">
                <table class="table table-sm" id="spbgtable" pid="" sid="">
                  <thead class="bg-iws-blue">
                    <tr>
                      <th scope="col-3"></th>
                      <th scope="col">Story / Task</th>
                      <th scope="col">Goals</th>
                      <th scope="col">Priority</th>
                      <th scope="col">Status</th>
                      <th scope="col">Assignee</th>
                      <th scope="col">Real Duration</th>
                      <th scope="col">Est Duration</th>
                      <th scope="col" id="memberscolhead" colspan="0">Members</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody id="Sprintstory" sprint-id="2" project-id="4">
                  </tbody>
                  <tfoot class="table-secondary">
                    <tr class="text-muted">
                      <td id="addstcc" colspan="12">
                        <button class="btn btn-md btn-outline-secondary fw-bold border-0" id="CallAddNewStory">
                          <i class="fa-solid fa-circle"></i> New Story </button>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!--SPBACKLOG TABLE END-->
            </div>
            <div class="off-project col-12 px-5"><!--offps-->
              <div class="row m-0">
                <div class="col-12">
                  <span class="text-muted fw-bold py-4">OFF-Project Tasks</span>
                </div>
                <div class="col-12" id="tablearea">
                  <table class="offpjtable table text-center table-sm" pid="" sid="">
                    <thead class="bg-iws-blue">
                      <tr>
                          <th>Member</th>
                          <th class="text-start">Task</th>
                          <th>Status</th>
                          <th>Duration</th>
                          <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="offpjtablebody">
                    </tbody>
                  </table>
                </div>
              </div>
            </div><!--offpe-->
          </div>
          <!---------------------------------------------------S P R I N T - B A C K L O G - E N D------------------------------------------------------->
          <!--  M  O  D  A  L  S-->
          <!--sprint modal start-->
          <div class="modal" tabindex="-1" id="sprintmodal">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="spaemodal_title">New Sprint</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="col-12 mb-2">
                    <label for="sp_title" class="form-label">Sprint Title</label>
                    <input type="text" value="" class="form-control" id="sp_title" autocomplete="off">
                  </div>
                  <div class="col-12 mb-2">
                    <label for="sp_title" class="form-label">Sprint Goal</label>
                    <input type="text" value="" class="form-control" id="sp_goal" autocomplete="off">
                  </div>
                  <div class="row py-3">
                    <div class="col-3">
                      <label class="form-label">Start Date</label>
                      <input type="date" value="" class="form-control" id="sp_sdate">
                    </div>
                    <div class="col-3">
                      <label class="form-label">End Date</label>
                      <input type="date" value="" class="form-control" id="sp_edate">
                    </div>
                    <div class="col-3">
                      <label class="form-label">Lasts (days)</label>
                      <input type="text" value="" class="form-control" id="sp_dur" readonly>
                    </div>
                    <div class="col-3">
                      <label class="form-label">Stauts</label>
                      <select class="form-select" id="sp_stat">
                        <option value="1" selected>Not Started</option>
                        <option value="2">On Track</option>
                        <option value="3">Done</option>
                      </select>
                    </div>
                  </div>
                  <div class="row py-3">
                    <div class="SpMemSelection row">
                      <div class="col-6">
                        <label for="allMem">Project Members</label>
                        <div id="allMem" class="mt-1">
                          <ul class="list-group" id="allMemList">
                            <!--li class="list-group-item" id="0001">An item</li-->
                          </ul>
                        </div>
                      </div>
                      <div class="col-6">
                        <label for="selMem">This Sprint Members</label>
                        <div id="selMem" class="mt-1">
                          <ul class="list-group" id="selMemList">
                            <!--li class="list-group-item" id="9811">An item</li-->
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 mb-2">
                    <label for="sp_title" class="form-label">Sprint Description</label>
                    <input type="text" value="" class="form-control" id="sp_desc" autocomplete="off">
                  </div>
                </div>
                <div class="modal-footer" id="spmodalfooter">
                  <button type="button" class="btn btn-sm btn-iws-green" id="savespbtn">Save Sprint</button>
                </div>
              </div>
            </div>
          </div>
          <!--sprint modal end-->
          <!--Display modal start-->
          <div class="modal" tabindex="-1" id="displaypjmodal" aria-labelledby="displaypjmodal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="disp_id">Project id</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <!--X-->
                  <div class="row m-0">
                    <div class="col-12 mb-2">
                      <label for="disp_title" class="form-label">Title</label>
                      <input type="text" value="" class="form-control" id="disp_title">
                    </div>
                    <div class="col-12 mb-2">
                      <label for="disp_goal" class="form-label">Main Goal</label>
                      <input type="text" value="" class="form-control" id="disp_goal">
                    </div>
                    <div class="col-12 mb-2">
                      <label for="disp_desc" class="form-label">Description</label>
                      <textarea type="text" class="form-control" id="disp_desc"></textarea>
                    </div>
                    <div class="col-3">
                      <label for="sdate" class="form-label">Start Date</label>
                      <input type="date" value="" class="form-control" id="disp_sdate">
                    </div>
                    <div class="col-3">
                      <label for="sdate" class="form-label">Due To</label>
                      <input type="date" value="" class="form-control" id="disp_edate">
                    </div>
                    <div class="col-3">
                      <label for="disp_desc" class="form-label">Owner</label>
                      <input type="text" value="" class="form-control" id="disp_owner">
                    </div>
                    <div class="col-3 mb-3">
                      <label for="disp_desc" class="form-label">Status</label>
                      <select class="form-select" id="disp_status">
                        <option value="1">Not Started</option>
                        <option value="2">On Track</option>
                        <option value="3">Done</option>
                      </select>
                    </div>
                    <div class="col-12 mb-3">
                      <label for="dismemtb" class="form-label">Members</label>
                      <table class="table table-striped table-borderless table-sm table-light" id="dismemtb">
                        <thead>
                          <tr scope="row">
                            <th scope="col"># id</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Role</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody id="disp_members"></tbody>
                        <tfoot class="pt-5">
                          <tr>
                            <td colspan="9" class="text-center">
                              <button class="btn btn-sm btn-light" id="addmember">
                                <i class="fa-solid fa-plus"></i> New </button>
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                  <!--X-->
                </div>
                <div class="modal-footer" id="editmodalfooter"></div>
              </div>
            </div>
          </div>
          <!--Display modal end-->
          <!--End PROJECTS-->
          <!--End PROJECTS-->
          <!--End PROJECTS-->
        </div>
      </div>
    </div>
    <!-- Modal confirm delete  -->
    <div class="modal" id="confirmDelModal" tabindex="-1" aria-labelledby="confirmDelModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border-0">
            <p class="m-1">
            </p>
            <h5 class="modal-title" id="confirmDelModal">-</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body border-0">
          
            <input type="hidden" value="0" id="projecttobedeleted">
            <div class="mb-3 px-5">
            <p class="text-danger">
            You are going to permanently delete this Project, including all of its Data.
            </p>
              <label for="confirmdelcode" class="form-label text-muted">Type <c class="text-dark" id="tconfirmdelcode"></c> in the box below to confirm : </label>
              <input type="text" class="form-control" id="confirmdelcode" placeholder="">
            </div>
          </div>
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-sm btn-danger" id="forcedelete">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal" id="confirmDelStory" tabindex="-1" aria-labelledby="confirmDelStory" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header fw-bold border-0"> Warning <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body border-0 text-danger fw-bold"> You are going to permanently delete this Story, including all of its tasks. </div>
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-sm btn-danger" pid="" sid="" stid="" id="ForceDeleteStory">Delete</button>
          </div>
        </div>
      </div>é
    </div>
    <div class="modal" id="confirmDelSprint" tabindex="-1" aria-labelledby="confirmDelSprint" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header fw-bold border-0"> Warning <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body border-0 text-danger fw-bold"> You are going to permanently delete this Sprint, including all of its stories. </div>
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-sm btn-danger" pid="" sid="" id="ForceDeleteSprint">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <!--T O A S T S-->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
      <div id="liveToast" class="toast bg-success text-light hide" data-bs-delay="2000" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body" id="DelToastbody"> Project Deleted </div>
      </div>
    </div>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/project.js"></script>
    <script type="text/javascript" src="js/spbg.js"></script>
  </body>
</html>