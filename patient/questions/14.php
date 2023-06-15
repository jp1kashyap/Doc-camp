<div class="mb-8">
    <label for="q-14">Q.No. 6- During the past month how often have you taken medicine (prescribed or “over the counter”) to help you sleep?</label>
    <input type="hidden" name="question" value="6"/>
    <select id="q-14" name="answer" class="form-input">
        <option value="">-- Select --</option>
        <option value="1" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='1'?"selected":""?>>1</option>
        <option value="2" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='2'?"selected":""?>>2</option>
        <option value="3" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='3'?"selected":""?>>3</option>
    </select>
    <?php if(isset($errors['q-14'])){?><label class="text-danger"><?=$errors['q-14'][0]?></label><?php } ?>
</div>