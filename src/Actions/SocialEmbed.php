<?php
namespace OffbeatWP\SocialImporter\Actions;

use OffbeatWP\Hooks\AbstractAction;

class SocialEmbed extends AbstractAction {
    function execute() {
        $postId = $_GET['post'];

        $post = offbeat('social_importer')->findById($postId);

        echo $post->getEmbed();
    }
}