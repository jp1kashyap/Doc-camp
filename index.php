<?php include 'includes/header-main.php';
include 'classes/Patient.php';
include 'classes/Camp.php';
$patient=new Patient();
$camp = new Camp();
$patientResult = $patient->listForDashboard();
$campResult = $camp->listForDashboard();
?>
<div x-data="sales">
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="javascript:;" class="text-primary hover:underline">Dashboard</a>
        </li>
    </ul>

    <div class="pt-5">
        <div class="mb-6 grid grid-cols-1 gap-6 text-white sm:grid-cols-2 xl:grid-cols-4">
            <!-- Users Visit -->
            <div class="panel bg-gradient-to-r from-cyan-500 to-cyan-400">
                <div class="flex justify-between">
                    <div class="text-md font-semibold ltr:mr-1 rtl:ml-1">Patients Screened</div>
                </div>
                <div class="mt-5 flex items-center">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3"><?=count($patient->list())?></div>
                </div>
                <div class="mt-5 flex items-center" >
                    <a href="<?=BASE_URL?>patient/list.php" class="btn btn-danger">View Now</a>
                </div>
            </div>

            <!-- Sessions -->
            <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                <div class="flex justify-between">
                    <div class="text-md font-semibold ltr:mr-1 rtl:ml-1">Doctors Participated</div>
                    
                </div>
                <div class="mt-5 flex items-center">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3"><?=count($camp->list())?></div>
                </div>
                <div class="mt-5 flex items-center" >
                    <a href="<?=BASE_URL?>doctor/list.php" class="btn btn-warning">View Now</a>
                </div>
            </div>

            <!-- Time On-Site -->
            <div class="panel bg-gradient-to-r from-blue-500 to-blue-400">
                <div class="flex justify-between">
                    <div class="text-md font-semibold ltr:mr-1 rtl:ml-1">Patients with Hypertension with Insomnia</div>
                    
                </div>
                <div class="mt-5 flex items-center">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3"><?=count($patient->hyperTensionList())?></div>
                </div>
                <div class="mt-5 flex items-center" >
                    <a href="<?=BASE_URL?>patient/list.php?disease=Hypertension" class="btn btn-success">View Now</a>
                </div>
            </div>

            <!-- Bounce Rate -->
            <div class="panel bg-gradient-to-r from-fuchsia-500 to-fuchsia-400">
                <div class="flex justify-between">
                    <div class="text-md font-semibold ltr:mr-1 rtl:ml-1">Patients with Diabetes with Insomnia</div>
                </div>
                <div class="mt-5 flex items-center">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3"><?=count($patient->diabetesList())?></div>
                </div>
                <div class="mt-5 flex items-center" >
                    <a href="<?=BASE_URL?>patient/list.php?disease=Diabetes" class="btn btn-primary">View Now</a>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 grid-cols-1 gap-6">
            <div class="panel h-full w-full">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Recent Camps</h5>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th >Hospital</th>
                                <th>Location</th>
                                <th>Doctor</th>
                                <th>Doctor Code</th>
                                <th >Speciality</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($campResult as $campRow): ?>
                            <tr class="text-white-dark hover:text-black dark:hover:text-white-light/90 group">
                                <td><?=$campRow['hospital']?></td>
                                <td><?=$campRow['location']?></td>
                                <td><?=$campRow['doctor']?></td>
                                <td><?=$campRow['doctor_code']?></td>
                                <td><?=$campRow['speciality']?></td>
                                <td><?=$campRow['date']?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel h-full w-full">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Recent Patients</h5>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr class="border-b-0">
                                <th >Name</th>
                                <th>Age</th>
                                <th>Sex</th>
                                <th>Address</th>
                                <th>Disease</th>
                                <th>Hospital</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($patientResult as $patientRow): ?>
                            <tr class="text-white-dark hover:text-black dark:hover:text-white-light/90 group">
                                <td><?=$patientRow['name']?></td>
                                <td><?=$patientRow['age']?></td>
                                <td><?=$patientRow['sex']?></td>
                                <td><?=$patientRow['address']?></td>
                                <td><?=$patientRow['other_disease']?$patientRow['other_disease']:$patientRow['disease']?></td>
                                <td><?=$patientRow['hospital']?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer-main.php'; ?>
