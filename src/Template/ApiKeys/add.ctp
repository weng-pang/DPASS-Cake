<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApiKey $apiKey
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Api Keys'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="apiKeys form large-9 medium-8 columns content">
    <?= $this->Form->create($apiKey) ?>
    <fieldset>
        <legend><?= __('Add Api Key') ?></legend>
        <?php
            echo $this->Form->control('key');
            echo $this->Form->control('expire');
            echo $this->Form->control('revoked');
            echo $this->Form->control('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
