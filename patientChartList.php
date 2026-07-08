<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Victoria Advanced Dental Care</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/dentalchart.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include_once('bars/sidebar.php'); ?>


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <?php include_once('bars/topbar.php'); ?>


                <!-- Begin Page Content -->
                <div class="container-fluid" id="content-table">
                    <div class="row" id="patientCards" <?php if ($_SESSION["account_type"] == 200) {
                        echo 'style="display:none;"';
                    } ?>>
                    </div>

                    <!-- Page Heading -->
                    <div class="card shadow mb-12" <?php if ($_SESSION["account_type"] == 200) {
                        echo 'style="display:none;"';
                    } ?>>
                        <div class="card-header py-3 <?php echo $cards; ?>">
                            <h6 class="m-0 font-weight-bold">Patient Chart : <?php echo $_GET["clientname"]; ?></h6>
                            <input type="hidden" id="clientid" value="<?php echo $_GET["id"]; ?>">
                        </div>
                        <div class="card-body">
                            <!-- USE THIS SPACE FOR YOUR ADDITIONAL CODE SNIPPET -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-dark" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Dentist</th>
                                                <th>Treatment</th>
                                                <th>Diagnosis</th>
                                                <th>Remarks</th>
                                                <th>Details</th>
                                                <th>HMO</th>
                                                <th>Fee</th>
                                                <th>Payment</th>
                                                <th>Payment Type</th>
                                                <th>Payment Date</th>
                                                <th>Balance</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>

                                        <tbody id="resultResponsez">



                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <!-- Edit Modal -->

                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">

                                <div class="modal-dialog modal-xl " role="document">
                                    <div class="modal-content ">
                                        <form id="editForm">
                                            <div class="modal-header <?php echo $cards; ?>">
                                                <h5 class="modal-title" id="editModalLabel">Edit Treatment</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="soaid" id="edit-soaid">
                                                <input type="hidden" name="tsubid" id="edit-tsubid">

                                                <div class="form-group">
                                                    <label>Treatment</label>
                                                    <input type="text" class="form-control" name="treatment"
                                                        id="edit-treatment">
                                                </div>
                                                <div class="form-group">
                                                    <label>Diagnosis</label>

                                                    <textarea class="form-control" name="diagnosis" id="edit-diagnosis"
                                                        rows="4"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Remarks</label>
                                                    <input type="text" class="form-control" name="remarks"
                                                        id="edit-remarks">
                                                </div>
                                                <div class="form-group">
                                                    <label>Details</label>
                                                    <textarea class="form-control" name="details" id="edit-details"
                                                        rows="4"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Price</label>
                                                    <input type="number" step="0.01" class="form-control" name="price"
                                                        id="edit-price">
                                                </div>
                                                HMO:
                                                <select id="edit-hmo" name="hmo" class="form-control mb-2">
                                                    <option value=""></option>
                                                    <option value="Flexicare">Flexicare</option>
                                                    <option value="Intellicare">Intellicare</option>
                                                    <option value="Avega">Avega</option>
                                                    <option value="Eastwest">Eastwest</option>
                                                    <option value="ValuCare">ValuCare</option>
                                                    <option value="Medicard">Medicard</option>
                                                    <option value="Health Partners Dental Access, Inc.">Health Partners
                                                        Dental
                                                        Access, Inc.</option>
                                                    <option value="Dental Network Company">Dental Network Company
                                                    </option>
                                                    <option value="Cocolife">Cocolife</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    onclick="updateTreatment()">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                            <!-- END OF YOUR ADDITIONAL CODE SNIPPET -->
                        </div>
                    </div>

                    <br>
                    <div class="card shadow mb-12">
                        <div class="card-header py-3 <?php echo $cards; ?>">
                            <h6 class="m-0 font-weight-bold">Dental Chart : <?php echo $_GET["clientname"]; ?></h6>

                        </div>
                        <div class="card-body" id="dental-chart-region">
                            <!-- USE THIS SPACE FOR YOUR ADDITIONAL CODE SNIPPET -->


                            <div class="text-center"><strong>UPPER</strong></div>
                            <div class="tooth-arch">
                                <!-- Column 1: Tooth 18 to 11 -->
                                <div class="tooth-column">
                                    <div class="tooth" data-tooth="18">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 18">
                                        <label>18</label>
                                    </div>
                                    <div class="tooth" data-tooth="17">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 17">
                                        <label>17</label>
                                    </div>
                                    <div class="tooth" data-tooth="16">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 16">
                                        <label>16</label>
                                    </div>
                                    <div class="tooth" data-tooth="15">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 15">
                                        <label>15</label>
                                    </div>
                                    <div class="tooth" data-tooth="14">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 14">
                                        <label>14</label>
                                    </div>
                                    <div class="tooth" data-tooth="13">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 13">
                                        <label>13</label>
                                    </div>
                                    <div class="tooth" data-tooth="12">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 12">
                                        <label>12</label>
                                    </div>
                                    <div class="tooth" data-tooth="11">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 11">
                                        <label>11</label>
                                    </div>
                                </div>

                                <!-- Column 2: Tooth 21 to 28 -->
                                <div class="tooth-column">
                                    <div class="tooth" data-tooth="21">
                                        <div class="remark-display">✔</div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 21">
                                        <label>21</label>
                                    </div>
                                    <div class="tooth" data-tooth="22">
                                        <div class="remark-display">MD</div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 22">
                                        <label>22</label>
                                    </div>
                                    <div class="tooth" data-tooth="23">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 23">
                                        <label>23</label>
                                    </div>
                                    <div class="tooth" data-tooth="24">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 24">
                                        <label>24</label>
                                    </div>
                                    <div class="tooth" data-tooth="25">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 25">
                                        <label>25</label>
                                    </div>
                                    <div class="tooth" data-tooth="26">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 26">
                                        <label>26</label>
                                    </div>
                                    <div class="tooth" data-tooth="27">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 27">
                                        <label>27</label>
                                    </div>
                                    <div class="tooth" data-tooth="28">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 28">
                                        <label>28</label>
                                    </div>
                                </div>
                            </div>

                            <!--end column 1-->
                            <div class="tooth-arch" style="margin-top: 40px;">
                                <!-- Column 1: 55 to 51 -->
                                <div class="tooth-column">
                                    <div class="tooth" data-tooth="55">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 55">
                                        <label>55</label>
                                    </div>
                                    <div class="tooth" data-tooth="54">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 54">
                                        <label>54</label>
                                    </div>
                                    <div class="tooth" data-tooth="53">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 53">
                                        <label>53</label>
                                    </div>
                                    <div class="tooth" data-tooth="52">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 52">
                                        <label>52</label>
                                    </div>
                                    <div class="tooth" data-tooth="51">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 51">
                                        <label>51</label>
                                    </div>
                                </div>

                                <!-- Column 2: 61 to 65 -->
                                <div class="tooth-column">
                                    <div class="tooth" data-tooth="61">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 61">
                                        <label>61</label>
                                    </div>
                                    <div class="tooth" data-tooth="62">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 62">
                                        <label>62</label>
                                    </div>
                                    <div class="tooth" data-tooth="63">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 63">
                                        <label>63</label>
                                    </div>
                                    <div class="tooth" data-tooth="64">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 64">
                                        <label>64</label>
                                    </div>
                                    <div class="tooth" data-tooth="65">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 65">
                                        <label>65</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 text-left">
                                    <strong>RIGHT</strong>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <strong>LEFT</strong>
                                </div>
                            </div>

                            <!-- end column 2 -->
                            <div class="tooth-arch" style="margin-top: 40px;">
                                <!-- Column 1: 55 to 51 -->
                                <div class="tooth-column">
                                    <div class="tooth" data-tooth="85">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 85">
                                        <label>85</label>
                                    </div>
                                    <div class="tooth" data-tooth="84">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 84">
                                        <label>84</label>
                                    </div>
                                    <div class="tooth" data-tooth="83">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 83">
                                        <label>53</label>
                                    </div>
                                    <div class="tooth" data-tooth="82">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 82">
                                        <label>82</label>
                                    </div>
                                    <div class="tooth" data-tooth="81">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 81">
                                        <label>81</label>
                                    </div>
                                </div>

                                <!-- Column 2: 61 to 65 -->
                                <div class="tooth-column">
                                    <div class="tooth" data-tooth="71">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 71">
                                        <label>71</label>
                                    </div>
                                    <div class="tooth" data-tooth="72">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 72">
                                        <label>72</label>
                                    </div>
                                    <div class="tooth" data-tooth="73">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 73">
                                        <label>73</label>
                                    </div>
                                    <div class="tooth" data-tooth="74">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 74">
                                        <label>74</label>
                                    </div>
                                    <div class="tooth" data-tooth="75">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 75">
                                        <label>75</label>
                                    </div>
                                </div>
                            </div>

                            <!-- end column 3 -->

                            <div class="tooth-arch">
                                <!-- Column 1: Tooth 18 to 11 -->
                                <div class="tooth-column">
                                    <div class="tooth" data-tooth="48">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 48">
                                        <label>48</label>
                                    </div>
                                    <div class="tooth" data-tooth="47">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 47">
                                        <label>47</label>
                                    </div>
                                    <div class="tooth" data-tooth="46">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 46">
                                        <label>46</label>
                                    </div>
                                    <div class="tooth" data-tooth="45">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 45">
                                        <label>45</label>
                                    </div>
                                    <div class="tooth" data-tooth="44">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 44">
                                        <label>44</label>
                                    </div>
                                    <div class="tooth" data-tooth="43">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 43">
                                        <label>43</label>
                                    </div>
                                    <div class="tooth" data-tooth="42">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 42">
                                        <label>42</label>
                                    </div>
                                    <div class="tooth" data-tooth="41">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 41">
                                        <label>41</label>
                                    </div>
                                </div>

                                <!-- Column 2: Tooth 21 to 28 -->
                                <div class="tooth-column">
                                    <div class="tooth" data-tooth="31">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 31">
                                        <label>21</label>
                                    </div>
                                    <div class="tooth" data-tooth="32">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 32">
                                        <label>32</label>
                                    </div>
                                    <div class="tooth" data-tooth="33">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 33">
                                        <label>33</label>
                                    </div>
                                    <div class="tooth" data-tooth="34">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 34">
                                        <label>34</label>
                                    </div>
                                    <div class="tooth" data-tooth="35">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 35">
                                        <label>35</label>
                                    </div>
                                    <div class="tooth" data-tooth="36">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 36">
                                        <label>36</label>
                                    </div>
                                    <div class="tooth" data-tooth="37">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 37">
                                        <label>37</label>
                                    </div>
                                    <div class="tooth" data-tooth="38">
                                        <div class="remark-display"></div>
                                        <img src="dentalcharts/tooth_1.png" alt="Tooth 38">
                                        <label>38</label>
                                    </div>
                                </div>
                            </div>

                            <!-- end column 4 -->
                            <div class="text-center"><strong>LOWER</strong></div>







                            <!-- Add more teeth as needed -->


                            <!-- Modal -->
                            <!-- <div id="remark-modal" style="display:none;">
                                    <h3>Tooth: <span id="selected-tooth"></span></h3>
                                    <textarea id="tooth-remark" rows="4" cols="40"
                                        placeholder="Enter remark here..."></textarea>
                                    <button onclick="saveRemark()">Save</button>
                                    <button onclick="closeModal()">Cancel</button>
                                </div> -->

                            <!-- Drawing Modal -->
                            <!-- Drawing Modal -->

                            <!-- Edit Modal -->




                            <!-- END OF YOUR ADDITIONAL CODE SNIPPET -->
                        </div>

                        <div class="modal fade" id="drawingModal" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tooth Region</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div
                                        class="modal-body d-flex flex-column align-items-center justify-content-center">
                                        <div class="mb-3">
                                            <label class="me-3"><input type="radio" name="penColor" value="red" checked>
                                                Red</label>
                                            <label><input type="radio" name="penColor" value="blue"> Blue</label>
                                        </div>

                                        <div id="svg-wrapper"
                                            style="position:relative; width:300px; height:300px; overflow:hidden;">
                                            <img id="toothImage" src=""
                                                style="position:absolute; top:0; left:0; width:100%; height:100%;">
                                            <svg id="svgOverlay" viewBox="0 0 300 300"
                                                style="position:absolute; top:0; left:0; width:100%; height:100%;">
                                                <circle id="center" cx="150" cy="150" r="40" fill="transparent" />
                                                <rect id="top" x="110" y="10" width="80" height="40"
                                                    fill="transparent" />
                                                <rect id="bottom" x="110" y="250" width="80" height="40"
                                                    fill="transparent" />
                                                <rect id="left" x="10" y="110" width="40" height="80"
                                                    fill="transparent" />
                                                <rect id="right" x="250" y="110" width="40" height="80"
                                                    fill="transparent" />
                                            </svg>
                                        </div>

                                        <div class="mb-3">
                                            <label for="remarkSelect" class="me-2">Remark:</label>
                                            <select id="remarkSelect" class="form-select">
                                                <option value="-">-- Select Remark --</option>
                                                <option value="✔">✔- Present</option>
                                                <option value="C">C - Caries</option>
                                                <option value="C1">C1 - Caries</option>
                                                <option value="C2">C2 - Caries</option>
                                                <option value="C3">C3 - Caries</option>
                                                <option value="C4">C4 - Caries</option>
                                                <option value="C5">C5 - Caries</option>
                                                <option value="X">X - Missing</option>
                                                <option value="Ex">Ex - For Extraction</option>
                                                <option value="IM">IM - Impacted Tooth</option>
                                                <option value="SP">Sp - Supernumerary Tooth</option>
                                                <option value="Rf">Rf - Root Fragment</option>
                                                <option value="Un">Un - Unerupted</option>
                                                <option value="Am">Am - Amalgam Filling</option>
                                                <option value="Co">Co - Composite Filling</option>
                                                <option value="JC">JC - Jacket Crown</option>
                                                <option value="Ab">Ab - Abutment</option>
                                                <option value="Att">Att - Attachment</option>
                                                <option value="In">In - Inlay</option>
                                                <option value="Imp">Imp - Implant</option>
                                                <option value="PFS">PFS - Pit & Fissure Sealant</option>
                                                <option value="Rm">Rm - Removable Denture</option>
                                                <option value="RCT">RCT - Root Canal Treated</option>

                                            </select>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" onclick="resetDrawingModal()">Reset</button>
                                        <button class="btn btn-primary" onclick="saveRegion()">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include_once('bars/footer.php'); ?>

            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Page level plugins -->
            <script src="vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/demo/datatables-demo.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>
            <script src="js/custom-v2.js"></script>
            <script src="controllers/logOutConroller.js"></script>
            <script src="controllers/sessionController.js"></script>
            <script src="controllers/patientChartListController-v3.js"></script>
            <!-- <script src="controllers/dentalchartController.js"></script> -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="controllers/dentalchartController-v8.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>



</body>

</html>