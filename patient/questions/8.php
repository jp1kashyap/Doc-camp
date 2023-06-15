<div class="mb-8">
    <h5>Q.No. 5- During the past month, how often have you had trouble sleeping because you</h5>
    <label for="q-8">d.	Cannot breathe comfortably</label>
    <input type="hidden" name="question" value="5-d"/>
    <select id="q-8" name="answer" class="form-input">
        <option value="">-- Select --</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
    </select>
    <?php if(isset($errors['q-8'])){?><label class="text-danger"><?=$errors['q-8'][0]?></label><?php } ?>
</div>