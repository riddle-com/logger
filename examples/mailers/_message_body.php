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

<?php if ($riddle->getResult()): ?>        
    <p><strong>Result</strong></p>
    <?php echo $riddle->getResult(); ?>
<?php endif; ?>