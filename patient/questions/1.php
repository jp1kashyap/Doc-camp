<div class="mb-8" x-data="form">
    <label for="q-1">Q.No. 1- When have you usually gone to bed?</label>
    <input type="hidden" name="question" value="1"/>
    <input id="q-1" name="answer" x-model="date2" type="text" placeholder="Select Time " value="" class="form-input" />
    <?php if(isset($errors['answer'])){?><label class="text-danger"><?=$errors['answer'][0]?></label><?php } ?>
</div>
<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("form", () => ({
            date2: '<?=isset($oldAnswer['answer'])?$oldAnswer['answer']:"12:00"?>',
            init() {
                flatpickr(document.getElementById('q-1'), {
                    defaultDate: this.date2,
                    noCalendar: true,
                    enableTime: true,
                    dateFormat: 'H:i'
                })
            }
        }));
    });
</script>