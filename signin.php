<?php
include 'includes/header-main-auth.php';
include 'classes/MR.php';
include 'validation/DataValidator.php';

$mr=new MR();
$validate = new Data_Validator();
$errors=[];
$success=false;
if(isset($_POST['signin'])){
    $validate->set('code',$_POST['code'])->is_required()->min_length(3);
    $validate->set('password',$_POST['password'])->is_required()->min_length(3);		
    if($validate->validate()){
        $ExistCount=$mr->checkCodeExist($_POST['code']);
        $result=$mr->signin();
        if(isset($result['error'])){
            $errors['message'][0]='Invalid code or password';
        }else{
            $_SESSION['id']=$result['id'];
            $_SESSION['name']=$result['name'];
            $success=true;
            echo("<script>setTimeout(()=>{location.href = '".BASE_URL."index.php';},1000)</script>");
        }
    } else {
        $errors = $validate->get_errors();
    }
}
?>

<div class="flex justify-center items-center min-h-screen bg-[url('/assets/images/map.svg')] dark:bg-[url('/assets/images/map-dark.svg')] bg-cover bg-center">
    <div class="panel sm:w-[480px] m-6 max-w-lg w-full">
        <h2 class="font-bold text-2xl mb-3">Sign In</h2>
        <p class="mb-7">Enter your email and password to login</p>
        <form class="space-y-5" method="post" action="<?=BASE_URL?>signin.php">
            <div>
                <label for="code">Code</label>
                <input id="code" name="code" type="textRegistration Successful" class="form-input" placeholder="Enter Code" value="<?=isset($_POST['code']) && !$success?$_POST['code']:''?>" />
                <?php if(isset($errors['code'])){?><label class="text-danger"><?=$errors['code'][0]?></label><?php } ?>
            </div>
            <div>
                <label for="password">Password</label>
                <input id="password" name="password" type="password" class="form-input" placeholder="Enter Password" />
                <?php if(isset($errors['password'])){?><label class="text-danger"><?=$errors['password'][0]?></label><?php } ?>
            </div>
            <input type="hidden" name="signin" value="signin"/>
            <button type="submit" class="btn btn-primary w-full">SIGN IN</button>
            <?php if(isset($errors['message'])) { ?>
                <div class="flex items-center p-3.5 rounded text-danger bg-danger-light dark:bg-danger-dark-light">
                        <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Oops!</strong><?=$errors['message'][0]?></span>
                    </div>
            <?php } ?>
            <?php if($success) { ?>
                <div class="flex items-center p-3.5 rounded text-success bg-success-light dark:bg-success-dark-light">
                        <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Success!</strong>MR Logged In Successful.</span>
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
        <p class="text-center">Dont't have an account ? <a href="<?=BASE_URL?>signup.php" class="text-primary font-bold hover:underline">Sign Up</a></p>
    </div>
</div>
<?php include 'includes/footer-main-auth.php'; ?>