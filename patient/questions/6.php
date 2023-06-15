<div class="mb-8">
    <h5>Q.No. 5- During the past month, how often have you had trouble sleeping because you</h5>
    <label for="q-6"> b. Wake up in the middle of te night or early morning</label>
    <input type="hidden" name="question" value="5-b"/>
    <select id="q-6" name="answer" class="form-input">
        <option value="">-- Select --</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
    </select>
    <?php if(isset($errors['q-6'])){?><label class="text-danger"><?=$errors['q-6'][0]?></label><?php } ?>
</div>