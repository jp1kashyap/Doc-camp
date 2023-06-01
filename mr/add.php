<?php include '../includes/header-main.php'; 
include '../includes/admin-head.php'; 
include '../classes/MR.php';
include '../validation/DataValidator.php';
$mr=new MR();
$validate = new Data_Validator();
$errors=[];
$success=false;
if(isset($_POST['add'])) {
    $validate->set('code',$_POST['code'])->is_required()->min_length(3);
    $validate->set('name',$_POST['name'])->is_required()->min_length(3);		
    $validate->set('reporting',$_POST['reporting'])->is_required()->min_length(3);		
    $validate->set('manager',$_POST['manager'])->is_required()->min_length(3);		
    $validate->set('state',$_POST['state'])->is_required()->min_length(3);		
    $validate->set('region',$_POST['region'])->is_required()->min_length(3);
    if($validate->validate()){
        $ExistCount=$mr->checkCodeExist($_POST['code']);
        if($ExistCount<1){
            if($mr->add()){ 
                $success=true;
            }
        }else{
            $errors['code'][0]='MR Code Already Exist';
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
            <a href="javascript:;" class="text-primary hover:underline">MR</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Add</span>
        </li>
    </ul>

    <div class="pt-5">

        <div class="grid grid-cols-1 gap-6 pt-8 lg:grid-cols-2 center-form">
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Add MR</h5>
                </div>
                <div class="mb-8">
                            <form class="space-y-5" action="" method="post" >
                        <div>
                            <label for="code">Code</label>
                            <input id="code" name="code" type="text" class="form-input" placeholder="Enter Code" value="<?=isset($_POST['code']) && !$success?$_POST['code']:''?>" />
                            <?php if(isset($errors['code'])){?><label class="text-danger"><?=$errors['code'][0]?></label><?php } ?>
                        </div>
                        <div>
                            <label for="name">Name</label>
                            <input id="name" name="name" type="text" class="form-input" placeholder="Enter Name" value="<?=isset($_POST['name'])  && !$success?$_POST['name']:''?>" />
                            <?php if(isset($errors['name'])){?><label class="text-danger"><?=$errors['name'][0]?></label><?php } ?>
                        </div>
                        <div>
                            <label for="password">HQ Reporting</label>
                            <input id="reporting" name="reporting" type="text" class="form-input" placeholder="Enter HQ Reporting" value="<?=isset($_POST['reporting'])  && !$success?$_POST['reporting']:''?>" />
                            <?php if(isset($errors['reporting'])){?><label class="text-danger"><?=$errors['reporting'][0]?></label><?php } ?>
                        </div>
                        <div>
                            <label for="manager">Manager Name</label>
                            <input id="manager" name="manager" type="text" class="form-input" placeholder="Enter Manager Name" value="<?=isset($_POST['manager'])  && !$success?$_POST['manager']:''?>" />
                            <?php if(isset($errors['manager'])){?><label class="text-danger"><?=$errors['manager'][0]?></label><?php } ?>
                        </div>
                        <div>
                            <label for="state">State</label>
                            <input id="state" name="state" type="text" class="form-input" placeholder="Enter State" value="<?=isset($_POST['state'])  && !$success?$_POST['state']:''?>" />
                            <?php if(isset($errors['state'])){?><label class="text-danger"><?=$errors['state'][0]?></label><?php } ?>
                        </div>
                        <div>
                            <label for="region">Region</label>
                            <input id="region" name="region" type="text" class="form-input" placeholder="Enter Region" value="<?=isset($_POST['region'])  && !$success?$_POST['region']:''?>" />
                            <?php if(isset($errors['region'])){?><label class="text-danger"><?=$errors['region'][0]?></label><?php } ?>
                        </div>
                        <input type="hidden" name="add" value="add"/>
                        <button type="submit" class="btn btn-primary w-full">Submit</button>
                    </form>
                    <?php if($success) { ?>
                        <div class="flex items-center p-3.5 rounded text-success bg-success-light dark:bg-success-dark-light">
                                <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Success!</strong>MR Added Successfully.</span>
                            </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer-main.php'; ?>
