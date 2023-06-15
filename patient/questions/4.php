<div class="mb-8">
    <label for="q-4">Q.No. 4- How many hours of actual sleep do you get at night?</label>
    <input type="hidden" name="question" value="4"/>
    <select id="q-4" name="answer" class="form-input">
        <option value="">Select hours</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
    </select>
    <?php if(isset($errors['q-4'])){?><label class="text-danger"><?=$errors['q-4'][0]?></label><?php } ?>
</div>