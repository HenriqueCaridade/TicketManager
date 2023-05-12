<?php
    function drawFAQ(string $question, string $answer) {
?>
<div class="faq-item faq-collapsed">
    <button class="faq-question"><?=htmlentities($question)?></button>
    <div class="faq-answer-block">
        <div class="faq-answer">
            <?=htmlentities($answer)?>
        </div>
    </div>
</div>
<?php
    }
?>