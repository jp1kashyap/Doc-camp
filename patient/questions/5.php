<div class="mb-8">
    <h5>Q.No. 5- During the past month, how often have you had trouble sleeping because you</h5>
    <label for="q-5"> a. Cannot get to sleep within 30 minutes</label>
    <input type="hidden" name="question" value="5-a"/>
    <select id="q-5" name="answer" class="form-input">
        <option value="">-- Select --</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
    </select>
    <?php if(isset($errors['q-5'])){?><label class="text-danger"><?=$errors['q-5'][0]?></label><?php } ?>
</div>