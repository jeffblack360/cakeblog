<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header>
        <div class="header-title">
            <span><?= $this->fetch('title') ?></span>
        </div>
        <div class="header-help">
            <span><?= $this->Html->link('Home', ['_name' => 'home']) ?></span>
            <span><?= $this->Html->link('Cats', ['controller' => 'Cats', 'action' => 'index']) ?></span>
            <span><?= $this->Html->link('Users', ['controller' => 'Users', 'action' => 'index']) ?></span>
            <span><?= $this->Html->link('Articles', ['controller' => 'Articles', 'action' => 'index']) ?></span>
            <span><?= $this->Html->link('Categories', ['controller' => 'Categories', 'action' => 'index']) ?></span>
            <?php if (!$authUser): ?>
                <span><?= $this->Html->link('Login', ['_name' => 'login']) ?></span>
            <?php else: ?>
                <span><?= $this->Html->link('Logout', ['_name' => 'logout']) ?></span>
            <?php endif; ?>
        </div>
    </header>
    <div id="container">

        <div id="content">
            <?= $this->Flash->render() ?>

            <div class="row">
                <?= $this->fetch('content') ?>
            </div>
        </div>
        <footer>
        </footer>
    </div>
    <!-- JavaScript Files Here -->
    <script type="text/javascript" src="/js/knockout-2.1.0.debug.js"></script>
    <script type="text/javascript" src="/js/App.js"></script>
</body>
</html>
