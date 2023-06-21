<?php include '../includes/header-main.php'; 
include '../classes/Questions.php';
include '../validation/DataValidator.php';
$question=new Questions();
$validate = new Data_Validator();
$errors=[];
$success=false;
$page = isset($_REQUEST['page'])?$_REQUEST['page']:'1';
$patientId = isset($_REQUEST['patient'])?$_REQUEST['patient']:null;
$totalScore = 0;
$totalCalculated = false;
if(!$patientId){
    echo("<script>setTimeout(()=>{location.href = '".BASE_URL."patient/list.php';},200)</script>");
}
$oldAnswer = $question->edit($patientId, $page);
if (isset($_POST['add'])) {
    $validate->set('question',$_POST['question'])->is_required();
    $validate->set('answer',$_POST['answer'])->is_required();
    if($validate->validate()){
        $_POST['patient'] = $patientId;
        $_POST['question_id'] = $page;
        if (isset($oldAnswer['answer'])) {
            $question->update();
            $lastInsertedId = 1;
        }else{
            $lastInsertedId = $question->add();
        }
        if($lastInsertedId){
            $success = true;
            if($page=='17'){
                $totalCalculated=true;
                $totalScore = $question->calculateScore($patientId);
            }else{
                echo "<script> location.href='".BASE_URL."patient/questions.php?page=" . ($page + 1) . "&patient=" . $patientId . "';</script>";
            }
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
            <a href="javascript:;" class="text-primary hover:underline">Patient</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Questions</span>
        </li>
    </ul>

    <div class="pt-5">

        <div class="grid grid-cols-1 gap-6 pt-8 lg:grid-cols-2 center-form">
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Questions</h5>
                </div>
                <div class="mb-8">
                    <form method="post" action="">
                        <?php
                        include_once "questions/".$page.".php";
                        ?>
                        <input type="hidden" name="add" value="add" />
                        <button type="submit" class="btn btn-primary mt-6">Submit</button>
                    </form>
                    <?php if($success && $totalCalculated) { ?>
                        <script>setTimeout(()=>{
                            totalScore();
                        },500) </script>
                    <?php } ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function totalScore() {
        new window.swal({
            icon: 'success',
            title: 'Completed|',
            text: 'You have completed all questions and your score is <?=$totalScore?>/17',
            padding: '2em',
        }).then((result)=>{
            window.location.href='<?=BASE_URL?>patient/list.php';
        });
    }
    </script>
<?php include '../includes/footer-main.php'; ?>
