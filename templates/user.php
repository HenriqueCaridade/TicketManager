<?php
    include_once("../templates/profile.php");

function _drawClient(User $client) { ?>
    <tr class="client">
        <td class="client-username"><?php drawProfile($client->username, true); ?></td>
        <td class="client-name"><?=htmlentities($client->name)?></td>
        <td class="client-email"><?=htmlentities($client->email)?></td>
        <td class="client-usertype"> 
            <a class="client-change" data-username="<?=htmlentities($client->username)?>" data-user-type="<?=htmlentities($client->userType)?>"> 
                <?=htmlentities($client->userType)?> 
            </a>
        </td>
    </tr>
    
<?php
}

function _drawAgent(User $agent) { ?>
    <tr class="agent">
        <td class="agent-username"><?php drawProfile($agent->username, true); ?></td>
        <td class="agent-name"><?=htmlentities($agent->name)?></td>
        <td class="agent-email"><?=htmlentities($agent->email)?></td>
        <td class="agent-usertype">
            <a class="agent-change" data-username="<?=htmlentities($agent->username)?>" data-user-type="<?=htmlentities($agent->userType)?>"> 
                <?=htmlentities($agent->userType)?> 
            </a></td>
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
                <th>Usertype</th>
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
                <th>Usertype</th>
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