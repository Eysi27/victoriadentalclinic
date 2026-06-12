<?php

include_once("properties.php");
session_start();
error_reporting(0);
echo '
 <!-- Sidebar -->
        <ul class="navbar-nav ' . $sidebarColor . ' sidebar sidebar-dark  toggled" id="accordionSidebar">
<li class="nav-item">
                <a class="nav-link" href="basecode.php">
                
                 <strong>VADC</strong></a>
            </li>

          
';

if ($_SESSION["account_type"] == 0) {
    echo '
   <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="basecode.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span></a>
            </li>
';
    echo '
                <li class="nav-item">
                <a class="nav-link" href="clientProfileList.php" >
                    <i class="fas fa-address-card"></i>
                    <span>Patient\'s Profile</span>
                    </a>
               
            </li>

   
       


        <li class="nav-item">
                <a class="nav-link" href="soaList.php" >
                    <i class="fas fa-credit-card"></i>
                    <span>E-SOA</span>
                </a>
        </li>
        </li>
     <li class="nav-item">
    <a class="nav-link" href="prescriptionList.php" >
        <i class="fas fa-notes-medical"></i>
        <span>Prescription</span>
    </a>
   
    </li>

      <li class="nav-item">
    <a class="nav-link" href="dentalcertList.php" >
        <i class="fas fa-certificate"></i>
        <span>Dental Certificate</span>
    </a>
   
    </li>
       

               <li class="nav-item">
    <a class="nav-link" href="expensesList.php" >
        <i class="fas fa-shopping-cart"></i>
        <span>Expenses</span>
    </a>

          <li class="nav-item">
    <a class="nav-link" href="pendingAppointmentList.php" >
        <i class="fas fa-calendar-check"></i>
        <span>Client Appointments</span>
    </a>

        
   
    
            ';


    // if ($_SESSION["username"] == $superuser) {
    echo '
<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#report" aria-expanded="false"
        aria-controls="config">
        <i class="fas fa-file"></i>
        <span>Reports</span>
    </a>
    <div id="report" class="collapse" aria-labelledby="report" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
  

<a class="collapse-item" href="statementofaccounts.php">Statement of Account</a>

<a class="collapse-item" href="incomedaterange.php">Income Statement</a>
<a class="collapse-item" href="dailytransactionsummary.php">Daily Transaction Summary</a>
<a class="collapse-item" href="lasttreatment3months.php">Last Treatment > 3 Months</a>
<a class="collapse-item" href="monthlyexpensesummary.php">Monthly Expense Summary</a>
          
 

        </div>
    </div>
</li>
         <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#config" aria-expanded="false"
                    aria-controls="config">
                    <i class="fas fa-cog"></i>
                    <span>Configurations</span>
                    </a>
                <div id="config" class="collapse" aria-labelledby="config"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="treatmentList.php">Treatment List</a>
                         <a class="collapse-item" href="medicineList.php">Medicine List</a>
                     
                    </div>
                </div>
            </li>
        <!-- End of Sidebar -->

';
    //  <a class="collapse-item" href="soadaterange.php">SOA Summary per Date</a>
//     <a class="collapse-item" href="soaperclient.php">SOA Summary per Client</a>
//      <a class="collapse-item" href="soaperdentist.php">SOA Summary per Dentist</a>


    //      <a class="collapse-item" href="clienttreatmentrecordperdentist.php">CT Records per Dentist</a>
//     <a class="collapse-item" href="clienttreatmentrecordperclient.php">CT Records per Client</a>
// <a class="collapse-item" href="clienttreatmentrecordperdentist.php">CT Records per Dentist</a>
//   <a class="collapse-item" href="soadaterange.php">SOA Summary per Date</a>
//     <a class="collapse-item" href="soaperclient.php">SOA Summary per Client</a>
//      <a class="collapse-item" href="soaperdentist.php">SOA Summary per Dentist</a>
//     <a class="collapse-item" href="clienttreatmentrecordperdate.php">CT Records per Date</a>
//     <a class="collapse-item" href="clienttreatmentrecordperclient.php">CT Records per Client</a>
// <a class="collapse-item" href="clienttreatmentrecordpertreatment.php">CT Records per Treatment</a>
// }
// <li class="nav-item">
// <a class="nav-link" href="consentList.php" >
//     <i class="fas fa-file"></i>
//     <span>Consent List</span>
// </a>
// </li>
} elseif ($_SESSION["account_type"] == 100) {
    echo '
   <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="basecode.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span></a>
            </li>
';
    echo '
                <li class="nav-item">
                <a class="nav-link" href="clientProfileList.php" >
                    <i class="fas fa-address-card"></i>
                    <span>Patient\'s Profile</span>
                    </a>
               
            </li>

   
       


        <li class="nav-item">
                <a class="nav-link" href="soaList.php" >
                    <i class="fas fa-credit-card"></i>
                    <span>E-SOA</span>
                </a>
        </li>
        </li>
     <li class="nav-item">
    <a class="nav-link" href="prescriptionList.php" >
        <i class="fas fa-notes-medical"></i>
        <span>Prescription</span>
    </a>
   
    </li>

      <li class="nav-item">
    <a class="nav-link" href="dentalcertList.php" >
        <i class="fas fa-certificate"></i>
        <span>Dental Certificate</span>
    </a>
   
    </li>
       

               <li class="nav-item">
    <a class="nav-link" href="expensesList.php" >
        <i class="fas fa-shopping-cart"></i>
        <span>Expenses</span>
    </a>
   
    
            ';


    // if ($_SESSION["username"] == $superuser) {
    echo '
<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#report" aria-expanded="false"
        aria-controls="config">
        <i class="fas fa-file"></i>
        <span>Reports</span>
    </a>
    <div id="report" class="collapse" aria-labelledby="report" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
  

<a class="collapse-item" href="statementofaccounts.php">Statement of Account</a>

<a class="collapse-item" href="incomedaterange.php">Income Statement</a>
<a class="collapse-item" href="dailytransactionsummary.php">Daily Transaction Summary</a>
<a class="collapse-item" href="lasttreatment3months.php">Last Treatment > 3 Months</a>
<a class="collapse-item" href="monthlyexpensesummary.php">Monthly Expense Summary</a>
          
 

        </div>
    </div>
</li>
         <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#config" aria-expanded="false"
                    aria-controls="config">
                    <i class="fas fa-cog"></i>
                    <span>Configurations</span>
                    </a>
                <div id="config" class="collapse" aria-labelledby="config"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="treatmentList.php">Treatment List</a>
                         <a class="collapse-item" href="medicineList.php">Medicine List</a>
                     
                    </div>
                </div>
            </li>
        <!-- End of Sidebar -->

';
    //  <a class="collapse-item" href="soadaterange.php">SOA Summary per Date</a>
//     <a class="collapse-item" href="soaperclient.php">SOA Summary per Client</a>
//      <a class="collapse-item" href="soaperdentist.php">SOA Summary per Dentist</a>


    //      <a class="collapse-item" href="clienttreatmentrecordperdentist.php">CT Records per Dentist</a>
//     <a class="collapse-item" href="clienttreatmentrecordperclient.php">CT Records per Client</a>
// <a class="collapse-item" href="clienttreatmentrecordperdentist.php">CT Records per Dentist</a>
//   <a class="collapse-item" href="soadaterange.php">SOA Summary per Date</a>
//     <a class="collapse-item" href="soaperclient.php">SOA Summary per Client</a>
//      <a class="collapse-item" href="soaperdentist.php">SOA Summary per Dentist</a>
//     <a class="collapse-item" href="clienttreatmentrecordperdate.php">CT Records per Date</a>
//     <a class="collapse-item" href="clienttreatmentrecordperclient.php">CT Records per Client</a>
// <a class="collapse-item" href="clienttreatmentrecordpertreatment.php">CT Records per Treatment</a>
// }
// <li class="nav-item">
// <a class="nav-link" href="consentList.php" >
//     <i class="fas fa-file"></i>
//     <span>Consent List</span>
// </a>
// </li>
} elseif ($_SESSION["account_type"] == 1) {
    echo '
                <li class="nav-item">
                <a class="nav-link" href="clientProfileList.php" >
                    <i class="fas fa-address-card"></i>
                    <span>Patient\'s Profile</span>
                    </a>
               
            </li>

   
       


        <li class="nav-item">
                <a class="nav-link" href="soaList.php" >
                    <i class="fas fa-credit-card"></i>
                    <span>E-SOA</span>
                </a>
        </li>
        </li>
     <li class="nav-item">
    <a class="nav-link" href="prescriptionList.php" >
        <i class="fas fa-notes-medical"></i>
        <span>Prescription</span>
    </a>
   
    </li>
     <li class="nav-item">
    <a class="nav-link" href="dentalcertList.php" >
        <i class="fas fa-certificate"></i>
        <span>Dental Certificate</span>
    </a>
   
    </li>
            ';

    echo '
<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#report" aria-expanded="false"
        aria-controls="config">
        <i class="fas fa-file"></i>
        <span>Reports</span>
    </a>
    <div id="report" class="collapse" aria-labelledby="report" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">

<a class="collapse-item" href="dailytransactionsummary.php">Daily Transaction Summary</a>

          
        </div>
    </div>
</li>
         <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#config" aria-expanded="false"
                    aria-controls="config">
                    <i class="fas fa-cog"></i>
                    <span>Configurations</span>
                    </a>
                <div id="config" class="collapse" aria-labelledby="config"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="treatmentList.php">Treatment List</a>
                         <a class="collapse-item" href="medicineList.php">Medicine List</a>
                     
                    </div>
                </div>
            </li>
        <!-- End of Sidebar -->

';
} elseif ($_SESSION["account_type"] == 2) {
    echo '
                <li class="nav-item">
                <a class="nav-link" href="clientProfileList.php" >
                    <i class="fas fa-address-card"></i>
                    <span>Patient\'s Profile</span>
                    </a>
               
            </li>

   
       


        <li class="nav-item">
                <a class="nav-link" href="soaList.php" >
                    <i class="fas fa-credit-card"></i>
                    <span>E-SOA</span>
                </a>
        </li>
        </li>
     <li class="nav-item">
    <a class="nav-link" href="prescriptionList.php" >
        <i class="fas fa-notes-medical"></i>
        <span>Prescription</span>
    </a>
   
    </li>
     <li class="nav-item">
    <a class="nav-link" href="dentalcertList.php" >
        <i class="fas fa-certificate"></i>
        <span>Dental Certificate</span>
    </a>
   
    </li>
            ';

    echo '
<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#report" aria-expanded="false"
        aria-controls="config">
        <i class="fas fa-file"></i>
        <span>Reports</span>
    </a>
    <div id="report" class="collapse" aria-labelledby="report" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
<a class="collapse-item" href="clientTreatmentReport.php">Patient Treatments</a>
        </div>
    </div>
</li>
         <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#config" aria-expanded="false"
                    aria-controls="config">
                    <i class="fas fa-cog"></i>
                    <span>Configurations</span>
                    </a>
                <div id="config" class="collapse" aria-labelledby="config"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="treatmentList.php">Treatment List</a>
                         <a class="collapse-item" href="medicineList.php">Medicine List</a>
                     
                    </div>
                </div>
            </li>
        <!-- End of Sidebar -->

';
} else if ($_SESSION["account_type"] == 200) {

    echo '
                <li class="nav-item">
                <a class="nav-link" href="clientProfileList.php" >
                    <i class="fas fa-address-card"></i>
                    <span>Patient\'s Profile</span>
                    </a>
               
            </li>


     <li class="nav-item">
    <a class="nav-link" href="prescriptionList.php" >
        <i class="fas fa-notes-medical"></i>
        <span>Prescription</span>
    </a>
   
    </li>

      <li class="nav-item">
    <a class="nav-link" href="dentalcertList.php" >
        <i class="fas fa-certificate"></i>
        <span>Dental Certificate</span>
    </a>
   
    </li>
       

    
            ';

}
echo '
            
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
          
         ';
//  <li class="nav-item">
//         <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
//             aria-controls="collapseTwo">
//             <i class="fas fa-address-card"></i>
//             <span>Client Profile</span>
//             </a>
//         <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
//             data-parent="#accordionSidebar">
//             <div class="bg-white py-2 collapse-inner rounded">
//                 <a class="collapse-item" href="clientProfileList.php">View List</a>
// 		<a class="collapse-item" href="registerClient.php">Register Client</a>
//             </div>
//         </div>
//     </li>

echo '</ul>';
