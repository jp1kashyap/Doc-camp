<div class="mb-8">
    <label for="q-15">Q.No. 7- During the past month how often have you had trouble staying awake while driving, eating meals, or engaging in social activity?</label>
    <input type="hidden" name="question" value="7"/>
    <select id="q-15" name="answer" class="form-input">
        <option value="">-- Select --</option>
        <option value="1" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='1'?"selected":""?>>1</option>
        <option value="2" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='2'?"selected":""?>>2</option>
        <option value="3" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='3'?"selected":""?>>3</option>
    </select>
    <?php if(isset($errors['q-15'])){?><label class="text-danger"><?=$errors['q-15'][0]?></label><?php } ?>
</div>