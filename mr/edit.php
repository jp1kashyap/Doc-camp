<?php include '../includes/header-main.php'; 
include '../includes/admin-head.php'; 
include '../classes/MR.php';
include '../validation/DataValidator.php';
$mr=new MR();
$validate = new Data_Validator();
$errors=[];
$success=false;
$data=[];
if(isset($_REQUEST['id']) && isset($_REQUEST['isEdit'])){
    $row = $mr->edit($_REQUEST['id']);
    if(!isset($row['error'])){
        $data = $row;
    }
}
if(isset($_POST['update'])){
    $validate->set('code',$_POST['code'])->is_required()->min_length(3);
    $validate->set('name',$_POST['name'])->is_required()->min_length(3);		
    $validate->set('reporting',$_POST['reporting'])->is_required()->min_length(3);		
    $validate->set('manager',$_POST['manager'])->is_required()->min_length(3);		
    $validate->set('state',$_POST['state'])->is_required()->min_length(3);		
    $validate->set('region',$_POST['region'])->is_required()->min_length(3);		
    //$validate->set('other_disease',$_POST['other_disease'])->is_required()->min_length(3);				
    if($validate->validate()){
        if($result=$mr->update()){
            $success=true;
            echo("<script>setTimeout(()=>{location.href = '".BASE_URL."mr/list.php';},1000)</script>");
        }
    } else {
        $errors = $validate->get_errors();
        print_r($errors);
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

                <form class="space-y-5" action="" method="post" >
                        <div>
                            <label for="code">Code</label>
                            <input id="code" name="code" type="text" class="form-input" placeholder="Enter Code" value="<?=isset($data['code'])?$data['code']:''?>" />
                            <?php if(isset($errors['code'])){?><label class="text-danger"><?=$errors['code'][0]?></label><?php } ?>
                        </div>
                        <div>
                            <label for="name">Name</label>
                            <input id="name" name="name" type="text" class="form-input" placeholder="Enter Name" value="<?=isset($data['name'])  ?$data['name']:''?>" />
                            <?php if(isset($errors['name'])){?><label class="text-danger"><?=$errors['name'][0]?></label><?php } ?>
                        </div>
                        <div>
                            <label for="password">HQ Reporting</label>
                            <input id="reporting" name="reporting" type="text" class="form-input" placeholder="Enter HQ Reporting" value="<?=isset($data['reporting'])  ?$data['reporting']:''?>" />
                            <?php if(isset($errors['reporting'])){?><label class="text-danger"><?=$errors['reporting'][0]?></label><?php } ?>
                        </div>
                        <div>
                            <label for="manager">Manager Name</label>
                            <input id="manager" name="manager" type="text" class="form-input" placeholder="Enter Manager Name" value="<?=isset($data['manager'])  ?$data['manager']:''?>" />
                            <?php if(isset($errors['manager'])){?><label class="text-danger"><?=$errors['manager'][0]?></label><?php } ?>
                        </div>
                        <div>
                            <label for="state">State</label>
                            <input id="state" name="state" type="text" class="form-input" placeholder="Enter State" value="<?=isset($data['state'])  ?$data['state']:''?>" />
                            <?php if(isset($errors['state'])){?><label class="text-danger"><?=$errors['state'][0]?></label><?php } ?>
                        </div>
                        <div>
                            <label for="region">Region</label>
                            <input id="region" name="region" type="text" class="form-input" placeholder="Enter Region" value="<?=isset($data['region'])  ?$data['region']:''?>" />
                            <?php if(isset($errors['region'])){?><label class="text-danger"><?=$errors['region'][0]?></label><?php } ?>
                        </div>
                        <input type="hidden" name="update" value="update" />
                        <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
                        <button type="submit" class="btn btn-primary mt-6">Submit</button>
                    </form>
                    <?php if($success) { ?>
                        <div class="flex items-center p-3.5 rounded text-success bg-success-light dark:bg-success-dark-light">
                                <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Success!</strong>MR Updated Successfully.</span>
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
