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
                <script>setTimeout(()=>{
                    loginFailed('<?=$errors['message'][0]?>');
                },500) </script>
            <?php } ?>
            <?php if($success) { ?>
                <script>setTimeout(()=>{
                    loginSuccess();
                },500) </script>
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
        <p class="text-center">Are you Admin ? <a href="<?=BASE_URL?>admin-login.php" class="text-primary font-bold hover:underline">Sign In Here</a></p>
    </div>
</div>
<script>
     function loginSuccess() {
        new window.swal({
            icon: 'success',
            title: 'Success!',
            text: 'MR Logged In Successful.',
            padding: '2em',
        }).then((result)=>{
            window.location.href='<?=BASE_URL?>index.php';
        });
    }
    function loginFailed(msg) {
        new window.swal({
            icon: 'error',
            title: 'Oops!',
            text: msg,
            padding: '2em',
        });
    }
</script>
<?php include 'includes/footer-main-auth.php'; ?>
