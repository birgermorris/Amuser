<?php
// message ophalen $_POST
// new Activity
// -> Save();
// antwoorden in JSON
session_start();
include_once("../classes/reaction.class.php");
include_once("../classes/User.class.php");

$reaction = new Reaction();
$user = new User();
//controleer of er een update wordt verzonden
if(!empty($_POST['reaction']) && !empty($_POST['dataid']))
{
    $reaction->setPost_id($_POST['dataid']);
    $reaction->setReaction_text($_POST['reaction']);
    $reaction->setUser_id($_SESSION['user_id']);
    try
    {
        $reaction->create();
        $response['status'] = 'success';
        $response['message'] = "Update successful";
        $response['text'] = htmlspecialchars($_POST['reaction']);
        $response['dataid'] = $_POST['dataid'];
        $user->setUser_id($_SESSION['user_id']);
        $userinfo = $user->getUserInfo();
        $response["user_name"] = $userinfo["firstname"] . " " . $userinfo["lastname"];
        $response['user_id'] = $_SESSION['user_id'];
        $response['userphoto'] = $userinfo['image'];
    }
    catch (Exception $e)
    {
        $feedback = $e->getMessage();
        $response['status'] = 'error';
        $response['message'] = $feedback;
    }
    header('Content-Type: application/json');
    echo json_encode($response); // {status: 'error', message: ''}
}
?>