<p>
    <strong>
        Riddle Webhook - <?php echo $riddle->getTitle(); ?> 
        (<?php echo $riddle->getTitle(); ?>)
    </strong>
</p>

<?php if ($riddle->getLead()): ?>
    <p><strong>Lead</strong></p>
    <?php foreach (get_object_vars($riddle->getLead()) as $_field => $_value): ?>
        <?php echo $_field; ?>: <?php echo $_value; ?><br />
    <?php endforeach; ?>
<?php endif; ?>

<?php if ($riddle->getAnswers()): ?>
    <?php $numberAnswers = count($riddle->getAnswers()); ?>
    <p><strong>Answers</strong></p>
    <?php foreach ($riddle->getAnswers() as $_k => $_answer): ?>
        <?php $_count = ($_k + 1) . '/' . $numberAnswers; ?>
        <p>
            Question <?php echo $_count; ?>: <?php echo $_answer->question; ?><br/>
            Answer: <?php echo $_answer->answer; ?><br/>
            Correct: <?php echo $_answer->correct ? 'Yes' : 'No'; ?>
        </p>
    <?php endforeach; ?>
<?php endif; ?>

<?php if ($riddle->getResultData()): ?>
    <p><strong>Result data</strong></p>
    <p>
        <?php foreach ($riddle->getResultData() as $_key => $_data): ?>
            <?php if (is_array($_data)): ?>
                <?php echo $_key; ?>: 
                <?php foreach ($_data as $__key => $__data): ?>
                    <br /><?php echo $__key; ?>: <?php echo $__data; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <?php echo $_key; ?>: <?php echo $_data; ?>
            <?php endif; ?>
            <br />
        <?php endforeach; ?>
    </p>
<?php endif;