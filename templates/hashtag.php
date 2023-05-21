<?php
    require_once(dirname(__DIR__) . "/templates/profile.php");
    require_once(dirname(__DIR__) . "/classes/hashtag.php");
    function _drawHashtag(Hashtag $hashtag, ?string $selected=null) {
?>
    <option value='<?=htmlentities($hashtag->id)?>' <?php if ($selected !== null && $selected === $hashtag->value) { ?> selected <?php } ?>> <?=htmlentities($hashtag->value)?></option>
<?php
    }

    function drawHashtags(array $hashtags, ?string $selected=null) {
?>
<select name="hashtag">
    <?php
    foreach ($hashtags as $hashtag) {
        _drawHashtag($hashtag, $selected);
    }
    ?>
</select>
<?php
    }

    function _drawHashtagTableItem(Hashtag $hashtag) {
?>
        <tr class="hashtag-item">
            <td class="hashtag-id"><?=htmlentities($hashtag->id); ?></td>
            <td class="hashtag-value"><?=htmlentities($hashtag->value); ?></td>
        </tr>
<?php
    }
    function drawHashtagTable(array $hashtags) {
?>
<div class="scroll-wrapper">
    <table id="hashtags">
        <thead>
            <tr>
                <th style="width: 0;">Id</th>
                <th>Hashtag</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($hashtags as $hashtag) _drawHashtagTableItem($hashtag); ?>
        </tbody>
    </table>
</div>
<?php
    }
?>