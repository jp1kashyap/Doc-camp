<div class="mb-8">
    <label for="q-17">Q.No. 9- During the past month how would you rate your sleep quality overall</label>
    <input type="hidden" name="question" value="9"/>
    <select id="q-17" name="answer" class="form-input">
        <option value="">-- Select --</option>
        <option value="1" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='1'?"selected":""?>>1</option>
        <option value="2" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='2'?"selected":""?>>2</option>
        <option value="3" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='3'?"selected":""?>>3</option>
    </select>
    <?php if(isset($errors['q-17'])){?><label class="text-danger"><?=$errors['q-17'][0]?></label><?php } ?>
</div>