<?php include '../includes/header-main.php'; 
include '../classes/Questions.php';
include '../validation/DataValidator.php';
$question=new Questions();
$validate = new Data_Validator();
$errors=[];
$success=false;
$patientId = isset($_REQUEST['patient'])?$_REQUEST['patient']:null;
$totalScore = 0;
$totalCalculated = false;
if(!$patientId){
    echo("<script>setTimeout(()=>{location.href = '".BASE_URL."patient/list.php';},200)</script>");
}
$questions = $question->calculateScore($patientId);
?>
<link rel="stylesheet" href="<?=BASE_URL?>assets/css/flatpickr.min.css">
<style>
    table.table-bordered tbody tr td, table.table-bordered thead tr th{
        border-color: #131313 !important;
    }
</style>
<script src="<?=BASE_URL?>assets/js/flatpickr.js"></script>
<div >
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="javascript:;" class="text-primary hover:underline">Patient</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Score</span>
        </li>
    </ul>

    <div class="pt-5">

        <div class="grid grid-cols-1 gap-6 pt-8 lg:grid-cols-1">
            <div class="panel">
                <div class=" text-center">
                    <h1 style="font-size:24px;font-weight:700;" class="">The Pittsburgh Sleep Quality Index (PSQI)</h2>
                    <hr style="margin-top:20px"/>
                </div>
                <div class="mb-12" style="margin-top:20px">
                    <p>Instructions: The following questions relate to your usual sleep habits during the past month only. Your answers should indicate the</p>
                    <table class=" table-bordered">
                        <tr>
                            <td>1. When have you usually gone to bed?</td>
                            <td colspan="4"><?=isset($questions[0])?$questions[0]['answer']:""?></td>
                        </tr>
                        <tr>
                            <td>2. How long (in minutes) has it taken you to fall asleep each night?</td>
                            <td colspan="4"><?=isset($questions[1])?$questions[1]['answer']:""?></td>
                        </tr>
                        <tr>
                            <td>3. When have you usually gotten up in the morning?</td>
                            <td colspan="4"><?=isset($questions[2])?$questions[2]['answer']:""?></td>
                        </tr>
                        <tr>
                            <td>4. How many hours of actual sleep do you get at night?</td>
                            <td colspan="4"><?=isset($questions[3])?$questions[3]['answer']:""?></td>
                        </tr>
                        <tr>
                            <td>5. During the past month, how often have you had trouble sleeping because you</td>
                            <td> <strong> Not during the past month</strong></td>
                            <td><strong>Less then once a week</strong></td>
                            <td><strong>Once or twice a week</strong></td>
                            <td><strong>Three or more times week</strong></td>
                        </tr>
                        <tr>
                            <td><label style="margin-left:20px;">a. Cannot get to sleep within 30 minutes</label></td>
                            <td><?php if (isset($questions[4]) && $questions[4]['answer'] == 'Not during the past month'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[4]) && $questions[4]['answer'] == 'Less then once a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[4]) && $questions[4]['answer'] == 'Once or twice a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[4]) && $questions[4]['answer'] == 'Three or more times week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                        </tr>
                        <tr>
                            <td><label style="margin-left:20px;">b. Wake up in the middle of the night or early morning</label></td>
                            <td><?php if (isset($questions[5]) && $questions[5]['answer'] == 'Not during the past month'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[5]) && $questions[5]['answer'] == 'Less then once a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[5]) && $questions[5]['answer'] == 'Once or twice a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[5]) && $questions[5]['answer'] == 'Three or more times week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                        </tr>
                        <tr>
                            <td><label style="margin-left:20px;">c. Have to get up to use the bathroom</label></td>
                            <td><?php if (isset($questions[6]) && $questions[6]['answer'] == 'Not during the past month'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[6]) && $questions[6]['answer'] == 'Less then once a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[6]) && $questions[6]['answer'] == 'Once or twice a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[6]) && $questions[6]['answer'] == 'Three or more times week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                        </tr>
                        <tr>
                            <td><label style="margin-left:20px;">d. Cannot breathe comfortably</label></td>
                            <td><?php if (isset($questions[7]) && $questions[7]['answer'] == 'Not during the past month'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[7]) && $questions[7]['answer'] == 'Less then once a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[7]) && $questions[7]['answer'] == 'Once or twice a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[7]) && $questions[7]['answer'] == 'Three or more times week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                        </tr>
                        <tr>
                            <td><label style="margin-left:20px;">e. Cough or snore loudly</label></td>
                            <td><?php if (isset($questions[8]) && $questions[8]['answer'] == 'Not during the past month'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[8]) && $questions[8]['answer'] == 'Less then once a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[8]) && $questions[8]['answer'] == 'Once or twice a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[8]) && $questions[8]['answer'] == 'Three or more times week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                        </tr>
                        <tr>
                            <td><label style="margin-left:20px;">f. Feel too cold</label></td>
                            <td><?php if (isset($questions[9]) && $questions[9]['answer'] == 'Not during the past month'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[9]) && $questions[9]['answer'] == 'Less then once a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[9]) && $questions[9]['answer'] == 'Once or twice a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[9]) && $questions[9]['answer'] == 'Three or more times week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                        </tr>
                        <tr>
                            <td><label style="margin-left:20px;">g. Feel too hot</label></td>
                            <td><?php if (isset($questions[10]) && $questions[10]['answer'] == 'Not during the past month'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[10]) && $questions[10]['answer'] == 'Less then once a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[10]) && $questions[10]['answer'] == 'Once or twice a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[10]) && $questions[10]['answer'] == 'Three or more times week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                        </tr>
                        <tr>
                            <td><label style="margin-left:20px;">h. Have bad dreams</label></td>
                            <td><?php if (isset($questions[11]) && $questions[11]['answer'] == 'Not during the past month'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[11]) && $questions[11]['answer'] == 'Less then once a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[11]) && $questions[11]['answer'] == 'Once or twice a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[11]) && $questions[11]['answer'] == 'Three or more times week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                        </tr>
                        <tr>
                            <td><label style="margin-left:20px;">h. Have pain</label></td>
                            <td><?php if (isset($questions[12]) && $questions[12]['answer'] == 'Not during the past month'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[12]) && $questions[12]['answer'] == 'Less then once a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[12]) && $questions[12]['answer'] == 'Once or twice a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[12]) && $questions[12]['answer'] == 'Three or more times week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                        </tr>
                        <tr>
                            <td>6. During the past month how often have you taken medicine (prescribed or “over the counter”) to help you sleep?</td>
                            <td><?php if (isset($questions[13]) && $questions[13]['answer'] == 'Not during the past month'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[13]) && $questions[13]['answer'] == 'Less then once a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[13]) && $questions[13]['answer'] == 'Once or twice a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[13]) && $questions[13]['answer'] == 'Three or more times week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                        </tr>
                        <tr>
                            <td>7. During the past month how often have you had trouble staying awake while driving, eating meals, or engaging in social activity?</td>
                            <td><?php if (isset($questions[14]) && $questions[14]['answer'] == 'Not during the past month'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[14]) && $questions[14]['answer'] == 'Less then once a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[14]) && $questions[14]['answer'] == 'Once or twice a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[14]) && $questions[14]['answer'] == 'Three or more times week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                        </tr>
                        <tr>
                            <td>8. During the past month how much of a problem has it been for you to keep up enthusiasm to get things done?</td>
                            <td><?php if (isset($questions[15]) && $questions[15]['answer'] == 'Not during the past month'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[15]) && $questions[15]['answer'] == 'Less then once a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[15]) && $questions[15]['answer'] == 'Once or twice a week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[15]) && $questions[15]['answer'] == 'Three or more times week'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><strong>Very Good</strong></td>
                            <td><strong>Fairly Good</strong></td>
                            <td><strong>Fairly Bad</strong></td>
                            <td><strong>Very Bad</strong></td>
                        </tr>
                        <tr>
                            <td>9. During the past month how would you rate your sleep quality overall</td>
                            <td><?php if (isset($questions[16]) && $questions[16]['answer'] == 'Very Good'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[16]) && $questions[16]['answer'] == 'Fairly Good'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[16]) && $questions[16]['answer'] == 'Fairly bad'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                            <td><?php if (isset($questions[16]) && $questions[16]['answer'] == 'Very bad'): ?><input type="checkbox" checked readonly /><?php endif; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer-main.php'; ?>
