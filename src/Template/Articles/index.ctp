<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Articles Index</title>
    </head>
    <body>

        <!-- File: src/Template/Articles/index.ctp (delete links added) -->

        <h1>Blog articles</h1>
        <p><?= $this->Html->link('Add Article', ['action' => 'add']) ?></p>
        <table>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>

            <!-- Here's where we loop through our $articles query object, printing out article info -->

            <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?= $article->id ?></td>
                        <td>
                    <?= $this->Html->link($article->title, ['action' => 'view', $article->id]) ?>
                        </td>
                        <td>
                    <?= $article->created->format(DATE_RFC850) ?>
                        </td>
                        <td>
                    <?= $this->Form->postLink(
                        'Delete',
                        ['action' => 'delete', $article->id],
                        ['confirm' => 'Are you sure?'])
                    ?>
                    <?= $this->Html->link('Edit', ['action' => 'edit', $article->id]) ?>
                        </td>
                    </tr>
            <?php endforeach; ?>

        </table>

    </body>
</html>
