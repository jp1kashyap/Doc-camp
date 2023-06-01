<?php
if(isset($_SESSION['id'])){
    echo("<script>location.href = '".BASE_URL."index.php';</script>");
}
ini_set('default_charset','UTF-8');
include 'includes/header-main-auth.php';
include 'classes/MR.php';
include 'validation/DataValidator.php';

$mr=new MR();
$validate = new Data_Validator();
$errors=[];
$success=false;
if(isset($_POST['signup'])) {
    $validate->set('code',$_POST['code'])->is_required()->min_length(3);
    $validate->set('name',$_POST['name'])->is_required()->min_length(3);		
    $validate->set('reporting',$_POST['reporting'])->is_required()->min_length(3);		
    $validate->set('manager',$_POST['manager'])->is_required()->min_length(3);		
    $validate->set('state',$_POST['state'])->is_required()->min_length(3);		
    $validate->set('region',$_POST['region'])->is_required()->min_length(3);
    if($validate->validate()){
        $ExistCount=$mr->checkCodeExist($_POST['code']);
        if($ExistCount<1){
            if($mr->signup()){ 
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

<div class="flex justify-center items-center min-h-screen bg-[url('/assets/images/map.svg')] dark:bg-[url('/assets/images/map-dark.svg')] bg-cover bg-center">
    <div class="panel sm:w-[480px] m-6 max-w-lg w-full">
        <h2 class="font-bold text-2xl mb-3">MR Form</h2>
        <p class="mb-7">Enter your email and password to register</p>
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
            <input type="hidden" name="signup" value="signup"/>
            <button type="submit" class="btn btn-primary w-full">Submit</button>
            <?php if($success) { ?>
                <div class="flex items-center p-3.5 rounded text-success bg-success-light dark:bg-success-dark-light">
                        <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Success!</strong>MR Registration Successful.</span>
                    </div>
            <?php } ?>
            <?php if($loggedout) { ?>
            <div class="flex items-center p-3.5 rounded text-info bg-info-light dark:bg-info-dark-light">
                    <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Logged Out!</strong>Please login to continue.</span>
                </div>
            <?php } ?>
        </form>
        <div class="relative my-7 h-5 text-center before:w-full before:h-[1px] before:absolute before:inset-0 before:m-auto before:bg-[#ebedf2] dark:before:bg-[#253b5c]">
            <div class="font-bold text-white-dark bg-white dark:bg-[#0e1726] px-2 relative z-[1] inline-block"><span></span></div>
        </div>
        <p class="text-center">Already have an account ? <a href="<?=BASE_URL?>signin.php" class="text-primary font-bold hover:underline">Sign In</a></p>
    </div>
</div>
<?php include 'includes/footer-main-auth.php'; ?>