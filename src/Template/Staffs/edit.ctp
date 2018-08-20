<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Staff $staff
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $staff->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $staff->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Staffs'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="staffs form large-9 medium-8 columns content">
    <?= $this->Form->create($staff) ?>
    <fieldset>
        <legend><?= __('Edit Staff') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('name2');
            echo $this->Form->control('checkin');
            echo $this->Form->control('checkout');
            echo $this->Form->control('lunch');
            echo $this->Form->control('overtime');
            echo $this->Form->control('repeatedrange');
            echo $this->Form->control('overtimeapproval');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
