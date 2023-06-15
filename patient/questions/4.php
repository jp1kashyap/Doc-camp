<div class="mb-8">
    <label for="q-4">Q.No. 4- How many hours of actual sleep do you get at night?</label>
    <input type="hidden" name="question" value="4"/>
    <select id="q-4" name="answer" class="form-input">
        <option value="">Select hours</option>
        <option value="1" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='1'?"selected":""?>>1</option>
        <option value="2" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='2'?"selected":""?>>2</option>
        <option value="3" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='3'?"selected":""?>>3</option>
        <option value="4" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='4'?"selected":""?>>4</option>
        <option value="5" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='5'?"selected":""?>>5</option>
        <option value="6" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='6'?"selected":""?>>6</option>
        <option value="7" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='7'?"selected":""?>>7</option>
        <option value="8" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='8'?"selected":""?>>8</option>
        <option value="9" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='9'?"selected":""?>>9</option>
        <option value="10" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='10'?"selected":""?>>10</option>
        <option value="11" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='11'?"selected":""?>>11</option>
        <option value="12" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='12'?"selected":""?>>12</option>
    </select>
    <?php if(isset($errors['q-4'])){?><label class="text-danger"><?=$errors['q-4'][0]?></label><?php } ?>
</div>