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
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
    <head>
    <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
        <?= $cakeDescription ?>
        </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    </head>
    <body class="home">

        <div id="content">
            <h1>Knockout.js</h1>
        </div>

        <div class='liveExample'>   
            <!-- This is a *view* - HTML markup that defines the appearance of your UI -->

            <p>First name: <strong data-bind="text: firstName"></strong></p>
            <p>Last name: <strong data-bind="text: lastName"></strong></p>

            <p>First name: <input data-bind="value: firstName" /></p>
            <p>Last name: <input data-bind="value: lastName" /></p>

            <p>Full name: <strong data-bind="text: fullName"></strong></p>

            <button data-bind="click: capitalizeLastName">Go caps</button>

        </div>

        <div class='liveExample2'>   
            <h2>Your seat reservations (<span data-bind="text: seats().length"></span>)</h2>

            <table>
                <thead><tr>
                        <th>Passenger name</th><th>Meal</th><th>Surcharge</th><th></th>
                    </tr></thead>
                <tbody data-bind="foreach: seats">
                    <tr>
                        <td><input data-bind="value: name" /></td>
                        <td><select data-bind="options: $root.availableMeals, value: meal, optionsText: 'mealName'"></select></td>
                        <td data-bind="text: formattedPrice"></td>
                        <td><a href="#" data-bind="click: $root.removeSeat">Remove</a></td>
                    </tr>    
                </tbody>
            </table>


            <button data-bind="click: addSeat, enable: seats().length < 5">Reserve another seat</button>

            <h3 data-bind="visible: totalSurcharge() > 0">
                Total surcharge: $<span data-bind="text: totalSurcharge().toFixed(2)"></span>
            </h3>

        </div>

        <!-- JavaScript Files Here -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.4.0/knockout-min.js"></script>
        <script type="text/javascript" src="/js/App.js"></script>
    </body>
</html>
