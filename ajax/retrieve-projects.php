<?
// get the settings
$gContent = new GatherContent();
$gContent = $gContent->get($bigtree["commands"][0]);

// get the projects
$c = curl_init();

curl_setopt($c, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/vnd.gathercontent.v0.5+json'));
curl_setopt($c, CURLOPT_USERPWD, $gContent["username"] . ":" . $gContent["apikey"]);
curl_setopt($c, CURLOPT_URL, "https://api.gathercontent.com/projects?account_id=" . $bigtree["commands"][1]);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

$response = json_decode(curl_exec($c));
curl_close($c);

// find the project we are looking for
$projectId = -1;
foreach ($response->data as $projectCounter => $projectInfo) {
    if (strtolower($projectInfo->name) == strtolower($gContent["project"])) {
        $projectId = $projectInfo->id;
        break;
    }
}

if ($projectId == -1) {
    echo "not found";
}
else {
    echo $projectId;
}
?>
