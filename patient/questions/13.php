<div class="mb-8">
    <h5>Q.No. 5- During the past month, how often have you had trouble sleeping because you</h5>
    <label for="q-13">i. Have pain</label>
    <input type="hidden" name="question" value="5-i"/>
    <select id="q-13" name="answer" class="form-input">
        <option value="">-- Select --</option>
        <option value="Yes" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='Yes'?"selected":""?>>Yes</option>
        <option value="No" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='No'?"selected":""?>>No</option>
    </select>
    <?php if(isset($errors['q-13'])){?><label class="text-danger"><?=$errors['q-13'][0]?></label><?php } ?>
</div>