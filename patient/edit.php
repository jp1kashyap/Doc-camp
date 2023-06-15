<?php include '../includes/header-main.php'; 
include '../classes/Patient.php';
include '../classes/Camp.php';
include '../validation/DataValidator.php';
$patient=new Patient();
$camp = new Camp();
$validate = new Data_Validator();
$errors=[];
$success=false;
$data=[];
if(isset($_REQUEST['id']) && isset($_REQUEST['isEdit'])){
    $row = $patient->edit($_REQUEST['id']);
    if(!isset($row['error'])){
        $data = $row;
    }
}
if(isset($_POST['update'])){
    $validate->set('name',$_POST['name'])->is_required()->min_length(3);
    $validate->set('age',$_POST['age'])->is_required()->min_length(1);		
    $validate->set('sex',$_POST['sex'])->is_required()->min_length(3);		
    $validate->set('address',$_POST['address'])->is_required()->min_length(3);		
    $validate->set('disease',isset($_POST['disease'])?$_POST['disease']:'')->is_required()->min_length(2);		
    //$validate->set('other_disease',$_POST['other_disease'])->is_required()->min_length(3);				
    if($validate->validate()){
        if($result=$patient->update()){
            $success=true;
            echo("<script>window.location.href = '".BASE_URL."patient/questions.php?page=1&patient=".$_REQUEST['id']."';</script>");
        }
    } else {
        $errors = $validate->get_errors();
    }
}
$camps = $camp->list();
?>
<link rel="stylesheet" href="<?=BASE_URL?>assets/css/flatpickr.min.css">
<script src="<?=BASE_URL?>assets/js/flatpickr.js"></script>
<div >
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="javascript:;" class="text-primary hover:underline">Patient</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Edit</span>
        </li>
    </ul>

    <div class="pt-5">

        <div class="grid grid-cols-1 gap-6 pt-8 lg:grid-cols-2 center-form">
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Edit Patient</h5>
                </div>
                <div class="mb-8">
                    <form method="post" action="">
                    <div>
                        <label for="camp">Camp</label>
                        <select name="camp_id" class="form-input">
                            <option value="">--Select--</option>
                            <?php foreach ($camps as $camp) { ?>
                            <option value="<?=$camp[0]?>" <?= isset($data['camp_id']) && $data['camp_id'] == $camp[0] ? 'selected' : '' ?>><?=$camp[1]?></option>
                            <?php } ?>
                        </select>
                        <?php if(isset($errors['sex'])){?><label class="text-danger"><?=$errors['sex'][0]?></label><?php } ?>
                    </div>
                    <div>
                        <label for="name">Patient Name</label>
                        <input id="name" name="name" type="text" placeholder="Enter Patient Name " value="<?=isset($data['name'])?$data['name']:''?>" class="form-input" />
                        <?php if(isset($errors['name'])){?><label class="text-danger"><?=$errors['name'][0]?></label><?php } ?>
                    </div>
                    <div>
                        <label for="age">Age</label>
                        <input id="age" name="age" type="number" step="1" placeholder="Enter Age " value="<?=isset($data['age'])?$data['age']:''?>" class="form-input" />
                        <?php if(isset($errors['age'])){?><label class="text-danger"><?=$errors['age'][0]?></label><?php } ?>
                    </div>
                    <div>
                        <label for="sex">Sex</label>
                        <select name="sex" class="form-input">
                            <option value="">--Select--</option>
                            <option value="Male" <?=isset($data['sex']) && $data['sex']=='Male'?'selected':''?>>Male</option>
                            <option value="Female" <?=isset($data['sex']) && $data['sex']=='Female'?'selected':''?>>Female</option>
                        </select>
                        <?php if(isset($errors['sex'])){?><label class="text-danger"><?=$errors['sex'][0]?></label><?php } ?>
                    </div>
                    <div>
                        <label for="address">Address</label>
                        <textarea name="address" id="address" class="form-textarea" rows="4" placeholder="Enter Patient Address"><?=isset($data['address'])?$data['address']:''?></textarea>
                        <?php if(isset($errors['address'])){?><label class="text-danger"><?=$errors['address'][0]?></label><?php } ?>
                    </div>
                    <div>
                        <label for="disease">Disease</label>

                        <div>
                            <label class="flex items-center cursor-pointer">
                            <input id="hypertension" name="disease" type="radio" onchange="checkSelectedDisease(this);" class="form-radio" value="Hypertension" <?=isset($data['disease']) && $data['disease']=='Hypertension'?'checked':''?>  />
                                <span class="text-white-dark">Hypertension</span>
                            </label>
                        </div>
                        <div>
                            <label class="flex items-center cursor-pointer">
                            <input id="diabetes" name="disease" type="radio" class="form-radio" onchange="checkSelectedDisease(this);" value="diabetes" <?=isset($data['disease'])&& $data['disease']=='Diabetes'?'checked':''?>  />
                                <span class="text-white-dark">Diabetes</span>
                            </label>
                        </div>
                        <div>
                            <label class="flex items-center cursor-pointer">
                            <input id="other" name="disease" type="radio" class="form-radio" onchange="checkSelectedDisease(this);" value="Other" <?=isset($data['disease'])  && $data['disease']=='Other'?'checked':''?>  />
                                <span class="text-white-dark">Other</span>
                            </label>
                        </div>
                        <?php if(isset($errors['disease'])){?><label class="text-danger"><?=$errors['disease'][0]?></label><?php } ?>
                        
                    </div>
                    <div id="other_disease_div" style="display:<?=isset($_POST['data']) && $data['disease']=='Other'?:'block'?>none;">
                        <label for="other_disease">Other Disease</label>
                        <input id="other_disease" name="other_disease" type="text" step="1" placeholder="Enter Other Disease " value="<?=isset($data['other_disease']) ?$data['other_disease']:''?>" class="form-input" />
                        <?php if(isset($errors['other_disease'])){?><label class="text-danger"><?=$errors['other_disease'][0]?></label><?php } ?>
                    </div>
                    <input type="hidden" name="update" value="update" />
                    <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
                    <button type="submit" class="btn btn-primary mt-6">Update Patient Details</button>
                    </form>
                    <?php if($success) { ?>
                        <div class="flex items-center p-3.5 rounded text-success bg-success-light dark:bg-success-dark-light">
                                <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Success!</strong>Patient updated Successfully.</span>
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

    function checkSelectedDisease(myRadio){
        const value=myRadio.value;
        if(value=='Other'){
            document.getElementById('other_disease_div').style.display='block';
        }else{
            document.getElementById('other_disease_div').style.display='none';
        }
    }
</script>
<?php include '../includes/footer-main.php'; ?>
