<?php
    require_once(dirname(__DIR__) . "/classes/faq.php");

    function drawFAQ(FAQ $faq) {
?>
<div id="<?=$faq->id?>" class="faq-item faq-collapsed">
    <button class="faq-question">
        #<?=$faq->id?>:
        <?=htmlentities($faq->question)?>
    </button>
    <div class="faq-answer-block">
        <div class="faq-answer">
            <?=htmlentities($faq->answer)?>
        </div>
    </div>
</div>
<?php
    }
    function _drawFAQ(FAQ $faq) {
    ?>
        <option value = '<?=htmlentities($faq->id)?>'> <?=htmlentities($faq->id)?></option>
    <?php
        }
    
        function _drawFAQs(array $faqs) {
    ?>
    <select name="faq">
        <?php
        foreach ($faqs as $faq) {
            _drawFAQ($faq);
        }
        ?>
    </select>
<?php
    }
?>