<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List User'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="user view content">
            <h3><?= h($user->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($user->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($user->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created On') ?></th>
                    <td><?= h($user->created_on) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Daily Todo') ?></h4>
                <?php if (!empty($user->daily_todo)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Day Id') ?></th>
                            <th><?= __('Task') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Created On') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->daily_todo as $dailyTodo) : ?>
                        <tr>
                            <td><?= h($dailyTodo->id) ?></td>
                            <td><?= h($dailyTodo->day_id) ?></td>
                            <td><?= h($dailyTodo->task) ?></td>
                            <td><?= h($dailyTodo->user_id) ?></td>
                            <td><?= h($dailyTodo->created_on) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'DailyTodo', 'action' => 'view', $dailyTodo->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'DailyTodo', 'action' => 'edit', $dailyTodo->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'DailyTodo', 'action' => 'delete', $dailyTodo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dailyTodo->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
