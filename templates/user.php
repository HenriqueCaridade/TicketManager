<?php
    require_once(dirname(__DIR__) . "/templates/profile.php");

function _drawClient(User $client) { ?>
    <tr class="client">
        <td class="client-username"><?php drawProfile($client->username, true); ?></td>
        <td class="client-name"><?=htmlentities($client->name)?></td>
        <td class="client-email"><?=htmlentities($client->email)?></td>
        <td class="user-edit">
            <form class="user-page-form" action="./index.php" method="get">
                <input type="hidden" name="page" value="user">
                <input type="hidden" name="username" value="<?=$client->username?>">
                <button type='submit' class="user-page-submit">See User</button>
            </form>
        </td>
    </tr>
    
<?php
}

function _drawAgent(Agent $agent) { ?>
    <tr class="agent">
        <td class="agent-username"><?php drawProfile($agent->username, true); ?></td>
        <td class="agent-name"><?=htmlentities($agent->name)?></td>
        <td class="agent-email"><?=htmlentities($agent->email)?></td>
        <td class="agent-department"> <?= $agent->departmentString?> </td>
        <td class="user-edit">
            <form class="user-page-form" action="./index.php" method="get">
                <input type="hidden" name="page" value="user">
                <input type="hidden" name="username" value="<?=$agent->username?>">
                <button type='submit' class="user-page-submit">See User</button>
            </form>
        </td>
    </tr>
    <?php
}

function drawClients(array $clients) {  ?>
    <table id="clients">
        <thead>
            <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Email</th>
                <th style="width: 0;">See User</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($clients as $client) {
                    _drawClient($client);
                }
            ?>
        </tbody>
    </table>
<?php
    }

function drawAgents(array $agents) {  ?>
    <table id="agents">
        <thead>
            <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Email</th>
                <th>Departments</th>
                <th style="width: 0;">See User</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($agents as $agent) {
                    _drawAgent($agent);
                }
            ?>
        </tbody>
    </table>
<?php
    }
?>