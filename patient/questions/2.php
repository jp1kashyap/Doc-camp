<div class="mb-8">
    <label for="q-2">Q.No. 2- How long (in minutes) has it taken you to fall asleep each night?</label>
    <input type="hidden" name="question" value="2"/>
    <input id="q-2" name="answer" type="number" placeholder="Enter Minutes " step="1" max="59" min="0" value="" class="form-input" />
    <?php if(isset($errors['q-2'])){?><label class="text-danger"><?=$errors['q-2'][0]?></label><?php } ?>
</div>