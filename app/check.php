<?php
echo "*  To be on the safe side, please also launch the requirements check\n";
echo "*  from your web server using the web/config.php script.\n";

echo_title('Mandatory requirements');

foreach ($symfonyRequirements->getRequirements() as $req) {
    echo_requirement($req);
}

echo_title('Optional recommendations');

foreach ($symfonyRequirements->getRecommendations() as $req) {
    echo_requirement($req);
}

/**
 * Prints a Requirement instance
 */
function echo_requirement(Requirement $requirement)
{
    $result = $requirement->isFulfilled() ? 'OK' : ($requirement->isOptional() ? 'WARNING' : 'ERROR');
    echo ' ' . str_pad($result, 9);
    echo $requirement->getTestMessage() . "\n";

    if (!$requirement->isFulfilled()) {
        echo sprintf("          %s\n\n", $requirement->getHelpText());
    }
}

function echo_title($title)
{
    echo "\n** $title **\n\n";
}
