<div class="mb-8">
    <label for="q-17">Q.No. 9- During the past month how would you rate your sleep quality overall</label>
    <input type="hidden" name="question" value="9"/>
    <input type="hidden" name="score" value="<?=isset($oldAnswer['score'])?$oldAnswer['score']:"1"?>"/>
    <select id="q-17" name="answer" class="form-input" onchange="getScore(this)">
        <option value="">-- Select --</option>
        <option value="Very Good" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='Very Good'?"selected":""?>>Very Good</option>
        <option value="Fairly Good" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='Fairly Good'?"selected":""?>>Fairly Good</option>
        <option value="Fairly bad" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='Fairly bad'?"selected":""?>>Fairly bad</option>
        <option value="Very bad" <?=isset($oldAnswer['answer']) && $oldAnswer['answer']=='3'?"selected":""?>>Very bad</option>
    </select>
    <?php if(isset($errors['q-17'])){?><label class="text-danger"><?=$errors['q-17'][0]?></label><?php } ?>
</div>

<script>
    var scores=[];
    scores['Very Good']='0';
    scores['Fairly Good']='1';
    scores['Fairly bad']='2';
    scores['Very bad']='3';
    function getScore(selectObject) {
        var answer = selectObject.value; 
        if(answer){
            document.getElementsByName('score')[0].value=scores[answer];
        }else{
            document.getElementsByName('score')[0].value='';
        }
    }
</script>