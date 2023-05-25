<?php include '../includes/header-main.php'; 
include '../classes/Camp.php';
include '../validation/DataValidator.php';
$camp=new Camp();
$validate = new Data_Validator();
$errors=[];
$success=false;
$data=[];
if(isset($_REQUEST['id']) && isset($_REQUEST['isEdit'])){
    $row = $camp->edit($_REQUEST['id']);
    if(!isset($row['error'])){
        $data = $row;
    }
}
if(isset($_POST['update'])){
    $validate->set('hospital',$_POST['hospital'])->is_required()->min_length(3);
    $validate->set('location',$_POST['location'])->is_required()->min_length(3);		
    $validate->set('doctor',$_POST['doctor'])->is_required()->min_length(3);		
    $validate->set('doctor_code',$_POST['doctor_code'])->is_required()->min_length(3);		
    $validate->set('speciality',$_POST['speciality'])->is_required()->min_length(2);		
    $validate->set('date',$_POST['date'])->is_required()->min_length(3);				
    if($validate->validate()){
        if($result=$camp->update()){
            $success=true;
            echo("<script>setTimeout(()=>{location.href = '".BASE_URL."camp/list.php';},1000)</script>");
        }
    } else {
        $errors = $validate->get_errors();
    }
}
?>
<link rel="stylesheet" href="<?=BASE_URL?>assets/css/flatpickr.min.css">
<script src="<?=BASE_URL?>assets/js/flatpickr.js"></script>
<div >
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="javascript:;" class="text-primary hover:underline">CAMP</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Edit</span>
        </li>
    </ul>

    <div class="pt-5">

        <div class="grid grid-cols-1 gap-6 pt-8 lg:grid-cols-2 center-form">
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Add Camp</h5>
                </div>
                <div class="mb-8">
                    <form method="post" action="">
                    <div>
                        <label for="hospital">Clinic/Hospital Name</label>
                        <input id="hospital" name="hospital" type="text" placeholder="Enter Clinic/Hospital " value="<?=isset($data['hospital'])?$data['hospital']:''?>" class="form-input" />
                        <?php if(isset($errors['hospital'])){?><label class="text-danger"><?=$errors['hospital'][0]?></label><?php } ?>
                    </div>
                    <div>
                        <label for="location">Area/Location</label>
                        <input id="location" name="location" type="text" placeholder="Enter Area/Location " value="<?=isset($data['location'])?$data['location']:''?>" class="form-input" />
                        <?php if(isset($errors['location'])){?><label class="text-danger"><?=$errors['location'][0]?></label><?php } ?>
                    </div>
                    <div>
                        <label for="doctor">Doctor Name</label>
                        <input id="doctor" name="doctor" type="text" placeholder="Enter Doctor Name " value="<?=isset($data['doctor'])?$data['doctor']:''?>" class="form-input" />
                        <?php if(isset($errors['doctor'])){?><label class="text-danger"><?=$errors['doctor'][0]?></label><?php } ?>
                    </div>
                    <div>
                        <label for="doctor_code">Doctor Code</label>
                        <input id="doctor_code" name="doctor_code" type="text" placeholder="Enter Doctor Code " value="<?=isset($data['doctor_code'])?$data['doctor_code']:''?>" class="form-input" />
                        <?php if(isset($errors['doctor_code'])){?><label class="text-danger"><?=$errors['doctor_code'][0]?></label><?php } ?>
                    </div>
                    <div>
                        <label for="speciality">Speciality</label>
                        <input id="speciality" name="speciality" type="text" placeholder="Enter Speciality " value="<?=isset($data['speciality'])?$data['speciality']:''?>" class="form-input" />
                        <?php if(isset($errors['speciality'])){?><label class="text-danger"><?=$errors['speciality'][0]?></label><?php } ?>
                    </div>
                    <div x-data="form">
                        <label for="date">Date Of Camp</label>
                        <input id="date" name="date" x-model="date" value="<?=isset($data['date'])?$data['date']:''?>" class="form-input" />
                        <?php if(isset($errors['date'])){?><label class="text-danger"><?=$errors['date'][0]?></label><?php } ?>
                    </div>
                    <input type="hidden" name="update" value="update" />
                    <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
                        <button type="submit" class="btn btn-primary mt-6">Submit</button>
                    </form>
                    <?php if($success) { ?>
                        <div class="flex items-center p-3.5 rounded text-success bg-success-light dark:bg-success-dark-light">
                                <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Success!</strong>Camp Updated Successfully.</span>
                            </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("form", () => ({
            date: new Date().toISOString().slice(0, 10),
            init() {
                flatpickr(document.getElementById('date'), {
                    dateFormat: 'Y-m-d',
                    defaultDate: this.date,
                })
            }
        }));
    });
</script>
<?php include '../includes/footer-main.php'; ?>
