<div class="mb-8">
    <h5>Q.No. 5- During the past month, how often have you had trouble sleeping because you</h5>
    <label for="q-12">h. Have bad dreams</label>
    <input type="hidden" name="question" value="5-h"/>
    <select id="q-12" name="answer" class="form-input">
        <option value="">-- Select --</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
    </select>
    <?php if(isset($errors['q-12'])){?><label class="text-danger"><?=$errors['q-12'][0]?></label><?php } ?>
</div>