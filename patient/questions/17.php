<div class="mb-8">
    <label for="q-17">Q.No. 9- During the past month how would you rate your sleep quality overall</label>
    <input type="hidden" name="question" value="9"/>
    <select id="q-17" name="answer" class="form-input">
        <option value="">-- Select --</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
    <?php if(isset($errors['q-17'])){?><label class="text-danger"><?=$errors['q-17'][0]?></label><?php } ?>
</div>